import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Checkbox } from '@/components/ui/checkbox';
import { format } from 'date-fns';
import { Calendar } from '@/components/ui/calendar';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { CalendarIcon } from 'lucide-react';
import { cn } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';

interface CreateWorkingCalendarProps {
  pageTitle: string;
  auth: any;
  ziggy: any;
}

export default function CreateWorkingCalendar({ pageTitle }: CreateWorkingCalendarProps) {
  const { url } = usePage();
  const [startDate, setStartDate] = useState<Date | undefined>(new Date());
  const [endDate, setEndDate] = useState<Date | undefined>(new Date());
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    is_active: true
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
      title: 'Create',
      href: url,
    }
  ];

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.post('/attendance/working-calendar', {
      name: formData.name,
      start_date: startDate ? format(startDate, 'yyyy-MM-dd') : '',
      end_date: endDate ? format(endDate, 'yyyy-MM-dd') : '',
      description: formData.description,
      is_active: formData.is_active
    });
  };

  return (
    <AppLayout title={pageTitle} breadcrumbs={breadcrumbs}>
      <div className="p-4 sm:p-6 space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">{pageTitle}</h1>
          <Button 
            variant="outline" 
            onClick={() => router.get('/attendance/working-calendar')}
          >
            Back to List
          </Button>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Create Working Calendar</CardTitle>
            <CardDescription>
              Create a new working calendar period for your company
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
                <Button type="submit">Create Working Calendar</Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
