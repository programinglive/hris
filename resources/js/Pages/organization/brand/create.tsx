import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { Save, Upload } from 'lucide-react';
import { useState, useRef } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
}

interface PageProps {
  companies: Company[];
  branches: Branch[];
  statuses: string[];
  [key: string]: any;
}

export default function BrandCreate() {
  const { props } = usePage<PageProps>();
  const { companies, branches, statuses } = props;
  const fileInputRef = useRef<HTMLInputElement>(null);
  
  const [formData, setFormData] = useState({
    name: '',
    code: '',
    description: '',
    company_id: '',
    branch_id: '',
    is_active: true,
  });
  
  const [logoFile, setLogoFile] = useState<File | null>(null);
  const [logoPreview, setLogoPreview] = useState<string | null>(null);
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
      title: 'Brands',
      href: '/organization/brand',
    },
    {
      title: 'Create',
      href: '/organization/brand/create',
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
  
  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0] || null;
    if (file) {
      setLogoFile(file);
      const reader = new FileReader();
      reader.onloadend = () => {
        setLogoPreview(reader.result as string);
      };
      reader.readAsDataURL(file);
      
      // Clear error for logo if it exists
      if (errors.logo) {
        setErrors(prev => {
          const newErrors = { ...prev };
          delete newErrors.logo;
          return newErrors;
        });
      }
    }
  };
  
  const triggerFileInput = () => {
    fileInputRef.current?.click();
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    const formPayload = new FormData();
    
    // Append all form data
    Object.entries(formData).forEach(([key, value]) => {
      formPayload.append(key, value.toString());
    });
    
    // Append logo file if exists
    if (logoFile) {
      formPayload.append('logo', logoFile);
    }
    
    router.post('/organization/brand', formPayload, {
      onError: (errors) => {
        setErrors(errors);
      }
    });
  };
  
  return (
    <AppLayout title="Create Brand" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Create New Brand</h1>
        </div>
        
        <form onSubmit={handleSubmit}>
          <Card>
            <CardHeader>
              <CardTitle>Brand Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="name">Brand Name <span className="text-red-500">*</span></Label>
                  <Input
                    id="name"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    placeholder="Enter brand name"
                    className={errors.name ? 'border-red-500' : ''}
                  />
                  {errors.name && <p className="text-sm text-red-500">{errors.name}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="code">Brand Code <span className="text-red-500">*</span></Label>
                  <Input
                    id="code"
                    name="code"
                    value={formData.code}
                    onChange={handleChange}
                    placeholder="Enter brand code"
                    className={errors.code ? 'border-red-500' : ''}
                  />
                  {errors.code && <p className="text-sm text-red-500">{errors.code}</p>}
                </div>
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                  <Label htmlFor="branch_id">Branch</Label>
                  <Select
                    value={formData.branch_id}
                    onValueChange={(value) => handleSelectChange('branch_id', value)}
                  >
                    <SelectTrigger className={errors.branch_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select branch" />
                    </SelectTrigger>
                    <SelectContent>
                      {branches.map((branch) => (
                        <SelectItem key={branch.id} value={branch.id.toString()}>{branch.name}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.branch_id && <p className="text-sm text-red-500">{errors.branch_id}</p>}
                </div>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="logo">Brand Logo</Label>
                <div className="flex flex-col items-center gap-4">
                  {logoPreview && (
                    <div className="w-32 h-32 rounded-md overflow-hidden border">
                      <img src={logoPreview} alt="Logo Preview" className="w-full h-full object-contain" />
                    </div>
                  )}
                  
                  <Button 
                    type="button" 
                    variant="outline" 
                    onClick={triggerFileInput}
                    className={errors.logo ? 'border-red-500' : ''}
                  >
                    <Upload className="mr-2 h-4 w-4" />
                    Upload Logo
                  </Button>
                  
                  <input
                    ref={fileInputRef}
                    type="file"
                    accept="image/*"
                    onChange={handleFileChange}
                    className="hidden"
                  />
                  
                  {errors.logo && <p className="text-sm text-red-500">{errors.logo}</p>}
                  <p className="text-sm text-muted-foreground">
                    Recommended: Square image (1:1 ratio), PNG or JPG format, max 2MB
                  </p>
                </div>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  name="description"
                  value={formData.description}
                  onChange={handleChange}
                  placeholder="Enter brand description"
                  className={errors.description ? 'border-red-500' : ''}
                  rows={4}
                />
                {errors.description && <p className="text-sm text-red-500">{errors.description}</p>}
              </div>
              
              <div className="space-y-2">
                <Label>Status</Label>
                <div className="flex items-center space-x-4">
                  <div className="flex items-center space-x-2">
                    <input
                      type="radio"
                      id="active"
                      name="is_active"
                      value="1"
                      checked={formData.is_active === true}
                      onChange={() => setFormData(prev => ({ ...prev, is_active: true }))}
                      className="h-4 w-4 border-gray-300 text-primary focus:ring-primary"
                    />
                    <label htmlFor="active" className="text-sm font-medium">Active</label>
                  </div>
                  
                  <div className="flex items-center space-x-2">
                    <input
                      type="radio"
                      id="inactive"
                      name="is_active"
                      value="0"
                      checked={formData.is_active === false}
                      onChange={() => setFormData(prev => ({ ...prev, is_active: false }))}
                      className="h-4 w-4 border-gray-300 text-primary focus:ring-primary"
                    />
                    <label htmlFor="inactive" className="text-sm font-medium">Inactive</label>
                  </div>
                </div>
              </div>
              
              <div className="flex justify-end">
                <Button type="submit" className="w-full md:w-auto">
                  <Save className="mr-2 h-4 w-4" />
                  Save Brand
                </Button>
              </div>
            </CardContent>
          </Card>
        </form>
      </div>
    </AppLayout>
  );
}
