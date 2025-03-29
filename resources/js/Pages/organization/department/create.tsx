import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Save } from 'lucide-react';
import { useState } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Manager {
  id: number;
  name: string;
}

interface ParentDepartment {
  id: number;
  name: string;
}

interface PageProps {
  managers: Manager[];
  departments: ParentDepartment[];
  statuses: string[];
  [key: string]: any;
}

export default function DepartmentCreate() {
  const { props } = usePage<PageProps>();
  const { managers, departments, statuses } = props;
  
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    manager_id: '',
    parent_id: '',
    status: 'active',
  });
  
  const [errors, setErrors] = useState<Record<string, string>>({});
  
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
      title: 'Departments',
      href: '/organization/department',
    },
    {
      title: 'Create',
      href: '/organization/department/create',
    }
  ];
  
  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
    
    // Clear error for this field if it exists
    if (errors[name]) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors[name];
        return newErrors;
      });
    }
  };
  
  const handleSelectChange = (name: string, value: string) => {
    setFormData(prev => ({ ...prev, [name]: value }));
    
    // Clear error for this field if it exists
    if (errors[name]) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors[name];
        return newErrors;
      });
    }
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.post('/organization/department', formData, {
      onError: (errors) => {
        setErrors(errors);
      }
    });
  };
  
  return (
    <AppLayout title="Create Department" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Create New Department</h1>
        </div>
        
        <form onSubmit={handleSubmit}>
          <Card>
            <CardHeader>
              <CardTitle>Department Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="name">Department Name <span className="text-red-500">*</span></Label>
                <Input
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="Enter department name"
                  className={errors.name ? 'border-red-500' : ''}
                />
                {errors.name && <p className="text-sm text-red-500">{errors.name}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  name="description"
                  value={formData.description}
                  onChange={handleChange}
                  placeholder="Enter department description"
                  className={errors.description ? 'border-red-500' : ''}
                  rows={4}
                />
                {errors.description && <p className="text-sm text-red-500">{errors.description}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="manager_id">Department Manager</Label>
                <Select
                  value={formData.manager_id}
                  onValueChange={(value) => handleSelectChange('manager_id', value)}
                >
                  <SelectTrigger className={errors.manager_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select manager" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">None</SelectItem>
                    {managers.map((manager) => (
                      <SelectItem key={manager.id} value={manager.id.toString()}>{manager.name}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.manager_id && <p className="text-sm text-red-500">{errors.manager_id}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="parent_id">Parent Department</Label>
                <Select
                  value={formData.parent_id}
                  onValueChange={(value) => handleSelectChange('parent_id', value)}
                >
                  <SelectTrigger className={errors.parent_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select parent department" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">None</SelectItem>
                    {departments.map((department) => (
                      <SelectItem key={department.id} value={department.id.toString()}>{department.name}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.parent_id && <p className="text-sm text-red-500">{errors.parent_id}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="status">Status <span className="text-red-500">*</span></Label>
                <Select
                  value={formData.status}
                  onValueChange={(value) => handleSelectChange('status', value)}
                >
                  <SelectTrigger className={errors.status ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select status" />
                  </SelectTrigger>
                  <SelectContent>
                    {statuses.map((status) => (
                      <SelectItem key={status} value={status}>{status.charAt(0).toUpperCase() + status.slice(1)}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.status && <p className="text-sm text-red-500">{errors.status}</p>}
              </div>
              
              <div className="flex justify-end pt-4">
                <Button type="submit">
                  <Save className="mr-2 h-4 w-4" />
                  Save Department
                </Button>
              </div>
            </CardContent>
          </Card>
        </form>
      </div>
    </AppLayout>
  );
}
