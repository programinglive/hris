import React, { useEffect } from 'react'
import AppLayout from '@/layouts/app/app-layout'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import { Switch } from '@/components/ui/switch'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/components/ui/alert-dialog'
import { BreadcrumbItem } from '@/types'
import { ArrowLeft } from 'lucide-react'
import { Link, useForm, router } from '@inertiajs/react'
import { useToast } from "@/components/ui/use-toast"
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react'

interface Company {
  id: number;
  name: string;
}

interface Props {
  companies: Company[];
}

interface FormDataType {
  [key: string]: string | boolean | number | string[];
  name: string;
  code: string;
  description: string;
  requires_approval: boolean;
  is_paid: boolean;
  default_days_per_year: number;
  is_active: boolean;
  company_id: string;
  working_days: string[];
  is_half_day_allowed: boolean;
  is_balance_carry_forward: boolean;
  is_balance_carry_forward_days: number;
  is_balance_carry_forward_months: number;
  is_balance_carry_forward_years: number;
  is_balance_carry_forward_reset: boolean;
  is_balance_carry_forward_reset_days: number;
  is_balance_carry_forward_reset_months: number;
  is_balance_carry_forward_reset_years: number;
  is_balance_carry_forward_reset_date: string;
  is_balance_carry_forward_reset_date_type: string;
  is_balance_carry_forward_reset_date_value: number;
  is_balance_carry_forward_reset_date_value_type: string;
  is_balance_carry_forward_reset_date_value_type_days: number;
  is_balance_carry_forward_reset_date_value_type_months: number;
  is_balance_carry_forward_reset_date_value_type_years: number;
  is_balance_carry_forward_reset_date_value_type_days_value: number;
  is_balance_carry_forward_reset_date_value_type_months_value: number;
  is_balance_carry_forward_reset_date_value_type_years_value: number;
}

