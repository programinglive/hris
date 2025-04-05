import React, { useState } from 'react'
import { router, usePage } from '@inertiajs/react'
import AppLayout from '@/layouts/app/app-layout'
import { Calendar } from '@/Components/ui/calendar'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Button } from '@/Components/ui/button'
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/Components/ui/dialog'
import { Label } from '@/Components/ui/label'
import { Input } from '@/Components/ui/input'
import { Textarea } from '@/Components/ui/textarea'
import { Checkbox } from '@/Components/ui/checkbox'
import { format, isSameDay } from 'date-fns'
import { Badge } from '@/Components/ui/badge'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import { CalendarIcon, PlusCircle } from 'lucide-react'
import { type BreadcrumbItem } from '@/types'

interface Holiday {
  id: number
  name: string
  date: string
  description: string | null
  is_recurring: boolean
  company_id: number
  created_at: string
  updated_at: string
}

interface WorkingCalendar {
  id: number
  name: string
  start_date: string
  end_date: string
  description: string | null
  is_active: boolean
  company_id: number
  created_at: string
  updated_at: string
}

interface WorkingCalendarListsProps {
  pageTitle: string
  workingCalendars: WorkingCalendar[]
  holidays: Holiday[]
  auth: never
  ziggy: never
}

export default function WorkingCalendarLists({ pageTitle, workingCalendars, holidays }: WorkingCalendarListsProps) {
  const { url } = usePage()
  const [selectedDate, setSelectedDate] = useState<Date | undefined>(new Date())
  const [isHolidayDialogOpen, setIsHolidayDialogOpen] = useState(false)
  const [isWorkingCalendarDialogOpen, setIsWorkingCalendarDialogOpen] = useState(false)
  
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
      href: url,
    }
  ]
  
  // Form states
  const [holidayForm, setHolidayForm] = useState({
    name: '',
    date: new Date(),
    description: '',
    is_recurring: false
  })
  
  const [workingCalendarForm, setWorkingCalendarForm] = useState({
    name: '',
    start_date: new Date(),
    end_date: new Date(),
    description: '',
    is_active: true
  })

  // Get holidays for the selected date
  const holidaysOnSelectedDate = selectedDate 
    ? holidays.filter(holiday => isSameDay(new Date(holiday.date), selectedDate))
    : []
  
  // Get working calendars that include the selected date
  const workingCalendarsOnSelectedDate = selectedDate
    ? workingCalendars.filter(calendar => {
        const startDate = new Date(calendar.start_date)
        const endDate = new Date(calendar.end_date)
        return selectedDate >= startDate && selectedDate <= endDate
      })
    : []

  // Function to handle holiday form submission
  const handleHolidaySubmit = (e: React.FormEvent) => {
    e.preventDefault()
    
    router.post('/attendance/holiday', {
      name: holidayForm.name,
      date: format(holidayForm.date, 'yyyy-MM-dd'),
      description: holidayForm.description,
      is_recurring: holidayForm.is_recurring
    }, {
      onSuccess: () => {
        setIsHolidayDialogOpen(false)
        setHolidayForm({
          name: '',
          date: new Date(),
          description: '',
          is_recurring: false
        })
      }
    })
  }

  // Function to handle working calendar form submission
  const handleWorkingCalendarSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    
    router.post('/attendance/working-calendar', {
      name: workingCalendarForm.name,
      start_date: format(workingCalendarForm.start_date, 'yyyy-MM-dd'),
      end_date: format(workingCalendarForm.end_date, 'yyyy-MM-dd'),
      description: workingCalendarForm.description,
      is_active: workingCalendarForm.is_active
    }, {
      onSuccess: () => {
        setIsWorkingCalendarDialogOpen(false)
        setWorkingCalendarForm({
          name: '',
          start_date: new Date(),
          end_date: new Date(),
          description: '',
          is_active: true
        })
      }
    })
  }

  // Custom day content for the calendar
  const renderDayContent = (day: Date) => {
    const dayHolidays = holidays.filter(holiday => isSameDay(new Date(holiday.date), day))
    const isInWorkingCalendar = workingCalendars.some(calendar => {
      const startDate = new Date(calendar.start_date)
      const endDate = new Date(calendar.end_date)
      return day >= startDate && day <= endDate
    })

    return (
      <div className="relative w-full h-full">
        {dayHolidays.length > 0 && (
          <div className="absolute top-0 right-0">
            <Badge variant="destructive" className="h-2 w-2 p-0 rounded-full" />
          </div>
        )}
        {isInWorkingCalendar && (
          <div className="absolute bottom-0 left-0">
            <Badge variant="success" className="h-2 w-2 p-0 rounded-full" />
          </div>
        )}
        <div>{day.getDate()}</div>
      </div>
    )
  }

  return (
    <AppLayout title={pageTitle} breadcrumbs={breadcrumbs}>
      <div className="p-4 sm:p-6 space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">{pageTitle}</h1>
          <div className="flex gap-2">
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
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="date" className="text-right">Date</Label>
                      <Input 
                        type="date"
                        id="date" 
                        value={format(holidayForm.date, 'yyyy-MM-dd')}
                        onChange={(e) => setHolidayForm({...holidayForm, date: new Date(e.target.value)})}
                        className="col-span-3" 
                      />
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
                      <Checkbox 
                        id="is_recurring"
                        checked={holidayForm.is_recurring}
                        onCheckedChange={(checked) => setHolidayForm({...holidayForm, is_recurring: !!checked})}
                        className="col-span-3" 
                      />
                    </div>
                  </div>
                  <DialogFooter>
                    <Button type="submit">Save Holiday</Button>
                  </DialogFooter>
                </form>
              </DialogContent>
            </Dialog>

            <Dialog open={isWorkingCalendarDialogOpen} onOpenChange={setIsWorkingCalendarDialogOpen}>
              <DialogTrigger asChild>
                <Button>
                  <PlusCircle className="mr-2 h-4 w-4" />
                  Add Working Calendar
                </Button>
              </DialogTrigger>
              <DialogContent>
                <DialogHeader>
                  <DialogTitle>Add New Working Calendar</DialogTitle>
                  <DialogDescription>
                    Create a new working calendar for your company.
                  </DialogDescription>
                </DialogHeader>
                <form onSubmit={handleWorkingCalendarSubmit}>
                  <div className="grid gap-4 py-4">
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="name" className="text-right">Name</Label>
                      <Input 
                        id="name" 
                        value={workingCalendarForm.name}
                        onChange={(e) => setWorkingCalendarForm({...workingCalendarForm, name: e.target.value})}
                        className="col-span-3" 
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="start_date" className="text-right">Start Date</Label>
                      <Input 
                        type="date"
                        id="start_date" 
                        value={format(workingCalendarForm.start_date, 'yyyy-MM-dd')}
                        onChange={(e) => setWorkingCalendarForm({...workingCalendarForm, start_date: new Date(e.target.value)})}
                        className="col-span-3" 
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="end_date" className="text-right">End Date</Label>
                      <Input 
                        type="date"
                        id="end_date" 
                        value={format(workingCalendarForm.end_date, 'yyyy-MM-dd')}
                        onChange={(e) => setWorkingCalendarForm({...workingCalendarForm, end_date: new Date(e.target.value)})}
                        className="col-span-3" 
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="description" className="text-right">Description</Label>
                      <Textarea 
                        id="description" 
                        value={workingCalendarForm.description}
                        onChange={(e) => setWorkingCalendarForm({...workingCalendarForm, description: e.target.value})}
                        className="col-span-3" 
                      />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                      <Label htmlFor="is_active" className="text-right">Active</Label>
                      <Checkbox 
                        id="is_active"
                        checked={workingCalendarForm.is_active}
                        onCheckedChange={(checked) => setWorkingCalendarForm({...workingCalendarForm, is_active: !!checked})}
                        className="col-span-3" 
                      />
                    </div>
                  </div>
                  <DialogFooter>
                    <Button type="submit">Save Working Calendar</Button>
                  </DialogFooter>
                </form>
              </DialogContent>
            </Dialog>
          </div>
        </div>

        <Tabs defaultValue="calendar" className="w-full">
          <TabsList className="grid w-full grid-cols-2">
            <TabsTrigger value="calendar">Calendar View</TabsTrigger>
            <TabsTrigger value="list">List View</TabsTrigger>
          </TabsList>
          <TabsContent value="calendar" className="space-y-4">
            <Card>
              <CardHeader>
                <CardTitle>Calendar</CardTitle>
                <CardDescription>Select a date to view holidays and working calendars</CardDescription>
              </CardHeader>
              <CardContent>
                <Calendar
                  mode="single"
                  selected={selectedDate}
                  onSelect={setSelectedDate}
                  className="rounded-md border"
                  initialFocus
                  showOutsideDays
                  components={{
                    Day: ({ date, ...props }: { date: Date; [key: string]: any }) => (
                      <button {...props}>
                        {renderDayContent(date)}
                      </button>
                    )
                  }}
                />
              </CardContent>
            </Card>

            {selectedDate && (
              <Card>
                <CardHeader>
                  <CardTitle>Selected Date Details</CardTitle>
                  <CardDescription>Details for {format(selectedDate, 'MMMM d, yyyy')}</CardDescription>
                </CardHeader>
                <CardContent>
                  <div className="space-y-4">
                    <div>
                      <h3 className="text-lg font-semibold mb-2">Working Calendars</h3>
                      {workingCalendarsOnSelectedDate.length === 0 ? (
                        <p className="text-muted-foreground">No working calendars on this date</p>
                      ) : (
                        <div className="space-y-2">
                          {workingCalendarsOnSelectedDate.map(calendar => (
                            <div key={calendar.id} className="flex items-center gap-2">
                              <Badge variant="success">Active</Badge>
                              <span>{calendar.name}</span>
                            </div>
                          ))}
                        </div>
                      )}
                    </div>

                    <div>
                      <h3 className="text-lg font-semibold mb-2">Holidays</h3>
                      {holidaysOnSelectedDate.length === 0 ? (
                        <p className="text-muted-foreground">No holidays on this date</p>
                      ) : (
                        <div className="space-y-2">
                          {holidaysOnSelectedDate.map(holiday => (
                            <div key={holiday.id} className="flex items-center gap-2">
                              <Badge variant="destructive">Holiday</Badge>
                              <span>{holiday.name}</span>
                              {holiday.is_recurring && (
                                <Badge variant="outline">Recurring</Badge>
                              )}
                            </div>
                          ))}
                        </div>
                      )}
                    </div>
                  </div>
                </CardContent>
              </Card>
            )}
          </TabsContent>

          <TabsContent value="list" className="space-y-4">
            <Card>
              <CardHeader>
                <CardTitle>Working Calendars</CardTitle>
                <CardDescription>List of all working calendars</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {workingCalendars.map(calendar => (
                    <div key={calendar.id} className="flex items-center justify-between p-4 bg-muted rounded-lg">
                      <div>
                        <h3 className="font-medium">{calendar.name}</h3>
                        <p className="text-sm text-muted-foreground">
                          {format(new Date(calendar.start_date), 'MMM d, yyyy')} - 
                          {format(new Date(calendar.end_date), 'MMM d, yyyy')}
                        </p>
                        {calendar.description && (
                          <p className="text-sm text-muted-foreground mt-1">{calendar.description}</p>
                        )}
                      </div>
                      <div className="flex items-center gap-2">
                        <Badge variant={calendar.is_active ? "success" : "outline"}>
                          {calendar.is_active ? "Active" : "Inactive"}
                        </Badge>
                        <Button
                          variant="outline"
                          size="sm"
                          onClick={() => router.get(`/attendance/working-calendar/${calendar.id}`)}
                        >
                          View Details
                        </Button>
                      </div>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>

            <Card>
              <CardHeader>
                <CardTitle>Holidays</CardTitle>
                <CardDescription>List of all holidays</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {holidays.map(holiday => (
                    <div key={holiday.id} className="flex items-center justify-between p-4 bg-muted rounded-lg">
                      <div>
                        <h3 className="font-medium">{holiday.name}</h3>
                        <p className="text-sm text-muted-foreground">
                          {format(new Date(holiday.date), 'MMM d, yyyy')}
                        </p>
                        {holiday.description && (
                          <p className="text-sm text-muted-foreground mt-1">{holiday.description}</p>
                        )}
                      </div>
                      <div className="flex items-center gap-2">
                        <Badge variant={holiday.is_recurring ? "outline" : "destructive"}>
                          {holiday.is_recurring ? "Recurring" : "One-time"}
                        </Badge>
                      </div>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </div>
    </AppLayout>
  )
}
