import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { Checkbox } from '@/Components/ui/checkbox';
import { Save } from 'lucide-react';
import { useState } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
  code: string;
  address: string | null;
  city: string | null;
  state: string | null;
  postal_code: string | null;
  country: string | null;
  phone: string | null;
  email: string | null;
  company_id: number;
  is_main_branch: boolean;
  is_active: boolean;
  description: string | null;
}

interface PageProps {
  branch: Branch;
  companies: Company[];
  statuses: string[];
  [key: string]: any;
}

export default function BranchEdit() {
  const { props } = usePage<PageProps>();
  const { branch, companies, statuses } = props;
  
  const [formData, setFormData] = useState({
    name: branch.name || '',
    code: branch.code || '',
    address: branch.address || '',
    city: branch.city || '',
    state: branch.state || '',
    postal_code: branch.postal_code || '',
    country: branch.country || '',
    phone: branch.phone || '',
    email: branch.email || '',
    company_id: branch.company_id ? branch.company_id.toString() : '',
    is_main_branch: branch.is_main_branch || false,
    is_active: branch.is_active,
    description: branch.description || '',
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
      title: 'Branches',
      href: '/organization/branch',
    },
    {
      title: 'Edit',
      href: `/organization/branch/${branch.id}/edit`,
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
    if (name === 'is_active') {
      // Convert string 'true'/'false' to boolean
      setFormData(prev => ({ ...prev, [name]: value === 'true' }));
    } else {
      setFormData(prev => ({ ...prev, [name]: value }));
    }
    
    // Clear error for this field if it exists
    if (errors[name]) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors[name];
        return newErrors;
      });
    }
  };
  
  const handleCheckboxChange = (name: string, checked: boolean) => {
    setFormData(prev => ({ ...prev, [name]: checked }));
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.put(`/organization/branch/${branch.id}`, formData, {
      onError: (errors) => {
        setErrors(errors);
      }
    });
  };
  
  return (
    <AppLayout title="Edit Branch" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Edit Branch: {branch.name}</h1>
        </div>
        
        <form onSubmit={handleSubmit}>
          <Card>
            <CardHeader>
              <CardTitle>Branch Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="name">Branch Name <span className="text-red-500">*</span></Label>
                  <Input
                    id="name"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    placeholder="Enter branch name"
                    className={errors.name ? 'border-red-500' : ''}
                  />
                  {errors.name && <p className="text-sm text-red-500">{errors.name}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="code">Branch Code <span className="text-red-500">*</span></Label>
                  <Input
                    id="code"
                    name="code"
                    value={formData.code}
                    onChange={handleChange}
                    placeholder="Enter branch code"
                    className={errors.code ? 'border-red-500' : ''}
                  />
                  {errors.code && <p className="text-sm text-red-500">{errors.code}</p>}
                </div>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="company_id">Company <span className="text-red-500">*</span></Label>
                <Select
                  value={formData.company_id}
                  onValueChange={(value) => handleSelectChange('company_id', value)}
                >
                  <SelectTrigger className={errors.company_id ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select company" />
                  </SelectTrigger>
                  <SelectContent>
                    {companies.map((company) => (
                      <SelectItem key={company.id} value={company.id.toString()}>{company.name}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                {errors.company_id && <p className="text-sm text-red-500">{errors.company_id}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="address">Address</Label>
                <Textarea
                  id="address"
                  name="address"
                  value={formData.address}
                  onChange={handleChange}
                  placeholder="Enter branch address"
                  className={errors.address ? 'border-red-500' : ''}
                  rows={3}
                />
                {errors.address && <p className="text-sm text-red-500">{errors.address}</p>}
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="city">City</Label>
                  <Input
                    id="city"
                    name="city"
                    value={formData.city}
                    onChange={handleChange}
                    placeholder="Enter city"
                    className={errors.city ? 'border-red-500' : ''}
                  />
                  {errors.city && <p className="text-sm text-red-500">{errors.city}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="state">State/Province</Label>
                  <Input
                    id="state"
                    name="state"
                    value={formData.state}
                    onChange={handleChange}
                    placeholder="Enter state/province"
                    className={errors.state ? 'border-red-500' : ''}
                  />
                  {errors.state && <p className="text-sm text-red-500">{errors.state}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="postal_code">Postal Code</Label>
                  <Input
                    id="postal_code"
                    name="postal_code"
                    value={formData.postal_code}
                    onChange={handleChange}
                    placeholder="Enter postal code"
                    className={errors.postal_code ? 'border-red-500' : ''}
                  />
                  {errors.postal_code && <p className="text-sm text-red-500">{errors.postal_code}</p>}
                </div>
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="country">Country</Label>
                  <Input
                    id="country"
                    name="country"
                    value={formData.country}
                    onChange={handleChange}
                    placeholder="Enter country"
                    className={errors.country ? 'border-red-500' : ''}
                  />
                  {errors.country && <p className="text-sm text-red-500">{errors.country}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="phone">Phone</Label>
                  <Input
                    id="phone"
                    name="phone"
                    value={formData.phone}
                    onChange={handleChange}
                    placeholder="Enter phone number"
                    className={errors.phone ? 'border-red-500' : ''}
                  />
                  {errors.phone && <p className="text-sm text-red-500">{errors.phone}</p>}
                </div>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="email">Email</Label>
                <Input
                  id="email"
                  name="email"
                  type="email"
                  value={formData.email}
                  onChange={handleChange}
                  placeholder="Enter email address"
                  className={errors.email ? 'border-red-500' : ''}
                />
                {errors.email && <p className="text-sm text-red-500">{errors.email}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  name="description"
                  value={formData.description}
                  onChange={handleChange}
                  placeholder="Enter branch description"
                  className={errors.description ? 'border-red-500' : ''}
                  rows={4}
                />
                {errors.description && <p className="text-sm text-red-500">{errors.description}</p>}
              </div>
              
              <div className="flex items-center space-x-2">
                <Checkbox 
                  id="is_main_branch" 
                  checked={formData.is_main_branch}
                  onCheckedChange={(checked) => handleCheckboxChange('is_main_branch', checked as boolean)}
                />
                <Label htmlFor="is_main_branch" className="cursor-pointer">
                  Set as Main Branch
                </Label>
                {errors.is_main_branch && <p className="text-sm text-red-500">{errors.is_main_branch}</p>}
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="is_active">Status <span className="text-red-500">*</span></Label>
                <Select
                  value={formData.is_active ? 'true' : 'false'}
                  onValueChange={(value) => handleSelectChange('is_active', value)}
                >
                  <SelectTrigger className={errors.is_active ? 'border-red-500' : ''}>
                    <SelectValue placeholder="Select status" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="true">Active</SelectItem>
                    <SelectItem value="false">Inactive</SelectItem>
                  </SelectContent>
                </Select>
                {errors.is_active && <p className="text-sm text-red-500">{errors.is_active}</p>}
              </div>
              
              <div className="flex justify-end pt-4">
                <Button type="submit">
                  <Save className="mr-2 h-4 w-4" />
                  Update Branch
                </Button>
              </div>
            </CardContent>
          </Card>
        </form>
      </div>
    </AppLayout>
  );
}
