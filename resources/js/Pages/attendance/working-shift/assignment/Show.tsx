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

export default function AssignmentShow({ userWorkShift }: { userWorkShift: Assignment }) {
  const rows: [string, string][] = [
    ['Employee', userWorkShift.user?.name ?? '—'],
    ['Email', userWorkShift.user?.email ?? '—'],
    ['Shift', userWorkShift.work_shift?.name ?? '—'],
    ['Effective date', userWorkShift.effective_date ?? '—'],
    ['End date', userWorkShift.end_date ?? '—'],
    ['Status', userWorkShift.is_active ? 'Active' : 'Inactive'],
  ];

  return (
    <AppLayout
      title="Assignment detail"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Assignments', href: '/attendance/working-shift/assignment' },
        { title: 'Detail', href: `/attendance/working-shift/assignment/${userWorkShift.id}` },
      ]}
    >
      <div className="container max-w-xl py-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between">
            <CardTitle>Assignment detail</CardTitle>
            <Button variant="outline" size="sm" asChild>
              <Link href={`/attendance/working-shift/assignment/${userWorkShift.id}/edit`}>Edit</Link>
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
