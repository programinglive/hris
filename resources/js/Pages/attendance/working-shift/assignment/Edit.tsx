import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { useForm } from '@inertiajs/react';

type Option = { id: number; name: string; email?: string };
type Assignment = {
  id: number;
  user_id: number;
  work_shift_id: number;
  effective_date?: string | null;
  end_date?: string | null;
  is_active?: boolean;
};

export default function AssignmentEdit({
  userWorkShift,
  users,
  workShifts,
}: {
  userWorkShift: Assignment;
  users: Option[];
  workShifts: Option[];
}) {
  const { data, setData, put, processing, errors } = useForm({
    user_id: String(userWorkShift.user_id ?? ''),
    work_shift_id: String(userWorkShift.work_shift_id ?? ''),
    effective_date: userWorkShift.effective_date ?? '',
    end_date: userWorkShift.end_date ?? '',
    is_active: Boolean(userWorkShift.is_active),
  });

  function submit(e: React.FormEvent) {
    e.preventDefault();
    put(`/attendance/working-shift/assignment/${userWorkShift.id}`);
  }

  return (
    <AppLayout
      title="Edit assignment"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Assignments', href: '/attendance/working-shift/assignment' },
        { title: 'Edit', href: `/attendance/working-shift/assignment/${userWorkShift.id}/edit` },
      ]}
    >
      <div className="container max-w-xl py-6">
        <Card>
          <CardHeader>
            <CardTitle>Edit assignment</CardTitle>
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
                  {users.map((u) => (
                    <option key={u.id} value={u.id}>
                      {u.name}
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
                  {workShifts.map((s) => (
                    <option key={s.id} value={s.id}>
                      {s.name}
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
              </div>

              <div>
                <Label htmlFor="end_date">End date</Label>
                <Input
                  id="end_date"
                  type="date"
                  value={data.end_date}
                  onChange={(e) => setData('end_date', e.target.value)}
                />
              </div>

              <Button type="submit" disabled={processing}>
                Save changes
              </Button>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
