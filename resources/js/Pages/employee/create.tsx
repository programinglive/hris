import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { CalendarIcon, Save } from 'lucide-react';
import { useState } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Popover, PopoverContent, PopoverTrigger } from '@/Components/ui/popover';
import { DatePicker } from '@/Components/ui/date-picker';
import { cn } from '@/lib/utils';
import { format } from 'date-fns';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
  company_id: number;
}

interface Brand {
  id: number;
  name: string;
  company_id: number;
}

interface Department {
  id: number;
  name: string;
  parent_id: number | null;
}

interface Division {
  id: number;
  name: string;
  department_id: number;
}

interface SubDivision {
  id: number;
  name: string;
  division_id: number;
}

interface PositionLevel {
  id: number;
  name: string;
}

interface PageProps {
  companies: Company[];
  branches: Branch[];
  brands: Brand[];
  departments: Department[];
  divisions: Division[];
  subdivisions: SubDivision[];
  positionLevels: PositionLevel[];
  departmentNames: string[];
  positions: string[];
  statuses: string[];
  genders: string[];
  maritalStatuses: string[];
  [key: string]: any;
}

export default function EmployeeCreate() {
  const { props } = usePage<PageProps>();
  const { companies, branches, brands, departments, divisions, subdivisions, positionLevels, departmentNames, positions, statuses, genders, maritalStatuses } = props;
  
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    employee_id: '',
    phone: '',
    address: '',
    position: '',
    department: '',
    join_date: '',
    exit_date: '',
    status: 'Active',
    gender: '',
    birth_date: '',
    marital_status: '',
    emergency_contact_name: '',
    emergency_contact_relationship: '',
    emergency_contact_phone: '',
    // Organization fields
    company_id: '',
    branch_id: '',
    brand_id: '',
    department_id: '',
    division_id: '',
    sub_division_id: '',
    position_level_id: '',
  });
  
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [joinDate, setJoinDate] = useState<Date | undefined>(undefined);
  const [exitDate, setExitDate] = useState<Date | undefined>(undefined);
  const [birthDate, setBirthDate] = useState<Date | undefined>(undefined);
  
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Employee',
      href: '/employee/lists',
    },
    {
      title: 'Create',
      href: '/employee/create',
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
    // Convert "none" value to empty string for backend processing
    const processedValue = value === "none" ? "" : value;
    
    setFormData(prev => ({ ...prev, [name]: processedValue }));
    
    // Clear error for this field if it exists
    if (errors[name]) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors[name];
        return newErrors;
      });
    }
  };
  
  const handleJoinDateChange = (date: Date | undefined) => {
    setJoinDate(date);
    if (date) {
      setFormData(prev => ({ ...prev, join_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, join_date: '' }));
    }
  };
  
  const handleExitDateChange = (date: Date | undefined) => {
    setExitDate(date);
    if (date) {
      setFormData(prev => ({ ...prev, exit_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, exit_date: '' }));
    }
  };
  
  const handleBirthDateChange = (date: Date | undefined) => {
    setBirthDate(date);
    if (date) {
      setFormData(prev => ({ ...prev, birth_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, birth_date: '' }));
    }
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.post('/employee', formData, {
      onError: (errors) => {
        setErrors(errors);
      }
    });
  };
  
  return (
    <AppLayout title="Create Employee" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Create New Employee</h1>
        </div>
        
        <form onSubmit={handleSubmit}>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {/* Basic Information */}
            <Card>
              <CardHeader>
                <CardTitle>Basic Information</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="name">Full Name <span className="text-red-500">*</span></Label>
                  <Input
                    id="name"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    placeholder="Enter full name"
                    className={errors.name ? 'border-red-500' : ''}
                  />
                  {errors.name && <p className="text-sm text-red-500">{errors.name}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="email">Email Address <span className="text-red-500">*</span></Label>
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
                  <Label htmlFor="password">Password <span className="text-red-500">*</span></Label>
                  <Input
                    id="password"
                    name="password"
                    type="password"
                    value={formData.password}
                    onChange={handleChange}
                    placeholder="Enter password"
                    className={errors.password ? 'border-red-500' : ''}
                  />
                  {errors.password && <p className="text-sm text-red-500">{errors.password}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="employee_id">Employee ID <span className="text-red-500">*</span></Label>
                  <Input
                    id="employee_id"
                    name="employee_id"
                    value={formData.employee_id}
                    onChange={handleChange}
                    placeholder="Enter employee ID"
                    className={errors.employee_id ? 'border-red-500' : ''}
                  />
                  {errors.employee_id && <p className="text-sm text-red-500">{errors.employee_id}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="phone">Phone Number</Label>
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
                
                <div className="space-y-2">
                  <Label htmlFor="address">Address</Label>
                  <Textarea
                    id="address"
                    name="address"
                    value={formData.address}
                    onChange={handleChange}
                    placeholder="Enter address"
                    className={errors.address ? 'border-red-500' : ''}
                  />
                  {errors.address && <p className="text-sm text-red-500">{errors.address}</p>}
                </div>
              </CardContent>
            </Card>
            
            {/* Organization Information */}
            <Card>
              <CardHeader>
                <CardTitle>Organization Information</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="company_id">Company</Label>
                  <Select
                    value={formData.company_id}
                    onValueChange={(value) => handleSelectChange('company_id', value)}
                  >
                    <SelectTrigger className={errors.company_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select company" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
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
                      <SelectItem value="none">None</SelectItem>
                      {branches
                        .filter(branch => !formData.company_id || branch.company_id.toString() === formData.company_id)
                        .map((branch) => (
                          <SelectItem key={branch.id} value={branch.id.toString()}>{branch.name}</SelectItem>
                        ))}
                    </SelectContent>
                  </Select>
                  {errors.branch_id && <p className="text-sm text-red-500">{errors.branch_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="brand_id">Brand</Label>
                  <Select
                    value={formData.brand_id}
                    onValueChange={(value) => handleSelectChange('brand_id', value)}
                  >
                    <SelectTrigger className={errors.brand_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select brand" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
                      {brands
                        .filter(brand => !formData.company_id || brand.company_id.toString() === formData.company_id)
                        .map((brand) => (
                          <SelectItem key={brand.id} value={brand.id.toString()}>{brand.name}</SelectItem>
                        ))}
                    </SelectContent>
                  </Select>
                  {errors.brand_id && <p className="text-sm text-red-500">{errors.brand_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="department_id">Department</Label>
                  <Select
                    value={formData.department_id}
                    onValueChange={(value) => handleSelectChange('department_id', value)}
                  >
                    <SelectTrigger className={errors.department_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select department" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
                      {departments.map((dept) => (
                        <SelectItem key={dept.id} value={dept.id.toString()}>{dept.name}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.department_id && <p className="text-sm text-red-500">{errors.department_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="division_id">Division</Label>
                  <Select
                    value={formData.division_id}
                    onValueChange={(value) => handleSelectChange('division_id', value)}
                  >
                    <SelectTrigger className={errors.division_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select division" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
                      {divisions
                        .filter(division => !formData.department_id || division.department_id.toString() === formData.department_id)
                        .map((division) => (
                          <SelectItem key={division.id} value={division.id.toString()}>{division.name}</SelectItem>
                        ))}
                    </SelectContent>
                  </Select>
                  {errors.division_id && <p className="text-sm text-red-500">{errors.division_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="sub_division_id">Sub Division</Label>
                  <Select
                    value={formData.sub_division_id}
                    onValueChange={(value) => handleSelectChange('sub_division_id', value)}
                  >
                    <SelectTrigger className={errors.sub_division_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select sub division" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
                      {subdivisions
                        .filter(subdivision => !formData.division_id || subdivision.division_id.toString() === formData.division_id)
                        .map((subdivision) => (
                          <SelectItem key={subdivision.id} value={subdivision.id.toString()}>{subdivision.name}</SelectItem>
                        ))}
                    </SelectContent>
                  </Select>
                  {errors.sub_division_id && <p className="text-sm text-red-500">{errors.sub_division_id}</p>}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="position_level_id">Position Level</Label>
                  <Select
                    value={formData.position_level_id}
                    onValueChange={(value) => handleSelectChange('position_level_id', value)}
                  >
                    <SelectTrigger className={errors.position_level_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select position level" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="none">None</SelectItem>
                      {positionLevels.map((level) => (
                        <SelectItem key={level.id} value={level.id.toString()}>{level.name}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.position_level_id && <p className="text-sm text-red-500">{errors.position_level_id}</p>}
                </div>
              </CardContent>
            </Card>

            {/* Employment Information */}
            <Card>
              <CardHeader>
                <CardTitle>Employment Information</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="department">Legacy Department</Label>
                  <Select
                    value={formData.department}
                    onValueChange={(value) => handleSelectChange('department', value)}
                  >
                    <SelectTrigger className={errors.department ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select department" />
                    </SelectTrigger>
                    <SelectContent>
                      {departmentNames.map((dept) => (
                        <SelectItem key={dept} value={dept}>{dept}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.department && <p className="text-sm text-red-500">{errors.department}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="position">Position</Label>
                  <Select
                    value={formData.position}
                    onValueChange={(value) => handleSelectChange('position', value)}
                  >
                    <SelectTrigger className={errors.position ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select position" />
                    </SelectTrigger>
                    <SelectContent>
                      {positions.map((pos) => (
                        <SelectItem key={pos} value={pos}>{pos}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.position && <p className="text-sm text-red-500">{errors.position}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="join_date">Join Date</Label>
                  <DatePicker
                    date={joinDate}
                    onSelect={handleJoinDateChange}
                    placeholder="Select join date"
                    hasError={!!errors.join_date}
                  />
                  {errors.join_date && <p className="text-sm text-red-500">{errors.join_date}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="exit_date">Exit Date</Label>
                  <DatePicker
                    date={exitDate}
                    onSelect={handleExitDateChange}
                    placeholder="Select exit date"
                    hasError={!!errors.exit_date}
                  />
                  {errors.exit_date && <p className="text-sm text-red-500">{errors.exit_date}</p>}
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
                        <SelectItem key={status} value={status}>{status}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.status && <p className="text-sm text-red-500">{errors.status}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="gender">Gender</Label>
                  <Select
                    value={formData.gender}
                    onValueChange={(value) => handleSelectChange('gender', value)}
                  >
                    <SelectTrigger className={errors.gender ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select gender" />
                    </SelectTrigger>
                    <SelectContent>
                      {genders.map((gender) => (
                        <SelectItem key={gender} value={gender}>{gender}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.gender && <p className="text-sm text-red-500">{errors.gender}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="birth_date">Birth Date</Label>
                  <DatePicker
                    date={birthDate}
                    onSelect={handleBirthDateChange}
                    placeholder="Select birth date"
                    hasError={!!errors.birth_date}
                  />
                  {errors.birth_date && <p className="text-sm text-red-500">{errors.birth_date}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="marital_status">Marital Status</Label>
                  <Select
                    value={formData.marital_status}
                    onValueChange={(value) => handleSelectChange('marital_status', value)}
                  >
                    <SelectTrigger className={errors.marital_status ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select marital status" />
                    </SelectTrigger>
                    <SelectContent>
                      {maritalStatuses.map((status) => (
                        <SelectItem key={status} value={status}>{status}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.marital_status && <p className="text-sm text-red-500">{errors.marital_status}</p>}
                </div>
              </CardContent>
            </Card>
            
            {/* Emergency Contact */}
            <Card>
              <CardHeader>
                <CardTitle>Emergency Contact</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="emergency_contact_name">Contact Name</Label>
                  <Input
                    id="emergency_contact_name"
                    name="emergency_contact_name"
                    value={formData.emergency_contact_name}
                    onChange={handleChange}
                    placeholder="Enter emergency contact name"
                    className={errors.emergency_contact_name ? 'border-red-500' : ''}
                  />
                  {errors.emergency_contact_name && <p className="text-sm text-red-500">{errors.emergency_contact_name}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="emergency_contact_relationship">Relationship</Label>
                  <Input
                    id="emergency_contact_relationship"
                    name="emergency_contact_relationship"
                    value={formData.emergency_contact_relationship}
                    onChange={handleChange}
                    placeholder="Enter relationship"
                    className={errors.emergency_contact_relationship ? 'border-red-500' : ''}
                  />
                  {errors.emergency_contact_relationship && <p className="text-sm text-red-500">{errors.emergency_contact_relationship}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="emergency_contact_phone">Phone Number</Label>
                  <Input
                    id="emergency_contact_phone"
                    name="emergency_contact_phone"
                    value={formData.emergency_contact_phone}
                    onChange={handleChange}
                    placeholder="Enter emergency contact phone"
                    className={errors.emergency_contact_phone ? 'border-red-500' : ''}
                  />
                  {errors.emergency_contact_phone && <p className="text-sm text-red-500">{errors.emergency_contact_phone}</p>}
                </div>
              </CardContent>
            </Card>
            
            {/* Submit Button */}
            <div className="md:col-span-2 flex justify-end">
              <Button type="submit" className="w-full md:w-auto">
                <Save className="mr-2 h-4 w-4" />
                Save Employee
              </Button>
            </div>
          </div>
        </form>
      </div>
    </AppLayout>
  );
}
