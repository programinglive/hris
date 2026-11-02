import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Link } from '@inertiajs/react';

type Assignment = {
  id: number;
  user?: { id: number; name: string; email: string } | null;
  work_shift?: { id: number; name: string } | null;
  effective_date?: string | null;
  end_date?: string | null;
  is_active?: boolean;
};

type Paginated = {
  data: Assignment[];
  current_page: number;
  last_page: number;
  total: number;
};

export default function AssignmentIndex({ userWorkShifts }: { userWorkShifts: Paginated }) {
  return (
    <AppLayout
      title="Working Shift Assignments"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Working Shifts', href: '/attendance/working-shift' },
        { title: 'Assignments', href: '/attendance/working-shift/assignment' },
      ]}
    >
      <div className="container space-y-4 py-6">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-semibold">Working Shift Assignments</h1>
          <Button asChild>
            <Link href="/attendance/working-shift/assignment/create">Assign a shift</Link>
          </Button>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>{userWorkShifts.total} assignment(s)</CardTitle>
          </CardHeader>
          <CardContent>
            {userWorkShifts.data.length === 0 ? (
              <p className="text-muted-foreground">No assignments yet.</p>
            ) : (
              <table className="w-full text-sm">
                <thead>
                  <tr className="border-b text-left">
                    <th className="py-2">Employee</th>
                    <th className="py-2">Shift</th>
                    <th className="py-2">Effective</th>
                    <th className="py-2">Ends</th>
                    <th className="py-2">Status</th>
                    <th className="py-2" />
                  </tr>
                </thead>
                <tbody>
                  {userWorkShifts.data.map((row) => (
                    <tr key={row.id} className="border-b">
                      <td className="py-2">{row.user?.name ?? '—'}</td>
                      <td className="py-2">{row.work_shift?.name ?? '—'}</td>
                      <td className="py-2">{row.effective_date ?? '—'}</td>
                      <td className="py-2">{row.end_date ?? '—'}</td>
                      <td className="py-2">{row.is_active ? 'Active' : 'Inactive'}</td>
                      <td className="py-2 text-right">
                        <Button variant="ghost" size="sm" asChild>
                          <Link href={`/attendance/working-shift/assignment/${row.id}`}>View</Link>
                        </Button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            )}
          </CardContent>
        </Card>

        {userWorkShifts.last_page > 1 && (
          <p className="text-sm text-muted-foreground">
            Page {userWorkShifts.current_page} of {userWorkShifts.last_page}
          </p>
        )}
      </div>
    </AppLayout>
  );
}
