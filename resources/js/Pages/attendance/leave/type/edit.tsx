import React, { useState } from 'react'
import AppLayout from '@/layouts/app/app-layout'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { Label } from '@/components/ui/label'
import { Switch } from '@/components/ui/switch'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { usePage } from '@inertiajs/react'
import { type BreadcrumbItem } from '@/types'
import { ArrowLeft } from 'lucide-react'
import { Link, useForm } from '@inertiajs/react'

interface Company {
  id: number;
  name: string;
}

interface LeaveType {
  id: number;
  name: string;
  code: string;
  description: string | null;
  requires_approval: boolean;
  is_paid: boolean;
  default_days_per_year: number;
  is_active: boolean;
  company_id: number;
}

interface Props {
  leaveType: LeaveType;
  companies: Company[];
}

export default function EditLeaveType({ leaveType, companies }: Props) {
  const { data, setData, put, processing, errors } = useForm({
    name: leaveType.name || '',
    code: leaveType.code || '',
    description: leaveType.description || '',
    requires_approval: leaveType.requires_approval,
    is_paid: leaveType.is_paid,
    default_days_per_year: leaveType.default_days_per_year,
    is_active: leaveType.is_active,
    company_id: leaveType.company_id.toString(),
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
      title: 'Leave Types',
      href: route('attendance.leave.type.index'),
    },
    {
      title: 'Edit',
      href: route('attendance.leave.type.edit', leaveType.id),
    }
  ];

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    put(route('attendance.leave.type.update', leaveType.id));
  };

  return (
    <AppLayout title="Edit Leave Type" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="flex items-center justify-between mb-6">
          <h1 className="text-2xl font-bold">Edit Leave Type</h1>
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
                    placeholder="Enter leave type name"
                  />
                  {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="code">Code</Label>
                  <Input
                    id="code"
                    value={data.code}
                    onChange={e => setData('code', e.target.value)}
                    placeholder="Enter code"
                  />
                  {errors.code && <p className="text-red-500 text-sm">{errors.code}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="company_id">Company <span className="text-red-500">*</span></Label>
                  <Select 
                    value={data.company_id} 
                    onValueChange={(value) => setData('company_id', value)}
                  >
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
                    placeholder="Enter default days per year"
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
                  placeholder="Enter description"
                  rows={4}
                />
                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
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

              <div className="flex justify-end space-x-2">
                <Link href={route('attendance.leave.type.index')}>
                  <Button type="button" variant="outline">Cancel</Button>
                </Link>
                <Button type="submit" disabled={processing}>Update Leave Type</Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
