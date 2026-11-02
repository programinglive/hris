import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Link } from '@inertiajs/react';

type TimeLog = {
  id: number;
  user?: { id: number; name: string; email: string } | null;
  date?: string | null;
  clock_in?: string | null;
  clock_out?: string | null;
  status?: string | null;
  notes?: string | null;
};

export default function TimeLogShow({ timeLog }: { timeLog: TimeLog }) {
  const rows: [string, string][] = [
    ['Employee', timeLog.user?.name ?? '—'],
    ['Email', timeLog.user?.email ?? '—'],
    ['Date', timeLog.date ?? '—'],
    ['Clock in', timeLog.clock_in ?? '—'],
    ['Clock out', timeLog.clock_out ?? '—'],
    ['Status', timeLog.status ?? '—'],
    ['Notes', timeLog.notes ?? '—'],
  ];

  return (
    <AppLayout
      title="Time log"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Attendance', href: '/attendance' },
        { title: 'Time logs', href: '/attendance/time' },
        { title: 'Detail', href: `/attendance/time/${timeLog.id}` },
      ]}
    >
      <div className="container max-w-xl py-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between">
            <CardTitle>Time log detail</CardTitle>
            <Button variant="outline" size="sm" asChild>
              <Link href={`/attendance/time/${timeLog.id}/edit`}>Edit</Link>
            </Button>
          </CardHeader>
          <CardContent>
            <dl className="divide-y">
              {rows.map(([label, value]) => (
                <div key={label} className="flex justify-between py-2 text-sm">
                  <dt className="text-muted-foreground">{label}</dt>
                  <dd>{value}</dd>
                </div>
              ))}
            </dl>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
