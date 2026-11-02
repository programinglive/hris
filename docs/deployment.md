# Deploy — `hris.programinglive.com`

> **This host runs the public demo, not a production service.** It is a small
> shared box (2 vCPU / 8 GB) that also serves a dozen other sites. Capacity is
> deliberately not raised: 502s under load are expected and are not application
> bugs. For a real deployment, run your own instance — the steps below apply,
> but size the machine and the PHP-FPM pool for your traffic.

Production runs on `bw-server-clean` (GCP, Debian 12, nginx 1.22.1, PHP 8.3, PostgreSQL 16).

## Topology

```
browser ──HTTPS──▶ GCP load balancer "httpsbw" (34.160.181.191)
                    TLS terminated here (cert: hris-programinglive)
                        │  plain HTTP :80
                        ▼
                  bw-server-clean
                    nginx server_name hris.programinglive.com
                    /var/www/hris.programinglive.com
                    php8.3-fpm
                        │
                        ▼
                    PostgreSQL  pghris_db / pghris_user
```

`zettly.programinglive.com` uses the same host and the same load balancer; this
site is a sibling, not a replacement.

**This database is separate from the client HRIS on GitLab
(`hris.beautyworld.co.id`, `prod_hris_db`). Never point this site at it.**

## Artefacts

| Path | Purpose |
|---|---|
| `deploy/nginx/hris.programinglive.com.conf` | nginx vhost |
| `deploy/supervisor/hris-worker.conf` | queue worker (2 processes) |

## Why nginx needs `HTTPS $http_x_forwarded_proto`

The load balancer terminates TLS and forwards over plain HTTP. Without that line
Laravel thinks the request is insecure, `asset()` and `@vite` emit `http://`
URLs, and the browser blocks every stylesheet and script as mixed content. The
symptom is a **blank page with no visible error** — it is only visible in the
console. This is the single most likely thing to break on a rebuild.

## First-time setup

```bash
# 1. database (role owns the db, so no superuser needed at runtime)
sudo -u postgres psql -c "CREATE ROLE pghris_user LOGIN PASSWORD '<generated>';"
sudo -u postgres createdb -O pghris_user pghris_db

# 2. code
sudo -u www-data git clone https://github.com/programinglive/hris.git \
  /var/www/hris.programinglive.com
cd /var/www/hris.programinglive.com

# 3. dependencies — must NOT be --no-dev only for the first install if
#    fakerphp/faker were still dev-only; it lives in require now, so --no-dev is fine
sudo -u www-data composer install --no-dev --optimize-autoloader

# 4. environment
sudo -u www-data cp .env.example .env
# set: APP_ENV=production APP_DEBUG=false APP_URL=https://hris.programinglive.com
#      DB_CONNECTION=pgsql DB_HOST=127.0.0.1 DB_DATABASE=pghris_db
#      DB_USERNAME=pghris_user DB_PASSWORD=<generated>
#      SESSION_DRIVER=database QUEUE_CONNECTION=database CACHE_STORE=database
sudo -u www-data php artisan key:generate --force

# 5. schema
sudo -u www-data php artisan migrate --force

# 6. frontend — the lockfile has a React 19 / @tinymce peer conflict
sudo -u www-data npm ci --legacy-peer-deps --no-audit --no-fund
sudo -u www-data npm run build

# 7. storage + caches
sudo -u www-data php artisan storage:link
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo chown -R www-data:www-data storage bootstrap/cache

# 8. nginx
sudo cp deploy/nginx/hris.programinglive.com.conf /etc/nginx/sites-available/
sudo ln -sfn /etc/nginx/sites-available/hris.programinglive.com.conf \
             /etc/nginx/sites-enabled/hris.programinglive.com.conf
sudo nginx -t && sudo systemctl reload nginx

# 9. queue worker
sudo cp deploy/supervisor/hris-worker.conf /etc/supervisor/conf.d/
sudo supervisorctl reread && sudo supervisorctl update

# 10. scheduler
(sudo crontab -l; echo '* * * * * cd /var/www/hris.programinglive.com && /usr/bin/php artisan schedule:run >> /dev/null 2>&1') | sudo crontab -
```

The scheduler is installed even though `routes/console.php` defines no tasks
today, so anything added later runs without further setup.

## Optional: seed demo data

```bash
sudo -u www-data php artisan db:seed --force
```

Creates `admin@beautyhris.com` and `test@example.com`, both with password
`password` and the `administrator` role. **Change the passwords before real use.**

## Deploying an update

```bash
cd /var/www/hris.programinglive.com
sudo -u www-data git pull --ff-only
sudo -u www-data composer install --no-dev --optimize-autoloader
sudo -u www-data php artisan migrate --force
sudo -u www-data npm ci --legacy-peer-deps && sudo -u www-data npm run build   # only if frontend changed
sudo -u www-data php artisan config:cache && sudo -u www-data php artisan route:cache && sudo -u www-data php artisan view:cache
sudo supervisorctl restart hris-worker:*
```

## Verifying a deploy

Run these against the site you just deployed. `502` means the server is busy
(see the note at the top); only a `500` with a matching `laravel.log` entry is a
defect.

```bash
# expected: 200
curl -s -o /dev/null -w '%{http_code}\n' https://hris.programinglive.com/

# expected: 0 — any hit means mixed content will blank the page
curl -s https://hris.programinglive.com/ | grep -c 'http://hris'

# expected: both RUNNING
sudo supervisorctl status | grep hris

# expected: 0 Pending
sudo -u www-data php artisan migrate:status | grep -c Pending
```

## DNS and certificate

- Cloudflare A record `hris` → `34.160.181.191`, **DNS only** (grey cloud)
- Managed certificate `hris-programinglive`, attached to the target HTTPS proxy
  `beautyworldloadbalancer-target-proxy-2`

The certificate only leaves `PROVISIONING` once the A record points at the load
balancer. `gcloud compute ssl-certificates describe hris-programinglive --project winged-ratio-344917 --format="value(managed.status)"`
