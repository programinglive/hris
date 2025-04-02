import { type PageProps } from '@/types';
import AppLayout from '@/layouts/app/app-layout';
import { Card } from '@/components/ui/card';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectGroup, SelectLabel, SelectItem } from '@/components/ui/select';
import { useForm } from '@inertiajs/react';
import { Link } from '@inertiajs/react';

interface Props extends PageProps {
  leaveTypes: Array<{ id: string; name: string }>;
}

export default function Create({ leaveTypes }: Props) {
  const { data, setData, post, processing, errors } = useForm({
    leave_type_id: '',
    start_date: '',
    end_date: '',
    reason: '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(route('attendance.leave.store'));
  };

  return (
    <AppLayout title="Create Leave Request">
      <div className="space-y-4">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-bold">Create Leave Request</h1>
          <Link href={route('attendance.leave.index')} className="btn btn-secondary">
            Back
          </Link>
        </div>

        <Card>
          
        </Card>
      </div>
    </AppLayout>
  );
}
