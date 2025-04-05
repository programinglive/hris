import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/app/app-layout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import { CalendarIcon, PlusCircle, PencilIcon, TrashIcon } from 'lucide-react';
import { 
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from '@/Components/ui/alert-dialog';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/Components/ui/dialog';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Checkbox } from '@/Components/ui/checkbox';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { format, isSameDay } from 'date-fns';
import { type BreadcrumbItem } from '@/types';
import { Calendar } from '@/Components/ui/calendar';

interface Holiday {
  id: number;
  name: string;
  date: string;
  description: string | null;
  is_recurring: boolean;
  company_id: number;
  created_at: string;
  updated_at: string;
}

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
  holidays?: Holiday[];
}

interface ShowWorkingCalendarProps {
  pageTitle: string;
  workingCalendar: WorkingCalendar;
  holidays: Holiday[];
  auth: any;
  ziggy: any;
}

export default function ShowWorkingCalendar({ pageTitle, workingCalendar, holidays }: ShowWorkingCalendarProps) {
  const { url } = usePage();
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [isHolidayDialogOpen, setIsHolidayDialogOpen] = useState(false);
  
  // Form state
  const [holidayForm, setHolidayForm] = useState({
    name: '',
    date: new Date(),
    description: '',
    is_recurring: false
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
      title: workingCalendar.name,
      href: url,
    }
  ];

  // Get holidays for the selected date
  const [selectedDate, setSelectedDate] = useState<Date | undefined>(new Date(workingCalendar.start_date));
  const holidaysOnSelectedDate = selectedDate 
    ? holidays.filter(holiday => isSameDay(new Date(holiday.date), selectedDate))
    : [];

  // Check if selected date is within the working calendar range
  const isDateInCalendarRange = selectedDate 
    ? (selectedDate >= new Date(workingCalendar.start_date) && selectedDate <= new Date(workingCalendar.end_date))
    : false;

  // Function to handle holiday form submission
  const handleHolidaySubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.post('/attendance/holiday', {
      name: holidayForm.name,
      date: format(holidayForm.date, 'yyyy-MM-dd'),
      description: holidayForm.description,
      is_recurring: holidayForm.is_recurring
    }, {
      onSuccess: () => {
        setIsHolidayDialogOpen(false);
        setHolidayForm({
          name: '',
          date: new Date(),
          description: '',
          is_recurring: false
        });
      }
    });
  };

  // Custom day content for the calendar
  const renderDayContent = (day: Date) => {
    const dayHolidays = holidays.filter(holiday => isSameDay(new Date(holiday.date), day));
    const isInCalendarRange = day >= new Date(workingCalendar.start_date) && day <= new Date(workingCalendar.end_date);

    return (
      <div className="relative w-full h-full">
        {dayHolidays.length > 0 && (
          <div className="absolute top-0 right-0">
            <Badge variant="destructive" className="h-2 w-2 p-0 rounded-full" />
          </div>
        )}
        {isInCalendarRange && (
          <div className="absolute bottom-0 left-0">
            <Badge variant="success" className="h-2 w-2 p-0 rounded-full" />
          </div>
        )}
        <div>{day.getDate()}</div>
      </div>
    );
  };

  const handleDelete = () => {
    router.delete(`/attendance/working-calendar/${workingCalendar.id}`);
  };

  return (
    <AppLayout title={pageTitle} breadcrumbs={breadcrumbs}>
      <div className="p-4 sm:p-6 space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">{pageTitle}</h1>
          <div className="flex gap-2">
            <Button 
              variant="outline" 
              onClick={() => router.get('/attendance/working-calendar')}
            >
              Back to List
            </Button>
            <Button 
              variant="outline"
              onClick={() => router.get(`/attendance/working-calendar/${workingCalendar.id}/edit`)}
            >
              <PencilIcon className="h-4 w-4 mr-2" />
              Edit
            </Button>
            <Button 
              variant="destructive"
              onClick={() => setIsDeleteDialogOpen(true)}
            >
              <TrashIcon className="h-4 w-4 mr-2" />
              Delete
            </Button>
            <Dialog open={isHolidayDialogOpen} onOpenChange={setIsHolidayDialogOpen}>
              <DialogTrigger asChild>
                <Button variant="outline">
                  <PlusCircle className="mr-2 h-4 w-4" />
                  Add Holiday
                </Button>
              </DialogTrigger>
              <DialogContent>
                <DialogHeader>
                  <DialogTitle>Add New Holiday</DialogTitle>
                  <DialogDescription>
                    Create a new holiday for your company calendar.
                  </DialogDescription>
                </DialogHeader>
                <form onSubmit={handleHolidaySubmit}>
                  <div className="grid gap-4 py-4">
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="name" className="text-right">Name</Label>
                      <Input 
                        id="name" 
                        value={holidayForm.name}
                        onChange={(e) => setHolidayForm({...holidayForm, name: e.target.value})}
                        className="col-span-3" 
                        required
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="date" className="text-right">Date</Label>
                      <div className="col-span-3 flex">
                        <Input 
                          id="date" 
                          type="date"
                          value={format(holidayForm.date, 'yyyy-MM-dd')}
                          onChange={(e) => setHolidayForm({...holidayForm, date: new Date(e.target.value)})}
                          className="flex-1" 
                          required
                        />
                      </div>
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="description" className="text-right">Description</Label>
                      <Textarea 
                        id="description" 
                        value={holidayForm.description}
                        onChange={(e) => setHolidayForm({...holidayForm, description: e.target.value})}
                        className="col-span-3" 
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="is_recurring" className="text-right">Recurring</Label>
                      <div className="flex items-center space-x-2 col-span-3">
                        <Checkbox 
                          id="is_recurring" 
                          checked={holidayForm.is_recurring}
                          onCheckedChange={(checked) => 
                            setHolidayForm({...holidayForm, is_recurring: checked as boolean})
                          }
                        />
                        <label
                          htmlFor="is_recurring"
                          className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >
                          Repeat yearly
                        </label>
                      </div>
                    </div>
                  </div>
                  <DialogFooter>
                    <Button type="submit">Save Holiday</Button>
                  </DialogFooter>
                </form>
              </DialogContent>
            </Dialog>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <Card>
            <CardHeader>
              <CardTitle>Working Calendar Details</CardTitle>
              <CardDescription>
                Information about this working calendar period
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Name</h3>
                <p className="text-lg font-semibold">{workingCalendar.name}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Period</h3>
                <div className="flex items-center gap-2">
                  <CalendarIcon className="h-4 w-4 text-muted-foreground" />
                  <p>
                    {format(new Date(workingCalendar.start_date), 'MMMM d, yyyy')} - {format(new Date(workingCalendar.end_date), 'MMMM d, yyyy')}
                  </p>
                </div>
              </div>
              
              {workingCalendar.description && (
                <div>
                  <h3 className="text-sm font-medium text-muted-foreground">Description</h3>
                  <p>{workingCalendar.description}</p>
                </div>
              )}
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Status</h3>
                {workingCalendar.is_active ? (
                  <Badge variant="success">Active</Badge>
                ) : (
                  <Badge variant="secondary">Inactive</Badge>
                )}
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Created At</h3>
                <p>{format(new Date(workingCalendar.created_at), 'MMMM d, yyyy h:mm a')}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Last Updated</h3>
                <p>{format(new Date(workingCalendar.updated_at), 'MMMM d, yyyy h:mm a')}</p>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Calendar View</CardTitle>
              <CardDescription>
                View holidays and working days on the calendar
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="flex justify-center">
                <Calendar
                  mode="single"
                  selected={selectedDate}
                  onSelect={setSelectedDate}
                  className="rounded-md border"
                  components={{
                    Day: ({ date, ...props }: { date: Date; [key: string]: any }) => (
                      <button {...props}>
                        {renderDayContent(date)}
                      </button>
                    ),
                  }}
                />
              </div>
              <div className="mt-4 flex items-center justify-center gap-4">
                <div className="flex items-center gap-2">
                  <Badge variant="destructive" className="h-3 w-3 p-0 rounded-full" />
                  <span className="text-sm">Holiday</span>
                </div>
                <div className="flex items-center gap-2">
                  <Badge variant="success" className="h-3 w-3 p-0 rounded-full" />
                  <span className="text-sm">Working Day</span>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>

        <div className="mt-6">
          <Card>
            <CardHeader>
              <CardTitle>
                {selectedDate ? format(selectedDate, 'MMMM d, yyyy') : 'Select a date'}
              </CardTitle>
              <CardDescription>
                Details for the selected date
              </CardDescription>
            </CardHeader>
            <CardContent>
              <Tabs defaultValue="details">
                <TabsList className="grid w-full grid-cols-2">
                  <TabsTrigger value="details">Date Details</TabsTrigger>
                  <TabsTrigger value="holidays">Holidays</TabsTrigger>
                </TabsList>
                <TabsContent value="details" className="mt-4">
                  <div className="space-y-4">
                    <div>
                      <h3 className="font-medium">Date Status</h3>
                      {isDateInCalendarRange ? (
                        <Badge variant="success">Working Day</Badge>
                      ) : (
                        <Badge variant="secondary">Outside Calendar Range</Badge>
                      )}
                    </div>
                    
                    {holidaysOnSelectedDate.length > 0 && (
                      <div>
                        <h3 className="font-medium">Holiday Status</h3>
                        <Badge variant="destructive">Holiday</Badge>
                      </div>
                    )}
                  </div>
                </TabsContent>
                <TabsContent value="holidays" className="mt-4">
                  {holidaysOnSelectedDate.length > 0 ? (
                    <div className="space-y-4">
                      {holidaysOnSelectedDate.map((holiday) => (
                        <div key={holiday.id} className="border rounded-md p-4">
                          <h3 className="font-medium">{holiday.name}</h3>
                          <div className="text-sm text-muted-foreground mt-1">
                            <div className="flex items-center gap-1">
                              <CalendarIcon className="h-3 w-3" />
                              <span>{format(new Date(holiday.date), 'MMMM d, yyyy')}</span>
                            </div>
                          </div>
                          {holiday.description && (
                            <p className="text-sm text-muted-foreground mt-2">{holiday.description}</p>
                          )}
                          {holiday.is_recurring && (
                            <Badge variant="outline" className="mt-2">Recurring</Badge>
                          )}
                        </div>
                      ))}
                    </div>
                  ) : (
                    <p className="text-muted-foreground">No holidays on this date.</p>
                  )}
                </TabsContent>
              </Tabs>
            </CardContent>
          </Card>
        </div>
      </div>

      <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Are you sure you want to delete this working calendar?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the working calendar
              and all associated data.
            </AlertDialogDescription>
          </AlertDialogHeader>
          <AlertDialogFooter>
            <AlertDialogCancel>Cancel</AlertDialogCancel>
            <AlertDialogAction onClick={handleDelete} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
              Delete
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>
    </AppLayout>
  );
}
