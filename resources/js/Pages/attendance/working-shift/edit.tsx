import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent } from '@/Components/ui/card';
import { Loader2 } from 'lucide-react';

export default function WorkShiftEdit() {
  return (
    <AppLayout
      title="Edit Work Shift"
      breadcrumbs={[
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Attendance', href: '/attendance' },
        { title: 'Working Shifts', href: '/attendance/working-shift' },
        { title: 'Edit', href: '/attendance/working-shift/{id}/edit' },
      ]}
    >
      <div className="container py-6">
        <Card className="w-full">
          <CardContent className="p-6 flex flex-col items-center justify-center space-y-4">
            <Loader2 className="h-12 w-12 animate-spin text-muted-foreground" />
            <h2 className="text-2xl font-semibold">Work Shift Management Module</h2>
            <p className="text-muted-foreground text-center">This module is currently under development and will be available soon.</p>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
