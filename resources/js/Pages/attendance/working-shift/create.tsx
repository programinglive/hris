import React, { useState, useEffect } from 'react'
import AppLayout from '@/layouts/app/app-layout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select'
import { Textarea } from '@/Components/ui/textarea'
import { Switch } from '@/Components/ui/switch'
import { Badge } from '@/Components/ui/badge'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/Components/ui/alert-dialog'
import { useToast } from '@/Components/ui/use-toast'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu'
import { Checkbox } from '@/Components/ui/checkbox'
import { Alert } from '@/Components/ui/alert'
import { AlertCircle, AlertTriangle } from 'lucide-react'
import { useForm } from '@inertiajs/react'
import { toast } from 'sonner'
import { Link, Head } from '@inertiajs/react'

interface Company {
  id: number;
  name: string;
}

interface Props {
  companies: Company[]
}

interface FormDataType {
  name: string;
  start_time: string;
  end_time: string;
  grace_period_minutes: string;
  company_id: string;
  is_default: boolean;
  working_days: string[];
}

export default function Create({ companies }: Props) {
  const { data, setData, post: submit, processing, errors, clearErrors } = useForm<Required<FormDataType>>({
    name: '',
    start_time: '',
    end_time: '',
    grace_period_minutes: '',
    company_id: '',
    is_default: false,
    working_days: []
  });

  const daysOfWeek = [
    { value: 'Monday', label: 'Monday' },
    { value: 'Tuesday', label: 'Tuesday' },
    { value: 'Wednesday', label: 'Wednesday' },
    { value: 'Thursday', label: 'Thursday' },
    { value: 'Friday', label: 'Friday' },
    { value: 'Saturday', label: 'Saturday' },
    { value: 'Sunday', label: 'Sunday' }
  ];

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    submit('/attendance/working-shift', {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        toast.success('Working shift created successfully');
      },
      onError: (errors: { message?: string }) => {
        if (errors.message) {
          toast.error(errors.message);
        }
      }
    });
  };

  const handleCheckboxChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const day = e.target.value;
    const isChecked = e.target.checked;
    const currentDays = data.working_days;

    if (isChecked) {
      setData('working_days', [...currentDays, day]);
    } else {
      setData('working_days', currentDays.filter(d => d !== day));
    }
  };

  const renderError = (message: string | undefined) => {
    if (!message) return null;
    return (
      <Alert className="mt-2" variant="destructive">
        <AlertCircle className="h-4 w-4" />
        <span>{message}</span>
      </Alert>
    );
  };

  return (
    <AppLayout>
      <Head title="Create Working Shift" />

      <div className="container mx-auto py-6">
        <Card>
          <CardHeader>
            <CardTitle>Create Working Shift</CardTitle>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <Label htmlFor="name">Name</Label>
                  <Input
                    id="name"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    className="mt-1 block w-full"
                  />
                  {renderError(errors.name)}
                </div>

                <div>
                  <Label htmlFor="company_id">Company</Label>
                  <Select
                    value={data.company_id}
                    onValueChange={(value) => setData('company_id', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select company" />
                    </SelectTrigger>
                    <SelectContent>
                      {companies.map((company) => (
                        <SelectItem key={company.id} value={company.id.toString()}>
                          {company.name}
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {renderError(errors.company_id)}
                </div>

                <div>
                  <Label htmlFor="start_time">Start Time</Label>
                  <Input
                    id="start_time"
                    type="time"
                    value={data.start_time}
                    onChange={(e) => setData('start_time', e.target.value)}
                    className="mt-1 block w-full"
                  />
                  {renderError(errors.start_time)}
                </div>

                <div>
                  <Label htmlFor="end_time">End Time</Label>
                  <Input
                    id="end_time"
                    type="time"
                    value={data.end_time}
                    onChange={(e) => setData('end_time', e.target.value)}
                    className="mt-1 block w-full"
                  />
                  {renderError(errors.end_time)}
                </div>

                <div>
                  <Label htmlFor="grace_period_minutes">Grace Period (minutes)</Label>
                  <Input
                    id="grace_period_minutes"
                    type="number"
                    value={data.grace_period_minutes}
                    onChange={(e) => setData('grace_period_minutes', e.target.value)}
                    className="mt-1 block w-full"
                  />
                  {renderError(errors.grace_period_minutes)}
                </div>

                <div>
                  <Label htmlFor="is_default">Is Default</Label>
                  <Switch
                    id="is_default"
                    checked={data.is_default}
                    onCheckedChange={(checked) => setData('is_default', checked)}
                  />
                  {renderError(errors.is_default)}
                </div>
              </div>

              <div className="space-y-4">
                <Label>Working Days</Label>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                  {daysOfWeek.map((day) => (
                    <div key={day.value} className="flex items-center space-x-2">
                      <Checkbox
                        id={day.value}
                        checked={data.working_days.includes(day.value)}
                        onCheckedChange={(checked) => handleCheckboxChange({
                          target: { value: day.value, checked }
                        } as React.ChangeEvent<HTMLInputElement>)}
                      />
                      <Label htmlFor={day.value}>{day.label}</Label>
                    </div>
                  ))}
                </div>
                {renderError(errors.working_days)}
              </div>

              <div className="flex justify-end space-x-4">
                <Link href={route('attendance.working-shift.index')} className="btn btn-outline">
                  Cancel
                </Link>
                <Button type="submit" disabled={processing}>
                  {processing ? 'Saving...' : 'Save'}
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
