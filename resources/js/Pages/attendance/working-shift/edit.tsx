import React, { useState, useEffect } from 'react'
import { Head, useForm, Link } from '@inertiajs/react'
import AppLayout from '@/layouts/app/app-layout'
import { type BreadcrumbItem } from '@/types'
import { Card, CardContent, CardHeader, CardTitle, CardDescription, CardFooter } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { ArrowLeft } from 'lucide-react'
import { FormError } from '@/components/FormError'
import { WorkShift } from '@/types/models'
import { useToast } from '@/components/ui/use-toast';

interface Company {
  id: number;
  name: string;
}

interface Props {
  auth: any;
  workShift: WorkShift;
  companies: Company[];
}

export default function Edit({ auth, workShift, companies }: Props) {
  const { data, setData, put, processing, errors } = useForm({
    name: workShift.name || '',
    start_time: '',
    end_time: '',
    grace_period_minutes: workShift.grace_period_minutes?.toString() || '5',
    working_days: workShift.working_days || [],
    is_default: workShift.is_default || false,
    company_id: workShift.company_id?.toString() || '',
  });

  useEffect(() => {
    // Format time values from datetime to HH:MM format for input fields
    if (workShift.start_time) {
      const startTime = new Date(workShift.start_time);
      const hours = startTime.getHours().toString().padStart(2, '0');
      const minutes = startTime.getMinutes().toString().padStart(2, '0');
      setData('start_time', `${hours}:${minutes}`);
    }

    if (workShift.end_time) {
      const endTime = new Date(workShift.end_time);
      const hours = endTime.getHours().toString().padStart(2, '0');
      const minutes = endTime.getMinutes().toString().padStart(2, '0');
      setData('end_time', `${hours}:${minutes}`);
    }
  }, [workShift]);

  const daysOfWeek = [
    { id: 0, name: 'Sunday' },
    { id: 1, name: 'Monday' },
    { id: 2, name: 'Tuesday' },
    { id: 3, name: 'Wednesday' },
    { id: 4, name: 'Thursday' },
    { id: 5, name: 'Friday' },
    { id: 6, name: 'Saturday' },
  ];

  const handleWorkingDayChange = (dayId: number, checked: boolean) => {
    if (checked) {
      setData('working_days', [...data.working_days, dayId]);
    } else {
      setData('working_days', data.working_days.filter((id: number) => id !== dayId));
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    put(route('attendance.work-shifts.update', workShift.id));
  };

  return (
    <AppLayout
      breadcrumbs={[
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Work Shifts', href: route('attendance.work-shifts.index') },
        { title: 'Edit', href: route('attendance.work-shifts.edit', workShift.id) }
      ]}
    >
      <Link href={route('attendance.work-shifts.index')} className="text-gray-600 hover:text-gray-900 mb-4 inline-flex items-center">
        <ArrowLeft className="w-4 h-4 mr-2" />
        Back to work shifts
      </Link>

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card>
            <CardHeader>
              <CardTitle className="text-2xl font-bold">Edit Working Shift: {workShift.name}</CardTitle>
            </CardHeader>
            <form onSubmit={handleSubmit}>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="name">Shift Name</Label>
                    <Input 
                      id="name" 
                      value={data.name} 
                      onChange={e => setData('name', e.target.value)} 
                      placeholder="e.g. Morning Shift"
                    />
                    <FormError message={errors.name} />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="company_id">Company</Label>
                    <Select 
                      value={data.company_id} 
                      onValueChange={value => setData('company_id', value)}
                    >
                      <SelectTrigger>
                        <SelectValue placeholder="Select company" />
                      </SelectTrigger>
                      <SelectContent>
                        {companies.map(company => (
                          <SelectItem key={company.id} value={company.id.toString()}>
                            {company.name}
                          </SelectItem>
                        ))}
                      </SelectContent>
                    </Select>
                    <FormError message={errors.company_id} />
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="start_time">Start Time</Label>
                    <Input 
                      id="start_time" 
                      type="time" 
                      value={data.start_time} 
                      onChange={e => setData('start_time', e.target.value)} 
                    />
                    <FormError message={errors.start_time} />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="end_time">End Time</Label>
                    <Input 
                      id="end_time" 
                      type="time" 
                      value={data.end_time} 
                      onChange={e => setData('end_time', e.target.value)} 
                    />
                    <FormError message={errors.end_time} />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="grace_period_minutes">Grace Period (minutes)</Label>
                    <Input 
                      id="grace_period_minutes" 
                      type="number" 
                      min="0"
                      max="60"
                      value={data.grace_period_minutes} 
                      onChange={e => setData('grace_period_minutes', e.target.value)} 
                    />
                    <FormError message={errors.grace_period_minutes} />
                  </div>
                </div>

                <div className="space-y-2">
                  <Label>Working Days</Label>
                  <div className="grid grid-cols-2 md:grid-cols-4 gap-2">
                    {daysOfWeek.map(day => (
                      <div key={day.id} className="flex items-center space-x-2">
                        <Checkbox 
                          id={`day-${day.id}`}
                          checked={data.working_days.includes(day.id)}
                          onCheckedChange={(checked) => 
                            handleWorkingDayChange(day.id, !!checked)
                          }
                        />
                        <Label htmlFor={`day-${day.id}`}>{day.name}</Label>
                      </div>
                    ))}
                  </div>
                  <FormError message={errors.working_days} />
                </div>

                <div className="flex items-center space-x-2">
                  <Checkbox 
                    id="is_default" 
                    checked={data.is_default}
                    onCheckedChange={(checked) => setData('is_default', !!checked)}
                  />
                  <Label htmlFor="is_default">Set as default shift for this company</Label>
                  <FormError message={errors.is_default} />
                </div>
              </CardContent>

              <CardFooter className="flex justify-between">
                <Button 
                  type="button" 
                  variant="outline" 
                  onClick={() => window.history.back()}
                >
                  Cancel
                </Button>
                <Button type="submit" disabled={processing}>Update Working Shift</Button>
              </CardFooter>
            </form>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
