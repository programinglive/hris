import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { useState } from 'react';
import { useForm } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Props {
  divisions: Array<{
    id: number;
    name: string;
    department: {
      id: number;
      name: string;
    };
  }>;
  managers: Array<{
    id: number;
    name: string;
  }>;
  selectedDivisionId?: number;
}

export default function CreateSubDivision({ divisions, managers, selectedDivisionId }: Props) {
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
      title: 'Sub Division',
      href: '/organization/subdivision',
    },
    {
      title: 'Create',
      href: '/organization/subdivision/create',
    }
  ];

  const { data, setData, post, processing, errors } = useForm({
    name: '',
    division_id: selectedDivisionId?.toString() || '',
    manager_id: '',
    description: '',
    status: 'active',
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post('/organization/subdivision');
  };

  return (
    <AppLayout title="Create Sub Division" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6">
          <h1 className="text-2xl font-bold">Create New Sub Division</h1>
          <p className="text-gray-500 mt-1">Add a new sub division to your organization structure</p>
        </div>

        <div className="bg-white rounded-md shadow-sm p-6">
          <form onSubmit={handleSubmit}>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-2">
                <Label htmlFor="name">Sub Division Name <span className="text-red-500">*</span></Label>
                <Input
                  id="name"
                  value={data.name}
                  onChange={(e) => setData('name', e.target.value)}
                  placeholder="Enter sub division name"
                  required
                />
                {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="division_id">Division <span className="text-red-500">*</span></Label>
                <select
                  id="division_id"
                  value={data.division_id}
                  onChange={(e) => setData('division_id', e.target.value)}
                  className="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  required
                >
                  <option value="">Select Division</option>
                  {divisions.map((division) => (
                    <option key={division.id} value={division.id}>
                      {division.name} ({division.department.name})
                    </option>
                  ))}
                </select>
                {errors.division_id && <p className="text-red-500 text-sm">{errors.division_id}</p>}
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
                  placeholder="Enter sub division description"
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
                {processing ? 'Creating...' : 'Create Sub Division'}
              </Button>
            </div>
          </form>
        </div>
      </div>
    </AppLayout>
  );
}
