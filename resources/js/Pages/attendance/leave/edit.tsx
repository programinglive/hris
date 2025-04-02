import { type PageProps } from '@/types';
import AppLayout from '@/layouts/app/app-layout';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Form } from '@/components/form';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/react';
import { type ReactNode } from 'react';
import { Link } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';

interface Props extends PageProps {
  leave: {
    id: string;
    leave_type_id: string;
    start_date: string;
    end_date: string;
    reason: string;
    status: string;
  };
  leaveTypes: Array<{ id: string; name: string }>;
}

export default function Edit({ leave, leaveTypes }: Props) {
  const { data, setData, put, processing, errors } = useForm({
    leave_type_id: leave.leave_type_id,
    start_date: leave.start_date,
    end_date: leave.end_date,
    reason: leave.reason,
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    put(route('attendance.leave.update', leave.id));
  };

  return (
    <AppLayout title="Edit Leave Request">
      <div className="space-y-4">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-bold">Edit Leave Request</h1>
          <Link href={route('attendance.leave.index')} className="btn btn-secondary">
            Back
          </Link>
        </div>

        <Card>
          <Form onSubmit={handleSubmit}>
            <div className="space-y-4">
              <div>
                <Label htmlFor="leave_type_id">Leave Type</Label>
                <Select
                  value={data.leave_type_id}
                  onValueChange={(value) => setData('leave_type_id', value)}
                  required
                  disabled={leave.status !== 'pending'}
                >
                  <SelectTrigger className="w-full">
                    <SelectValue placeholder="Select leave type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectLabel>Leave Types</SelectLabel>
                      {leaveTypes.map((type) => (
                        <SelectItem key={type.id} value={type.id}>
                          {type.name}
                        </SelectItem>
                      ))}
                    </SelectGroup>
                  </SelectContent>
                </Select>
                {errors.leave_type_id && (
                  <p className="mt-1 text-sm text-red-600">{errors.leave_type_id}</p>
                )}
              </div>

              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label htmlFor="start_date">Start Date</Label>
                  <Input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value={data.start_date}
                    onChange={(e) => setData('start_date', e.target.value)}
                    required
                    disabled={leave.status !== 'pending'}
                  />
                  {errors.start_date && (
                    <p className="mt-1 text-sm text-red-600">{errors.start_date}</p>
                  )}
                </div>

                <div>
                  <Label htmlFor="end_date">End Date</Label>
                  <Input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value={data.end_date}
                    onChange={(e) => setData('end_date', e.target.value)}
                    required
                    disabled={leave.status !== 'pending'}
                  />
                  {errors.end_date && (
                    <p className="mt-1 text-sm text-red-600">{errors.end_date}</p>
                  )}
                </div>
              </div>

              <div>
                <Label htmlFor="reason">Reason</Label>
                <textarea
                  id="reason"
                  name="reason"
                  value={data.reason}
                  onChange={(e) => setData('reason', e.target.value)}
                  required
                  disabled={leave.status !== 'pending'}
                  className="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                {errors.reason && (
                  <p className="mt-1 text-sm text-red-600">{errors.reason}</p>
                )}
              </div>

              <div className="flex justify-end space-x-2">
                <Link href={route('attendance.leave.index')} className="btn btn-secondary">
                  Cancel
                </Link>
                <Button type="submit" disabled={processing || leave.status !== 'pending'}>
                  {processing ? 'Saving...' : 'Save'}
                </Button>
              </div>
            </div>
          </Form>
        </Card>
      </div>
    </AppLayout>
  );
}
