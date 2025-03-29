import AppLayout from '@/layouts/app/app-layout';
import { useState } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { 
  Select, 
  SelectContent, 
  SelectItem, 
  SelectTrigger, 
  SelectValue 
} from '@/components/ui/select';

interface Company {
  id: number;
  name: string;
}

interface Level {
  id: number;
  name: string;
}

interface SubDivision {
  id: number;
  name: string;
}

interface Props {
  companies: Company[];
  levels: Level[];
  subDivisions: SubDivision[];
}

export default function PositionCreate({ companies, levels, subDivisions }: Props) {
  const { url } = usePage();
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    level_id: '',
    sub_division_id: '',
    company_id: '',
    min_salary: '',
    max_salary: '',
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
      title: 'Position Lists',
      href: route('organization.position.index'),
    },
    {
      title: 'Create Position',
      href: url,
    }
  ];

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSelectChange = (name: string, value: string) => {
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.post(route('organization.position.store'), formData, {
      onError: (errors) => setErrors(errors),
    });
  };

  return (
    <AppLayout title="Create Position" breadcrumbs={breadcrumbs}>
      <Card>
        <CardHeader>
          <CardTitle>Create New Position</CardTitle>
        </CardHeader>
        <CardContent>
          <form onSubmit={handleSubmit} className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-2">
                <Label htmlFor="name">Name</Label>
                <Input
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="Enter position name"
                  className={errors.name ? 'border-red-500' : ''}
                />
                {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="company_id">Company</Label>
                <Select 
                  name="company_id" 
                  value={formData.company_id} 
                  onValueChange={(value) => handleSelectChange('company_id', value)}
                >
                  <SelectTrigger className={errors.company_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select company" />
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
                <Label htmlFor="level_id">Level</Label>
                <Select 
                  name="level_id" 
                  value={formData.level_id} 
                  onValueChange={(value) => handleSelectChange('level_id', value)}
                >
                  <SelectTrigger className={errors.level_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select level" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">None</SelectItem>
                    {levels.map((level) => (
                      <SelectItem key={level.id} value={level.id.toString()}>
                        {level.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.level_id && <p className="text-red-500 text-sm">{errors.level_id}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="sub_division_id">Sub Division</Label>
                <Select 
                  name="sub_division_id" 
                  value={formData.sub_division_id} 
                  onValueChange={(value) => handleSelectChange('sub_division_id', value)}
                >
                  <SelectTrigger className={errors.sub_division_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select sub division" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">None</SelectItem>
                    {subDivisions.map((subDivision) => (
                      <SelectItem key={subDivision.id} value={subDivision.id.toString()}>
                        {subDivision.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.sub_division_id && <p className="text-red-500 text-sm">{errors.sub_division_id}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="min_salary">Minimum Salary</Label>
                <Input
                  id="min_salary"
                  name="min_salary"
                  type="number"
                  min="0"
                  step="0.01"
                  value={formData.min_salary}
                  onChange={handleChange}
                  placeholder="Enter minimum salary"
                  className={errors.min_salary ? 'border-red-500' : ''}
                />
                {errors.min_salary && <p className="text-red-500 text-sm">{errors.min_salary}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="max_salary">Maximum Salary</Label>
                <Input
                  id="max_salary"
                  name="max_salary"
                  type="number"
                  min="0"
                  step="0.01"
                  value={formData.max_salary}
                  onChange={handleChange}
                  placeholder="Enter maximum salary"
                  className={errors.max_salary ? 'border-red-500' : ''}
                />
                {errors.max_salary && <p className="text-red-500 text-sm">{errors.max_salary}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="status">Status</Label>
                <Select 
                  name="status" 
                  value={formData.status} 
                  onValueChange={(value) => handleSelectChange('status', value)}
                >
                  <SelectTrigger className={errors.status ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select status" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="active">Active</SelectItem>
                    <SelectItem value="inactive">Inactive</SelectItem>
                  </SelectContent>
                </Select>
                {errors.status && <p className="text-red-500 text-sm">{errors.status}</p>}
              </div>

              <div className="space-y-2 md:col-span-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  name="description"
                  value={formData.description}
                  onChange={handleChange}
                  placeholder="Enter position description"
                  rows={4}
                  className={errors.description ? 'border-red-500' : ''}
                />
                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
              </div>
            </div>

            <div className="flex justify-end space-x-4">
              <Button
                type="button"
                variant="outline"
                onClick={() => router.get(route('organization.position.index'))}
              >
                Cancel
              </Button>
              <Button type="submit">Save Position</Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </AppLayout>
  );
}
