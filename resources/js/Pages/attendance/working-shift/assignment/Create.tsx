import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { useForm } from '@inertiajs/react';

type Option = { id: number; name: string; email?: string; start_time?: string; end_time?: string };

export default function AssignmentCreate({ users, workShifts }: { users: Option[]; workShifts: Option[] }) {
  const { data, setData, post, processing, errors } = useForm({
    user_id: '',
    work_shift_id: '',
    effective_date: '',
    end_date: '',
    is_active: true,
  });

  function submit(e: React.FormEvent) {
    e.preventDefault();
    post('/attendance/working-shift/assignment');
  }

  return (
    <AppLayout
      title="Assign a working shift"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Assignments', href: '/attendance/working-shift/assignment' },
        { title: 'Assign', href: '/attendance/working-shift/assignment/create' },
      ]}
    >
      <div className="container max-w-xl py-6">
        <Card>
          <CardHeader>
            <CardTitle>Assign a working shift</CardTitle>
          </CardHeader>
          <CardContent>
            <form onSubmit={submit} className="space-y-4">
              <div>
                <Label htmlFor="user_id">Employee</Label>
                <select
                  id="user_id"
                  className="w-full rounded-md border p-2"
                  value={data.user_id}
                  onChange={(e) => setData('user_id', e.target.value)}
                >
                  <option value="">Select an employee</option>
                  {users.map((u) => (
                    <option key={u.id} value={u.id}>
                      {u.name} ({u.email})
                    </option>
                  ))}
                </select>
                {errors.user_id && <p className="text-sm text-red-600">{errors.user_id}</p>}
              </div>

              <div>
                <Label htmlFor="work_shift_id">Shift</Label>
                <select
                  id="work_shift_id"
                  className="w-full rounded-md border p-2"
                  value={data.work_shift_id}
                  onChange={(e) => setData('work_shift_id', e.target.value)}
                >
                  <option value="">Select a shift</option>
                  {workShifts.map((s) => (
                    <option key={s.id} value={s.id}>
                      {s.name}
                      {s.start_time && s.end_time ? ` (${s.start_time} - ${s.end_time})` : ''}
                    </option>
                  ))}
                </select>
                {errors.work_shift_id && <p className="text-sm text-red-600">{errors.work_shift_id}</p>}
              </div>

              <div>
                <Label htmlFor="effective_date">Effective date</Label>
                <Input
                  id="effective_date"
                  type="date"
                  value={data.effective_date}
                  onChange={(e) => setData('effective_date', e.target.value)}
                />
                {errors.effective_date && <p className="text-sm text-red-600">{errors.effective_date}</p>}
              </div>

              <div>
                <Label htmlFor="end_date">End date (optional)</Label>
                <Input
                  id="end_date"
                  type="date"
                  value={data.end_date}
                  onChange={(e) => setData('end_date', e.target.value)}
                />
                {errors.end_date && <p className="text-sm text-red-600">{errors.end_date}</p>}
              </div>

              <Button type="submit" disabled={processing}>
                Save assignment
              </Button>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
