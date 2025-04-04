import React, { useState, useEffect } from 'react';
import { Head, router, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Checkbox } from '@/Components/ui/checkbox';
import { format } from 'date-fns';
import { Calendar } from '@/Components/ui/calendar';
import { Popover, PopoverContent, PopoverTrigger } from '@/Components/ui/popover';
import { CalendarIcon } from 'lucide-react';
import { cn } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';

interface WorkingCalendar {
  id: number;
  name: string;
  start_date: string;
  end_date: string;
  description: string | null;
  is_active: boolean;
  company_id: number;
  created_at: string;
  updated_at: string;
}

interface EditWorkingCalendarProps {
  pageTitle: string;
  workingCalendar: WorkingCalendar;
  auth: any;
  ziggy: any;
}

export default function EditWorkingCalendar({ pageTitle, workingCalendar }: EditWorkingCalendarProps) {
  const { url } = usePage();
  const [startDate, setStartDate] = useState<Date | undefined>(new Date(workingCalendar.start_date));
  const [endDate, setEndDate] = useState<Date | undefined>(new Date(workingCalendar.end_date));
  const [formData, setFormData] = useState({
    name: workingCalendar.name,
    description: workingCalendar.description || '',
    is_active: workingCalendar.is_active
  });

  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Attendance',
      href: '#',
    },
    {
      title: 'Working Calendar',
      href: '/attendance/working-calendar',
    },
    {
      title: 'Edit',
      href: url,
    }
  ];

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.put(`/attendance/working-calendar/${workingCalendar.id}`, {
      name: formData.name,
      start_date: startDate ? format(startDate, 'yyyy-MM-dd') : '',
      end_date: endDate ? format(endDate, 'yyyy-MM-dd') : '',
      description: formData.description,
      is_active: formData.is_active
    });
  };

  const handleDelete = () => {
    if (confirm('Are you sure you want to delete this working calendar?')) {
      router.delete(`/attendance/working-calendar/${workingCalendar.id}`);
    }
  };

  return (
    <AppLayout title={pageTitle} breadcrumbs={breadcrumbs}>
      <div className="p-4 sm:p-6 space-y-6">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-2xl font-bold">{pageTitle}</h1>
          <div className="flex gap-2">
            <Button 
              variant="outline" 
              onClick={() => router.get('/attendance/working-calendar')}
            >
              Back to List
            </Button>
            <Button 
              variant="destructive" 
              onClick={handleDelete}
            >
              Delete
            </Button>
          </div>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Edit Working Calendar</CardTitle>
            <CardDescription>
              Update the working calendar information
            </CardDescription>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-2">
                  <Label htmlFor="name">Name</Label>
                  <Input 
                    id="name" 
                    value={formData.name}
                    onChange={(e) => setFormData({...formData, name: e.target.value})}
                    required
                  />
                </div>

                <div className="space-y-2">
                  <Label>Active Status</Label>
                  <div className="flex items-center space-x-2">
                    <Checkbox 
                      id="is_active" 
                      checked={formData.is_active}
                      onCheckedChange={(checked) => 
                        setFormData({...formData, is_active: checked as boolean})
                      }
                    />
                    <label
                      htmlFor="is_active"
                      className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    >
                      Calendar is active
                    </label>
                  </div>
                </div>

                <div className="space-y-2">
                  <Label>Start Date</Label>
                  <Popover>
                    <PopoverTrigger asChild>
                      <Button
                        variant={"outline"}
                        className={cn(
                          "w-full justify-start text-left font-normal",
                          !startDate && "text-muted-foreground"
                        )}
                      >
                        <CalendarIcon className="mr-2 h-4 w-4" />
                        {startDate ? format(startDate, "PPP") : <span>Pick a date</span>}
                      </Button>
                    </PopoverTrigger>
                    <PopoverContent className="w-auto p-0">
                      <Calendar
                        mode="single"
                        selected={startDate}
                        onSelect={setStartDate}
                        initialFocus
                      />
                    </PopoverContent>
                  </Popover>
                </div>

                <div className="space-y-2">
                  <Label>End Date</Label>
                  <Popover>
                    <PopoverTrigger asChild>
                      <Button
                        variant={"outline"}
                        className={cn(
                          "w-full justify-start text-left font-normal",
                          !endDate && "text-muted-foreground"
                        )}
                      >
                        <CalendarIcon className="mr-2 h-4 w-4" />
                        {endDate ? format(endDate, "PPP") : <span>Pick a date</span>}
                      </Button>
                    </PopoverTrigger>
                    <PopoverContent className="w-auto p-0">
                      <Calendar
                        mode="single"
                        selected={endDate}
                        onSelect={setEndDate}
                        initialFocus
                        disabled={(date) => 
                          startDate ? date < startDate : false
                        }
                      />
                    </PopoverContent>
                  </Popover>
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea 
                  id="description" 
                  value={formData.description}
                  onChange={(e) => setFormData({...formData, description: e.target.value})}
                  rows={4}
                />
              </div>

              <div className="flex justify-end">
                <Button type="submit">Update Working Calendar</Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
