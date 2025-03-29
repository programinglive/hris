import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { usePage } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { ArrowLeft, Mail, Phone, MapPin, Building, Calendar, Edit } from 'lucide-react';
import { Link } from '@inertiajs/react';

interface EmergencyContact {
  name: string | null;
  relationship: string | null;
  phone: string | null;
}

interface EmployeeDetails {
  id: number;
  name: string;
  email: string;
  phone: string | null;
  address: string | null;
  position: string | null;
  department: string | null;
  join_date: string | null;
  exit_date: string | null;
  status: string;
  profile_image: string | null;
  employee_id: string | null;
  gender: string | null;
  birth_date: string | null;
  marital_status: string | null;
  emergency_contact: EmergencyContact;
  company: string | null;
  branch: string | null;
  division: string | null;
  sub_division: string | null;
  level: string | null;
}

interface PageProps {
  employee: EmployeeDetails;
  [key: string]: any;
}

export default function EmployeeDetails() {
  const { url, props } = usePage<PageProps>();
  const { employee } = props;
  
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Employee',
      href: '#',
    },
    {
      title: 'Lists',
      href: '/employee/lists',
    },
    {
      title: 'Details',
      href: url,
    }
  ];
  
  return (
    <AppLayout title="Employee Details" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div className="flex items-center gap-2">
            <Link href="/employee/lists">
              <Button variant="outline" size="icon">
                <ArrowLeft className="h-4 w-4" />
              </Button>
            </Link>
            <h1 className="text-2xl font-bold">Employee Details</h1>
          </div>
          <Link href={`/employee/${employee.id}/edit`}>
            <Button>
              <Edit className="mr-2 h-4 w-4" />
              Edit Employee
            </Button>
          </Link>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {/* Profile Card */}
          <Card className="md:col-span-1">
            <CardHeader className="pb-3">
              <CardTitle>Profile</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="flex flex-col items-center text-center mb-6">
                <Avatar className="h-24 w-24 mb-4">
                  <AvatarImage src={employee.profile_image || undefined} alt={employee.name} />
                  <AvatarFallback className="text-lg">{employee.name.split(' ').map(n => n[0]).join('')}</AvatarFallback>
                </Avatar>
                <h3 className="text-xl font-semibold">{employee.name}</h3>
                <p className="text-muted-foreground">{employee.position || 'No Position'}</p>
                <div className="mt-2 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800">
                  {employee.status}
                </div>
              </div>
              
              <div className="space-y-3">
                <div className="flex items-center">
                  <Mail className="h-4 w-4 mr-2 text-muted-foreground" />
                  <span>{employee.email}</span>
                </div>
                <div className="flex items-center">
                  <Phone className="h-4 w-4 mr-2 text-muted-foreground" />
                  <span>{employee.phone || 'Not provided'}</span>
                </div>
                <div className="flex items-center">
                  <MapPin className="h-4 w-4 mr-2 text-muted-foreground" />
                  <span>{employee.address || 'Not provided'}</span>
                </div>
                <div className="flex items-center">
                  <Building className="h-4 w-4 mr-2 text-muted-foreground" />
                  <span>{employee.department || 'Not assigned'}</span>
                </div>
                <div className="flex items-center">
                  <Calendar className="h-4 w-4 mr-2 text-muted-foreground" />
                  <span>Joined: {employee.join_date || 'Not provided'}</span>
                </div>
              </div>
            </CardContent>
          </Card>
          
          {/* Details Tabs */}
          <Card className="md:col-span-2">
            <CardContent className="pt-6">
              <Tabs defaultValue="personal">
                <TabsList className="mb-4">
                  <TabsTrigger value="personal">Personal Info</TabsTrigger>
                  <TabsTrigger value="employment">Employment</TabsTrigger>
                  <TabsTrigger value="education">Education</TabsTrigger>
                </TabsList>
                
                <TabsContent value="personal" className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Employee ID</p>
                      <p className="font-medium">{employee.employee_id || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Gender</p>
                      <p className="font-medium">{employee.gender || 'Not provided'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Birth Date</p>
                      <p className="font-medium">{employee.birth_date || 'Not provided'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Marital Status</p>
                      <p className="font-medium">{employee.marital_status || 'Not provided'}</p>
                    </div>
                  </div>
                  
                  <div className="mt-6">
                    <h3 className="text-lg font-medium mb-3">Emergency Contact</h3>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div className="space-y-1">
                        <p className="text-sm text-muted-foreground">Name</p>
                        <p className="font-medium">{employee.emergency_contact.name || 'Not provided'}</p>
                      </div>
                      <div className="space-y-1">
                        <p className="text-sm text-muted-foreground">Relationship</p>
                        <p className="font-medium">{employee.emergency_contact.relationship || 'Not provided'}</p>
                      </div>
                      <div className="space-y-1">
                        <p className="text-sm text-muted-foreground">Phone</p>
                        <p className="font-medium">{employee.emergency_contact.phone || 'Not provided'}</p>
                      </div>
                    </div>
                  </div>
                </TabsContent>
                
                <TabsContent value="employment" className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Company</p>
                      <p className="font-medium">{employee.company || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Branch</p>
                      <p className="font-medium">{employee.branch || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Department</p>
                      <p className="font-medium">{employee.department || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Division</p>
                      <p className="font-medium">{employee.division || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Sub Division</p>
                      <p className="font-medium">{employee.sub_division || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Position</p>
                      <p className="font-medium">{employee.position || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Level</p>
                      <p className="font-medium">{employee.level || 'Not assigned'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Join Date</p>
                      <p className="font-medium">{employee.join_date || 'Not provided'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Exit Date</p>
                      <p className="font-medium">{employee.exit_date || 'Not provided'}</p>
                    </div>
                    <div className="space-y-1">
                      <p className="text-sm text-muted-foreground">Status</p>
                      <p className="font-medium">{employee.status}</p>
                    </div>
                  </div>
                </TabsContent>
                
                <TabsContent value="education" className="space-y-4">
                  <Card className="border">
                    <CardContent className="p-4 text-center">
                      <p className="text-muted-foreground">No education records available</p>
                    </CardContent>
                  </Card>
                </TabsContent>
              </Tabs>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
