import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { useState, useEffect } from 'react';
import { useForm } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Props {
  division: {
    id: number;
    name: string;
    department_id: number;
    manager_id: number;
    description: string;
    status: string;
  };
}

export default function EditDivision({ division }: Props) {
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Organization',
      href: '#',
    },
    {
      title: 'Division',
      href: '/organization/division',
    },
    {
      title: 'Edit',
      href: `/organization/division/${division.id}/edit`,
    }
  ];

  // Mock departments data
  const departments = [
    { id: 1, name: 'Engineering' },
    { id: 2, name: 'Design' },
    { id: 3, name: 'Marketing' },
    { id: 4, name: 'Human Resources' },
    { id: 5, name: 'Finance' },
    { id: 6, name: 'Operations' },
    { id: 7, name: 'Sales' },
    { id: 8, name: 'Customer Support' },
    { id: 9, name: 'Research' },
    { id: 10, name: 'Legal' },
  ];

  // Mock managers data
  const managers = [
    { id: 1, name: 'John Doe' },
    { id: 2, name: 'Jane Smith' },
    { id: 3, name: 'Robert Johnson' },
    { id: 4, name: 'Emily Davis' },
    { id: 5, name: 'Michael Wilson' },
  ];

  const { data, setData, put, processing, errors } = useForm({
    name: division.name,
    department_id: division.department_id.toString(),
    manager_id: division.manager_id.toString(),
    description: division.description || '',
    status: division.status,
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    put(`/organization/division/${division.id}`);
  };

  return (
    <AppLayout title="Edit Division" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6">
          <h1 className="text-2xl font-bold">Edit Division</h1>
          <p className="text-gray-500 mt-1">Update division information</p>
        </div>

        <div className="bg-white rounded-md shadow-sm p-6">
          <form onSubmit={handleSubmit}>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-2">
                <Label htmlFor="name">Division Name <span className="text-red-500">*</span></Label>
                <Input
                  id="name"
                  value={data.name}
                  onChange={(e) => setData('name', e.target.value)}
                  placeholder="Enter division name"
                  required
                />
                {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="department_id">Department <span className="text-red-500">*</span></Label>
                <select
                  id="department_id"
                  value={data.department_id}
                  onChange={(e) => setData('department_id', e.target.value)}
                  className="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  required
                >
                  <option value="">Select Department</option>
                  {departments.map((department) => (
                    <option key={department.id} value={department.id}>
                      {department.name}
                    </option>
                  ))}
                </select>
                {errors.department_id && <p className="text-red-500 text-sm">{errors.department_id}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="manager_id">Manager <span className="text-red-500">*</span></Label>
                <select
                  id="manager_id"
                  value={data.manager_id}
                  onChange={(e) => setData('manager_id', e.target.value)}
                  className="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  required
                >
                  <option value="">Select Manager</option>
                  {managers.map((manager) => (
                    <option key={manager.id} value={manager.id}>
                      {manager.name}
                    </option>
                  ))}
                </select>
                {errors.manager_id && <p className="text-red-500 text-sm">{errors.manager_id}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="status">Status <span className="text-red-500">*</span></Label>
                <select
                  id="status"
                  value={data.status}
                  onChange={(e) => setData('status', e.target.value)}
                  className="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  required
                >
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
                {errors.status && <p className="text-red-500 text-sm">{errors.status}</p>}
              </div>

              <div className="space-y-2 md:col-span-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  value={data.description}
                  onChange={(e) => setData('description', e.target.value)}
                  placeholder="Enter division description"
                  rows={4}
                />
                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
              </div>
            </div>

            <div className="mt-6 flex justify-end space-x-3">
              <Button
                type="button"
                variant="outline"
                onClick={() => window.history.back()}
              >
                Cancel
              </Button>
              <Button type="submit" disabled={processing}>
                {processing ? 'Updating...' : 'Update Division'}
              </Button>
            </div>
          </form>
        </div>
      </div>
    </AppLayout>
  );
}
