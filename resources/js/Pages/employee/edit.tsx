import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { Save } from 'lucide-react';
import { useState, useEffect } from 'react';
import { usePage, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { cn } from '@/lib/utils';
import { format, parseISO, isValid } from 'date-fns';
import { DatePicker } from '@/Components/ui/date-picker';

interface Employee {
  id: number;
  name: string;
  email: string;
  employee_id: string | null;
  position: string | null;
  department: string | null;
  join_date: string | null;
  exit_date: string | null;
  status: string | null;
  gender: string | null;
  birth_date: string | null;
  marital_status: string | null;
  phone: string | null;
  address: string | null;
  emergency_contact_name: string | null;
  emergency_contact_relationship: string | null;
  emergency_contact_phone: string | null;
}

interface PageProps {
  employee: Employee;
  departments: Array<{id: number, name: string, parent_id?: number}>;
  divisions: Array<{id: number, name: string, department_id?: number}>;
  subdivisions: Array<{id: number, name: string, division_id?: number}>;
  positionLevels: Array<{id: number, name: string}>;
  departmentNames: string[];
  positions: string[];
  statuses: string[];
  genders: string[];
  maritalStatuses: string[];
  [key: string]: any;
}

export default function EmployeeEdit() {
  const { props } = usePage<PageProps>();
  const { 
    employee, 
    departments, 
    divisions, 
    subdivisions, 
    positionLevels,
    departmentNames, 
    positions, 
    statuses, 
    genders, 
    maritalStatuses 
  } = props;
  
  const [formData, setFormData] = useState({
    name: employee.name || '',
    email: employee.email || '',
    password: '',
    employee_id: employee.employee_id || '',
    phone: employee.phone || '',
    address: employee.address || '',
    position: employee.position || '',
    department: employee.department || '',
    join_date: employee.join_date || '',
    exit_date: employee.exit_date || '',
    status: employee.status || 'Active',
    gender: employee.gender || '',
    birth_date: employee.birth_date || '',
    marital_status: employee.marital_status || '',
    emergency_contact_name: employee.emergency_contact_name || '',
    emergency_contact_relationship: employee.emergency_contact_relationship || '',
    emergency_contact_phone: employee.emergency_contact_phone || '',
  });
  
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [joinDate, setJoinDate] = useState<Date | undefined>(
    employee.join_date ? parseISO(employee.join_date) : undefined
  );
  const [exitDate, setExitDate] = useState<Date | undefined>(
    employee.exit_date ? parseISO(employee.exit_date) : undefined
  );
  const [birthDate, setBirthDate] = useState<Date | undefined>(
    employee.birth_date ? parseISO(employee.birth_date) : undefined
  );
  
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
      title: 'Edit',
      href: `/employee/${employee.id}/edit`,
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
  
  const handleJoinDateChange = (date: Date | undefined) => {
    setJoinDate(date);
    if (date && isValid(date)) {
      setFormData(prev => ({ ...prev, join_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, join_date: '' }));
    }
    
    // Clear error for this field if it exists
    if (errors.join_date) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors.join_date;
        return newErrors;
      });
    }
  };
  
  const handleExitDateChange = (date: Date | undefined) => {
    setExitDate(date);
    if (date && isValid(date)) {
      setFormData(prev => ({ ...prev, exit_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, exit_date: '' }));
    }
    
    // Clear error for this field if it exists
    if (errors.exit_date) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors.exit_date;
        return newErrors;
      });
    }
  };
  
  const handleBirthDateChange = (date: Date | undefined) => {
    setBirthDate(date);
    if (date && isValid(date)) {
      setFormData(prev => ({ ...prev, birth_date: format(date, 'yyyy-MM-dd') }));
    } else {
      setFormData(prev => ({ ...prev, birth_date: '' }));
    }
    
    // Clear error for this field if it exists
    if (errors.birth_date) {
      setErrors(prev => {
        const newErrors = { ...prev };
        delete newErrors.birth_date;
        return newErrors;
      });
    }
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    router.put(`/employee/${employee.id}`, formData, {
      onError: (errors) => {
        setErrors(errors);
      }
    });
  };
  
  return (
    <AppLayout title="Edit Employee" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Edit Employee: {employee.name}</h1>
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
                  <Label htmlFor="password">Password (leave blank to keep current)</Label>
                  <Input
                    id="password"
                    name="password"
                    type="password"
                    value={formData.password}
                    onChange={handleChange}
                    placeholder="Enter new password"
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
            
            {/* Employment Information */}
            <Card>
              <CardHeader>
                <CardTitle>Employment Information</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="department">Department</Label>
                  <Select
                    value={formData.department}
                    onValueChange={(value) => handleSelectChange('department', value)}
                  >
                    <SelectTrigger className={errors.department ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select department" />
                    </SelectTrigger>
                    <SelectContent>
                      {departmentNames.map((dept, index) => (
                        <SelectItem key={`dept-${index}-${dept}`} value={dept}>{dept}</SelectItem>
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
                      {positions.map((pos, index) => (
                        <SelectItem key={`pos-${index}-${pos}`} value={pos}>{pos}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.position && <p className="text-sm text-red-500">{errors.position}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="join_date">Join Date</Label>
                  <DatePicker 
                    date={joinDate} 
                    onSelect={(date) => {
                      setJoinDate(date);
                      if (date && isValid(date)) {
                        setFormData(prev => ({ ...prev, join_date: format(date, 'yyyy-MM-dd') }));
                      } else {
                        setFormData(prev => ({ ...prev, join_date: '' }));
                      }
                      if (errors.join_date) {
                        setErrors(prev => {
                          const newErrors = { ...prev };
                          delete newErrors.join_date;
                          return newErrors;
                        });
                      }
                    }} 
                    placeholder="Select join date" 
                    hasError={!!errors.join_date}
                  />
                  {errors.join_date && <p className="text-sm text-red-500">{errors.join_date}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="exit_date">Exit Date</Label>
                  <DatePicker 
                    date={exitDate} 
                    onSelect={(date) => {
                      setExitDate(date);
                      if (date && isValid(date)) {
                        setFormData(prev => ({ ...prev, exit_date: format(date, 'yyyy-MM-dd') }));
                      } else {
                        setFormData(prev => ({ ...prev, exit_date: '' }));
                      }
                      if (errors.exit_date) {
                        setErrors(prev => {
                          const newErrors = { ...prev };
                          delete newErrors.exit_date;
                          return newErrors;
                        });
                      }
                    }} 
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
                      {statuses.map((status, index) => (
                        <SelectItem key={`status-${index}-${status}`} value={status}>{status}</SelectItem>
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
                      {genders.map((gender, index) => (
                        <SelectItem key={`gender-${index}-${gender}`} value={gender}>{gender}</SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.gender && <p className="text-sm text-red-500">{errors.gender}</p>}
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="birth_date">Birth Date</Label>
                  <DatePicker 
                    date={birthDate} 
                    onSelect={(date) => {
                      setBirthDate(date);
                      if (date && isValid(date)) {
                        setFormData(prev => ({ ...prev, birth_date: format(date, 'yyyy-MM-dd') }));
                      } else {
                        setFormData(prev => ({ ...prev, birth_date: '' }));
                      }
                      if (errors.birth_date) {
                        setErrors(prev => {
                          const newErrors = { ...prev };
                          delete newErrors.birth_date;
                          return newErrors;
                        });
                      }
                    }} 
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
                      {maritalStatuses.map((status, index) => (
                        <SelectItem key={`marital-${index}-${status}`} value={status}>{status}</SelectItem>
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
                Update Employee
              </Button>
            </div>
          </div>
        </form>
      </div>
    </AppLayout>
  );
}
