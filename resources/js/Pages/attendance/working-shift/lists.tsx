import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/Components/ui/dialog';
import { Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Switch } from '@/Components/ui/switch';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { Badge } from '@/Components/ui/badge';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { Pencil, Trash2, Plus, Clock } from 'lucide-react';
import { Separator } from '@/Components/ui/separator';

interface WorkingShift {
  id: number | null;
  name: string;
  code: string;
  start_time: string;
  end_time: string;
  break_duration: number;
  total_hours: number;
  description: string | null;
  is_active: boolean;
}

interface WorkingShiftPageProps extends PageProps {
  workingShifts: WorkingShift[];
}

const formSchema = z.object({
  name: z.string().min(2, { message: 'Name must be at least 2 characters.' }),
  code: z.string().min(2, { message: 'Code must be at least 2 characters.' }),
  start_time: z.string().regex(/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/, { message: 'Start time must be in HH:MM format.' }),
  end_time: z.string().regex(/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/, { message: 'End time must be in HH:MM format.' }),
  break_duration: z.coerce.number().min(0, { message: 'Break duration must be at least 0 minutes.' }).max(240, { message: 'Break duration cannot exceed 240 minutes.' }),
  description: z.string().optional().nullable(),
  is_active: z.boolean().default(true),
});

export default function WorkingShiftLists({ auth, workingShifts }: WorkingShiftPageProps) {
  const [isAddDialogOpen, setIsAddDialogOpen] = useState(false);
  const [isEditDialogOpen, setIsEditDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [selectedShift, setSelectedShift] = useState<WorkingShift | null>(null);

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: '',
      code: '',
      start_time: '08:00',
      end_time: '17:00',
      break_duration: 60,
      description: '',
      is_active: true,
    },
  });

  const editForm = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: '',
      code: '',
      start_time: '',
      end_time: '',
      break_duration: 60,
      description: '',
      is_active: true,
    },
  });

  const deleteForm = useForm({
    defaultValues: {
      id: '',
    },
  });

  const onSubmit = (values: z.infer<typeof formSchema>) => {
    // Submit the form to create a new working shift
    const formData = new FormData();
    Object.entries(values).forEach(([key, value]) => {
      formData.append(key, value?.toString() || '');
    });

    // Use Inertia to submit the form
    form.post(route('attendance.working-shift.store'), {
      data: formData,
      onSuccess: () => {
        setIsAddDialogOpen(false);
        form.reset();
      },
      onError: (errors) => {
        console.error(errors);
      },
    });
  };

  const onEdit = (shift: WorkingShift) => {
    setSelectedShift(shift);
    editForm.reset({
      name: shift.name,
      code: shift.code,
      start_time: shift.start_time,
      end_time: shift.end_time,
      break_duration: shift.break_duration,
      description: shift.description || '',
      is_active: shift.is_active,
    });
    setIsEditDialogOpen(true);
  };

  const onDelete = (shift: WorkingShift) => {
    setSelectedShift(shift);
    deleteForm.reset({
      id: shift.id?.toString() || '',
    });
    setIsDeleteDialogOpen(true);
  };

  const handleUpdate = (values: z.infer<typeof formSchema>) => {
    if (!selectedShift || selectedShift.id === null) return;

    const formData = new FormData();
    Object.entries(values).forEach(([key, value]) => {
      formData.append(key, value?.toString() || '');
    });

    // Use Inertia to submit the form
    editForm.put(route('attendance.working-shift.update', selectedShift.id), {
      data: formData,
      onSuccess: () => {
        setIsEditDialogOpen(false);
        editForm.reset();
      },
      onError: (errors) => {
        console.error(errors);
      },
    });
  };

  const handleDelete = () => {
    if (!selectedShift || selectedShift.id === null) return;

    // Use Inertia to delete the working shift
    deleteForm.delete(route('attendance.working-shift.destroy', selectedShift.id), {
      onSuccess: () => {
        setIsDeleteDialogOpen(false);
      },
      onError: (errors) => {
        console.error(errors);
      },
    });
  };

  return (
    <AppLayout user={auth.user}>
      <Head title="Working Shifts" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="flex justify-between items-center mb-6">
            <h2 className="text-2xl font-semibold">Working Shifts</h2>
            <Button onClick={() => setIsAddDialogOpen(true)}>
              <Plus className="mr-2 h-4 w-4" /> Add Working Shift
            </Button>
          </div>

          <Card>
            <CardHeader>
              <CardTitle>Working Shift List</CardTitle>
              <CardDescription>
                Manage employee working shifts and schedules
              </CardDescription>
            </CardHeader>
            <CardContent>
              <Table>
                <TableCaption>A list of all working shifts for your company</TableCaption>
                <TableHeader>
                  <TableRow>
                    <TableHead>Name</TableHead>
                    <TableHead>Code</TableHead>
                    <TableHead>Time</TableHead>
                    <TableHead>Break</TableHead>
                    <TableHead>Total Hours</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead className="text-right">Actions</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {workingShifts.map((shift) => (
                    <TableRow key={shift.code}>
                      <TableCell className="font-medium">{shift.name}</TableCell>
                      <TableCell>{shift.code}</TableCell>
                      <TableCell>
                        <div className="flex items-center">
                          <Clock className="mr-2 h-4 w-4" />
                          {shift.start_time} - {shift.end_time}
                        </div>
                      </TableCell>
                      <TableCell>{shift.break_duration} min</TableCell>
                      <TableCell>{shift.total_hours} hours</TableCell>
                      <TableCell>
                        <Badge variant={shift.is_active ? "default" : "outline"}>
                          {shift.is_active ? "Active" : "Inactive"}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-right">
                        <div className="flex justify-end space-x-2">
                          {shift.id !== null && (
                            <>
                              <Button variant="outline" size="icon" onClick={() => onEdit(shift)}>
                                <Pencil className="h-4 w-4" />
                              </Button>
                              <Button variant="outline" size="icon" onClick={() => onDelete(shift)}>
                                <Trash2 className="h-4 w-4" />
                              </Button>
                            </>
                          )}
                        </div>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </CardContent>
          </Card>
        </div>
      </div>

      {/* Add Working Shift Dialog */}
      <Dialog open={isAddDialogOpen} onOpenChange={setIsAddDialogOpen}>
        <DialogContent className="sm:max-w-[525px]">
          <DialogHeader>
            <DialogTitle>Add New Working Shift</DialogTitle>
            <DialogDescription>
              Create a new working shift for your employees
            </DialogDescription>
          </DialogHeader>
          <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-4">
              <div className="grid grid-cols-2 gap-4">
                <FormField
                  control={form.control}
                  name="name"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Name</FormLabel>
                      <FormControl>
                        <Input placeholder="Morning Shift" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                <FormField
                  control={form.control}
                  name="code"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Code</FormLabel>
                      <FormControl>
                        <Input placeholder="SHIFT-MOR" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>

              <div className="grid grid-cols-2 gap-4">
                <FormField
                  control={form.control}
                  name="start_time"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Start Time</FormLabel>
                      <FormControl>
                        <Input type="time" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                <FormField
                  control={form.control}
                  name="end_time"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>End Time</FormLabel>
                      <FormControl>
                        <Input type="time" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>

              <FormField
                control={form.control}
                name="break_duration"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Break Duration (minutes)</FormLabel>
                    <FormControl>
                      <Input type="number" min="0" max="240" {...field} />
                    </FormControl>
                    <FormDescription>
                      Duration of break in minutes (e.g., 60 for a 1-hour break)
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />

              <FormField
                control={form.control}
                name="description"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Description</FormLabel>
                    <FormControl>
                      <Textarea placeholder="Standard morning shift with 1-hour lunch break" {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />

              <FormField
                control={form.control}
                name="is_active"
                render={({ field }) => (
                  <FormItem className="flex flex-row items-center justify-between rounded-lg border p-4">
                    <div className="space-y-0.5">
                      <FormLabel className="text-base">Active Status</FormLabel>
                      <FormDescription>
                        Set whether this working shift is currently active
                      </FormDescription>
                    </div>
                    <FormControl>
                      <Switch
                        checked={field.value}
                        onCheckedChange={field.onChange}
                      />
                    </FormControl>
                  </FormItem>
                )}
              />

              <DialogFooter>
                <Button type="button" variant="outline" onClick={() => setIsAddDialogOpen(false)}>
                  Cancel
                </Button>
                <Button type="submit">Save</Button>
              </DialogFooter>
            </form>
          </Form>
        </DialogContent>
      </Dialog>

      {/* Edit Working Shift Dialog */}
      <Dialog open={isEditDialogOpen} onOpenChange={setIsEditDialogOpen}>
        <DialogContent className="sm:max-w-[525px]">
          <DialogHeader>
            <DialogTitle>Edit Working Shift</DialogTitle>
            <DialogDescription>
              Update the details of this working shift
            </DialogDescription>
          </DialogHeader>
          <Form {...editForm}>
            <form onSubmit={editForm.handleSubmit(handleUpdate)} className="space-y-4">
              <div className="grid grid-cols-2 gap-4">
                <FormField
                  control={editForm.control}
                  name="name"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Name</FormLabel>
                      <FormControl>
                        <Input placeholder="Morning Shift" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                <FormField
                  control={editForm.control}
                  name="code"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Code</FormLabel>
                      <FormControl>
                        <Input placeholder="SHIFT-MOR" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>

              <div className="grid grid-cols-2 gap-4">
                <FormField
                  control={editForm.control}
                  name="start_time"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Start Time</FormLabel>
                      <FormControl>
                        <Input type="time" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                <FormField
                  control={editForm.control}
                  name="end_time"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>End Time</FormLabel>
                      <FormControl>
                        <Input type="time" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>

              <FormField
                control={editForm.control}
                name="break_duration"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Break Duration (minutes)</FormLabel>
                    <FormControl>
                      <Input type="number" min="0" max="240" {...field} />
                    </FormControl>
                    <FormDescription>
                      Duration of break in minutes (e.g., 60 for a 1-hour break)
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />

              <FormField
                control={editForm.control}
                name="description"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Description</FormLabel>
                    <FormControl>
                      <Textarea placeholder="Standard morning shift with 1-hour lunch break" {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />

              <FormField
                control={editForm.control}
                name="is_active"
                render={({ field }) => (
                  <FormItem className="flex flex-row items-center justify-between rounded-lg border p-4">
                    <div className="space-y-0.5">
                      <FormLabel className="text-base">Active Status</FormLabel>
                      <FormDescription>
                        Set whether this working shift is currently active
                      </FormDescription>
                    </div>
                    <FormControl>
                      <Switch
                        checked={field.value}
                        onCheckedChange={field.onChange}
                      />
                    </FormControl>
                  </FormItem>
                )}
              />

              <DialogFooter>
                <Button type="button" variant="outline" onClick={() => setIsEditDialogOpen(false)}>
                  Cancel
                </Button>
                <Button type="submit">Update</Button>
              </DialogFooter>
            </form>
          </Form>
        </DialogContent>
      </Dialog>

      {/* Delete Working Shift Dialog */}
      <Dialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
        <DialogContent className="sm:max-w-[425px]">
          <DialogHeader>
            <DialogTitle>Delete Working Shift</DialogTitle>
            <DialogDescription>
              Are you sure you want to delete this working shift? This action cannot be undone.
            </DialogDescription>
          </DialogHeader>
          <div className="py-4">
            {selectedShift && (
              <div className="space-y-2">
                <div className="flex justify-between">
                  <span className="font-medium">Name:</span>
                  <span>{selectedShift.name}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium">Code:</span>
                  <span>{selectedShift.code}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium">Time:</span>
                  <span>{selectedShift.start_time} - {selectedShift.end_time}</span>
                </div>
                <Separator />
              </div>
            )}
          </div>
          <DialogFooter>
            <Button type="button" variant="outline" onClick={() => setIsDeleteDialogOpen(false)}>
              Cancel
            </Button>
            <Button type="button" variant="destructive" onClick={handleDelete}>
              Delete
            </Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </AppLayout>
  );
}