export default function CreateLeaveType({ companies }: Props) {
  const { data, setData, post, processing, errors } = useForm<FormDataType>({
    name: '',
    code: '',
    description: '',
    requires_approval: true,
    is_paid: true,
    default_days_per_year: 0,
    is_active: true,
    company_id: '',
    working_days: [],
    is_half_day_allowed: true,
    is_balance_carry_forward: true,
    is_balance_carry_forward_days: 0,
    is_balance_carry_forward_months: 0,
    is_balance_carry_forward_years: 0,
    is_balance_carry_forward_reset: true,
    is_balance_carry_forward_reset_days: 0,
    is_balance_carry_forward_reset_months: 0,
    is_balance_carry_forward_reset_years: 0,
    is_balance_carry_forward_reset_date: '',
    is_balance_carry_forward_reset_date_type: '',
    is_balance_carry_forward_reset_date_value: 0,
    is_balance_carry_forward_reset_date_value_type: '',
    is_balance_carry_forward_reset_date_value_type_days: 0,
    is_balance_carry_forward_reset_date_value_type_months: 0,
    is_balance_carry_forward_reset_date_value_type_years: 0,
    is_balance_carry_forward_reset_date_value_type_days_value: 0,
    is_balance_carry_forward_reset_date_value_type_months_value: 0,
    is_balance_carry_forward_reset_date_value_type_years_value: 0,
  });

  const { toast } = useToast();

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(route('attendance.leave.type.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        toast({
          title: "Success",
          description: "Leave type created successfully",
          duration: 3000
        });
      },
      onError: (errors) => {
        toast({
          title: "Error",
          description: "Failed to create leave type",
          duration: 3000
        });
      },
    });
  };

  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: route('dashboard'),
    },
    {
      title: 'Attendance',
      href: route('attendance'),
    },
    {
      title: 'Leave Types',
      href: route('attendance.leave.type.index'),
    },
    {
      title: 'Create',
      href: route('attendance.leave.type.create'),
    }
  ];

  useEffect(() => {
    if (!processing) {
      router.visit(route('attendance.leave.type.index'));
    }
  }, [processing]);

  return (
    <AppLayout title="Create Leave Type" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="flex items-center justify-between mb-6">
          <h1 className="text-2xl font-bold">Create Leave Type</h1>
          <Link href={route('attendance.leave.type.index')}>
            <Button variant="outline" className="flex items-center gap-2">
              <ArrowLeft className="h-4 w-4" />
              Back to Leave Types
            </Button>
          </Link>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Leave Type Details</CardTitle>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-2">
                  <Label htmlFor="name">Name <span className="text-red-500">*</span></Label>
                  <Input
                    id="name"
                    value={data.name}
                    onChange={e => setData('name', e.target.value)}
                    className="w-full"
                  />
                  {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="code">Code</Label>
                  <Input
                    id="code"
                    value={data.code}
                    onChange={e => setData('code', e.target.value)}
                    className="w-full"
                  />
                  {errors.code && <p className="text-red-500 text-sm">{errors.code}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="company_id">Company <span className="text-red-500">*</span></Label>
                  <Select value={data.company_id.toString()} onValueChange={(value) => setData('company_id', value)}>
                    <SelectTrigger>
                      <SelectValue placeholder="Select a company" />
                    </SelectTrigger>
                    <SelectContent>
                      {companies.map((company) => (
                        <SelectItem key={company.id} value={company.id.toString()}>
                          {company.name}
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.company_id && <p className="text-red-500 text-sm">{errors.company_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="default_days_per_year">Default Days Per Year <span className="text-red-500">*</span></Label>
                  <Input
                    id="default_days_per_year"
                    type="number"
                    min="0"
                    value={data.default_days_per_year}
                    onChange={e => setData('default_days_per_year', parseInt(e.target.value))}
                    className="w-full"
                  />
                  {errors.default_days_per_year && <p className="text-red-500 text-sm">{errors.default_days_per_year}</p>}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  value={data.description}
                  onChange={e => setData('description', e.target.value)}
                  className="w-full"
                />
                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="working_days">Working Days</Label>
                <Input
                  id="working_days"
                  value={data.working_days.join(', ')}
                  onChange={e => setData('working_days', e.target.value.split(', '))}
                  className="w-full"
                />
                {errors.working_days && <p className="text-red-500 text-sm">{errors.working_days}</p>}
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="flex items-center space-x-2">
                  <Switch
                    id="requires_approval"
                    checked={data.requires_approval}
                    onCheckedChange={(checked) => setData('requires_approval', checked)}
                  />
                  <Label htmlFor="requires_approval">Requires Approval</Label>
                  {errors.requires_approval && <p className="text-red-500 text-sm">{errors.requires_approval}</p>}
                </div>

                <div className="flex items-center space-x-2">
                  <Switch
                    id="is_paid"
                    checked={data.is_paid}
                    onCheckedChange={(checked) => setData('is_paid', checked)}
                  />
                  <Label htmlFor="is_paid">Paid Leave</Label>
                  {errors.is_paid && <p className="text-red-500 text-sm">{errors.is_paid}</p>}
                </div>

                <div className="flex items-center space-x-2">
                  <Switch
                    id="is_active"
                    checked={data.is_active}
                    onCheckedChange={(checked) => setData('is_active', checked)}
                  />
                  <Label htmlFor="is_active">Active</Label>
                  {errors.is_active && <p className="text-red-500 text-sm">{errors.is_active}</p>}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="flex items-center space-x-2">
                  <Switch
                    id="is_half_day_allowed"
                    checked={data.is_half_day_allowed}
                    onCheckedChange={(checked) => setData('is_half_day_allowed', checked)}
                  />
                  <Label htmlFor="is_half_day_allowed">Half Day Allowed</Label>
                  {errors.is_half_day_allowed && <p className="text-red-500 text-sm">{errors.is_half_day_allowed}</p>}
                </div>

                <div className="flex items-center space-x-2">
                  <Switch
                    id="is_balance_carry_forward"
                    checked={data.is_balance_carry_forward}
                    onCheckedChange={(checked) => setData('is_balance_carry_forward', checked)}
                  />
                  <Label htmlFor="is_balance_carry_forward">Balance Carry Forward</Label>
                  {errors.is_balance_carry_forward && <p className="text-red-500 text-sm">{errors.is_balance_carry_forward}</p>}
                </div>
              </div>

              <div className="flex justify-end space-x-2">
                <Link href={route('attendance.leave.type.index')}>
                  <Button type="button" variant="outline">Cancel</Button>
                </Link>
                <Button type="submit" disabled={processing}>
                  {processing ? 'Saving...' : 'Create Leave Type'}
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
