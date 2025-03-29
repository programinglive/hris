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

interface Props {
  companies: Company[];
}

export default function LevelCreate({ companies }: Props) {
  const { url } = usePage();
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    level_order: 0,
    company_id: '',
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
      title: 'Level Lists',
      href: route('organization.level.index'),
    },
    {
      title: 'Create Level',
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
    
    router.post(route('organization.level.store'), formData, {
      onError: (errors) => setErrors(errors),
    });
  };

  return (
    <AppLayout title="Create Level" breadcrumbs={breadcrumbs}>
      <Card>
        <CardHeader>
          <CardTitle>Create New Level</CardTitle>
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
                  placeholder="Enter level name"
                  className={errors.name ? 'border-red-500' : ''}
                />
                {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="level_order">Level Order</Label>
                <Input
                  id="level_order"
                  name="level_order"
                  type="number"
                  min="0"
                  value={formData.level_order.toString()}
                  onChange={handleChange}
                  placeholder="Enter level order"
                  className={errors.level_order ? 'border-red-500' : ''}
                />
                {errors.level_order && <p className="text-red-500 text-sm">{errors.level_order}</p>}
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
                  placeholder="Enter level description"
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
                onClick={() => router.get(route('organization.level.index'))}
              >
                Cancel
              </Button>
              <Button type="submit">Save Level</Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </AppLayout>
  );
}
