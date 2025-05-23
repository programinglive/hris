import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { PageProps } from '@/types';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { Label } from '@/Components/ui/label';
import { Checkbox } from '@/Components/ui/checkbox';
import { format } from 'date-fns';
import AppLayout from '@/layouts/app/app-layout';

interface User {
  id: number;
  name: string;
  detail: {
    employee_id: string;
  }
}

interface CreateTimeLogProps extends PageProps {
  users: User[];
}

export default function CreateTimeLog({ auth, users }: CreateTimeLogProps) {
  const [values, setValues] = useState({
    user_id: '',
    check_in_time: format(new Date(), 'yyyy-MM-dd\'T\'HH:mm'),
    check_out_time: '',
    status: 'present',
    notes: '',
    is_overtime: false,
  });

  const [errors, setErrors] = useState<Record<string, string>>({});
  const [processing, setProcessing] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const key = e.target.id;
    const value = e.target.value;
    
    setValues(values => ({
      ...values,
      [key]: value,
    }));
  };

  const handleSelectChange = (key: string, value: string) => {
    setValues(values => ({
      ...values,
      [key]: value,
    }));
  };

  const handleCheckboxChange = (key: string, checked: boolean) => {
    setValues(values => ({
      ...values,
      [key]: checked,
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setProcessing(true);
    
    router.post(route('attendance.time.store'), values, {
      onSuccess: () => {
        setProcessing(false);
        router.visit(route('attendance.time.index'));
      },
      onError: (errors) => {
        setProcessing(false);
        setErrors(errors);
      },
    });
  };

  return (
    <AppLayout user={auth.user}>
      <Head title="Create Time Log" />
      
      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card>
            <CardHeader>
              <CardTitle className="text-xl font-semibold">Create Time Log</CardTitle>
            </CardHeader>
            
            <form onSubmit={handleSubmit}>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="user_id">Employee</Label>
                  <Select
                    value={values.user_id}
                    onValueChange={(value) => handleSelectChange('user_id', value)}
                  >
                    <SelectTrigger id="user_id">
                      <SelectValue placeholder="Select employee" />
                    </SelectTrigger>
                    <SelectContent>
                      {users.map((user) => (
                        <SelectItem key={user.id} value={user.id.toString()}>
                          {user.name} ({user.detail?.employee_id || 'No ID'})
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.user_id && (
                    <p className="text-sm text-red-500 mt-1">{errors.user_id}</p>
                  )}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="check_in_time">Check In Time</Label>
                  <Input
                    id="check_in_time"
                    type="datetime-local"
                    value={values.check_in_time}
                    onChange={handleChange}
                  />
                  {errors.check_in_time && (
                    <p className="text-sm text-red-500 mt-1">{errors.check_in_time}</p>
                  )}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="check_out_time">Check Out Time</Label>
                  <Input
                    id="check_out_time"
                    type="datetime-local"
                    value={values.check_out_time}
                    onChange={handleChange}
                  />
                  {errors.check_out_time && (
                    <p className="text-sm text-red-500 mt-1">{errors.check_out_time}</p>
                  )}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="status">Status</Label>
                  <Select
                    value={values.status}
                    onValueChange={(value) => handleSelectChange('status', value)}
                  >
                    <SelectTrigger id="status">
                      <SelectValue placeholder="Select status" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="present">Present</SelectItem>
                      <SelectItem value="late">Late</SelectItem>
                      <SelectItem value="absent">Absent</SelectItem>
                      <SelectItem value="leave">Leave</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.status && (
                    <p className="text-sm text-red-500 mt-1">{errors.status}</p>
                  )}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="notes">Notes</Label>
                  <Textarea
                    id="notes"
                    placeholder="Add any additional notes here..."
                    value={values.notes}
                    onChange={handleChange}
                    rows={3}
                  />
                  {errors.notes && (
                    <p className="text-sm text-red-500 mt-1">{errors.notes}</p>
                  )}
                </div>
                
                <div className="flex items-center space-x-2">
                  <Checkbox
                    id="is_overtime"
                    checked={values.is_overtime}
                    onCheckedChange={(checked) => 
                      handleCheckboxChange('is_overtime', checked as boolean)
                    }
                  />
                  <Label htmlFor="is_overtime">Is Overtime</Label>
                </div>
              </CardContent>
              
              <CardFooter className="flex justify-between">
                <Button
                  type="button"
                  variant="outline"
                  onClick={() => router.visit(route('attendance.time.index'))}
                >
                  Cancel
                </Button>
                <Button type="submit" disabled={processing}>
                  {processing ? 'Saving...' : 'Save'}
                </Button>
              </CardFooter>
            </form>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
