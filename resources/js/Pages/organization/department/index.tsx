import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import { useState } from 'react';
import { Link, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Badge } from '@/components/ui/badge';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { ImportDialog } from '@/components/department/import-dialog';

interface Manager {
  id: number;
  name: string;
}

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
}

interface Department {
  id: number;
  name: string;
  description: string | null;
  manager: Manager | null;
  company: Company | null;
  branch: Branch | null;
  status: string;
  created_at: string;
}

interface DepartmentListsProps {
  departments: {
    data: Department[];
    current_page: number;
    per_page: number;
    total: number;
    last_page: number;
  };
  companies: Company[];
  branches: Branch[];
  filters: {
    search?: string;
    company_id?: string;
    branch_id?: string;
  };
}

export default function DepartmentLists({ departments, companies, branches, filters }: DepartmentListsProps) {
  // Ensure we have default values for all props
  const departmentsData = departments?.data || [];
  const companiesData = companies || [];
  const branchesData = branches || [];
  const filtersData = filters || {};
  
  const [searchQuery, setSearchQuery] = useState(filtersData.search || '');
  const [companyFilter, setCompanyFilter] = useState(filtersData.company_id || '');
  const [branchFilter, setBranchFilter] = useState(filtersData.branch_id || '');
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [departmentToDelete, setDepartmentToDelete] = useState<Department | null>(null);
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);

  const handleDelete = (department: Department) => {
    setDepartmentToDelete(department);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (departmentToDelete) {
      router.delete(`/organization/department/${departmentToDelete.id}`);
    }
    setIsDeleteDialogOpen(false);
  };

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
      title: 'Department',
      href: '/organization/department',
    }
  ];

  // Define columns for the data table
  const columns = [
    {
      key: 'name',
      label: 'Department Name',
      render: (value: string) => <div className="font-medium">{value}</div>,
    },
    {
      key: 'manager',
      label: 'Manager',
      render: (value: Manager | null) => {
        return value ? value.name : 'Not Assigned';
      },
    },
    {
      key: 'company',
      label: 'Company',
      render: (value: Company | null) => {
        return value ? value.name : 'Not Assigned';
      },
    },
    {
      key: 'branch',
      label: 'Branch',
      render: (value: Branch | null) => {
        return value ? value.name : 'Not Assigned';
      },
    },
    {
      key: 'status',
      label: 'Status',
      render: (value: string) => {
        return (
          <Badge 
            variant={value === 'active' ? 'default' : 'secondary'}
            className="capitalize"
          >
            {value}
          </Badge>
        );
      },
    },
    {
      key: 'created_at',
      label: 'Created',
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: any, row: Department) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={`/organization/department/${row.id}`} className="cursor-pointer">
                <Eye className="mr-2 h-4 w-4" />
                View
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={`/organization/department/${row.id}/edit`}>
                <Edit className="mr-2 h-4 w-4" />
                Edit
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem 
              className="text-red-500 focus:text-red-500"
              onClick={() => handleDelete(row)}
            >
              <Trash2 className="mr-2 h-4 w-4" />
              Delete
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      ),
    },
  ];
  
  // Handle page change
  const handlePageChange = (page: number) => {
    router.get(
      '/organization/department',
      { 
        page,
        search: searchQuery,
        company_id: companyFilter,
        branch_id: branchFilter
      },
      { 
        preserveState: true,
        replace: true 
      }
    );
  };

  // Handle search
  const handleSearch = (query: string) => {
    setSearchQuery(query);
    router.get(
      '/organization/department',
      { 
        page: 1, 
        search: query,
        company_id: companyFilter,
        branch_id: branchFilter
      },
      { 
        preserveState: true,
        replace: true 
      }
    );
  };

  // Handle filter changes
  const handleFilterChange = (filters: Record<string, any>) => {
    const companyId = filters.company_id || '';
    const branchId = filters.branch_id || '';
    
    setCompanyFilter(companyId);
    setBranchFilter(branchId);
    
    router.get(
      '/organization/department',
      { 
        page: 1, 
        search: searchQuery,
        company_id: companyId,
        branch_id: branchId
      },
      { 
        preserveState: true,
        replace: true 
      }
    );
  };

  return (
    <AppLayout title="Department" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action will permanently delete the department {departmentToDelete?.name}.
                This action cannot be undone.
              </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
              <AlertDialogCancel>Cancel</AlertDialogCancel>
              <AlertDialogAction onClick={confirmDelete} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
                Delete
              </AlertDialogAction>
            </AlertDialogFooter>
          </AlertDialogContent>
        </AlertDialog>
        
        {/* Import Dialog */}
        <ImportDialog 
          isOpen={isImportDialogOpen}
          onClose={() => setIsImportDialogOpen(false)}
          templateUrl="/organization/department/import/template"
        />
        
        <h1 className="text-2xl font-bold mb-6">Departments</h1>
        
        <DataTable
          columns={columns}
          data={departmentsData}
          searchPlaceholder="Search departments..."
          totalItems={departments.total}
          currentPage={departments.current_page}
          perPage={departments.per_page}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilterChange}
          filterOptions={{
            company_id: {
              label: 'Company',
              options: companiesData.map(company => ({
                label: company.name,
                value: company.id.toString(),
                id: `company-${company.id}`
              }))
            },
            branch_id: {
              label: 'Branch',
              options: branchesData.map(branch => ({
                label: branch.name,
                value: branch.id.toString(),
                id: `branch-${branch.id}`
              }))
            }
          }}
          addButton={{
            label: 'Add Department',
            href: '/organization/department/create'
          }}
          importButton={{
            label: 'Import Departments',
            onClick: () => setIsImportDialogOpen(true)
          }}
        />
      </div>
    </AppLayout>
  );
}
