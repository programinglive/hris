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
import { ImportDialog } from '@/components/branch/import-dialog';
import { ReactNode } from 'react';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
  code: string;
  address: string;
  city: string;
  company: Company | null;
  is_main_branch: boolean;
  is_active: boolean;
  created_at: string;
}

interface ColumnDef<T> {
  key: string;
  label: string;
  render?: (value: any, row: T) => ReactNode;
}

interface BranchListsProps {
  branches: {
    data: Branch[];
    meta: {
      current_page: number;
      last_page: number;
      per_page: number;
      total: number;
    };
  };
  companies: Company[];
  cities: string[];
  filters: {
    search?: string;
    company_id?: string;
    city?: string;
  };
}

export default function BranchLists({ branches, companies, cities, filters }: BranchListsProps) {
  // Ensure we have default values for all props
  const branchesData = branches?.data || [];
  const branchesMeta = branches?.meta || { current_page: 1, last_page: 1, per_page: 10, total: 0 };
  const companiesData = companies || [];
  const citiesData = cities || [];
  const filtersData = filters || {};
  
  const [searchQuery, setSearchQuery] = useState(filtersData.search || '');
  const [companyFilter, setCompanyFilter] = useState(filtersData.company_id || '');
  const [cityFilter, setCityFilter] = useState(filtersData.city || '');
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [branchToDelete, setBranchToDelete] = useState<Branch | null>(null);
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  
  const handleDelete = (branch: Branch) => {
    setBranchToDelete(branch);
    setIsDeleteDialogOpen(true);
  };
  
  const confirmDelete = () => {
    if (branchToDelete) {
      router.delete(`/organization/branch/${branchToDelete.id}`);
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
      title: 'Branch',
      href: '/organization/branch',
    }
  ];
  
  // Define columns for the data table
  const columns: ColumnDef<Branch>[] = [
    {
      key: 'name',
      label: 'Branch Name',
      render: (value: string) => <div className="font-medium">{value}</div>,
    },
    {
      key: 'code',
      label: 'Code',
    },
    {
      key: 'company',
      label: 'Company',
      render: (value: Company | null) => {
        return value ? value.name : 'Not Assigned';
      },
    },
    {
      key: 'city',
      label: 'Location',
      render: (value: string | null, row: Branch) => {
        const city = value;
        const address = row.address;
        return city ? city : (address ? address.substring(0, 30) + (address.length > 30 ? '...' : '') : 'Not specified');
      },
    },
    {
      key: 'is_active',
      label: 'Status',
      render: (value: boolean, row: Branch) => {
        const isActive = value;
        const isMainBranch = row.is_main_branch;
        return (
          <div className="flex gap-2">
            <Badge 
              variant={isActive ? 'default' : 'secondary'}
              className="capitalize"
            >
              {isActive ? 'Active' : 'Inactive'}
            </Badge>
            {isMainBranch && (
              <Badge variant="success">
                Main
              </Badge>
            )}
          </div>
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
      render: (value: any, row: Branch) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={`/organization/branch/${row.id}`} className="cursor-pointer">
                <Eye className="mr-2 h-4 w-4" />
                View
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={`/organization/branch/${row.id}/edit`}>
                <Edit className="mr-2 h-4 w-4" />
                Edit
              </Link>
            </DropdownMenuItem>
            {!row.is_main_branch && (
              <DropdownMenuItem 
                className="text-red-500 focus:text-red-500"
                onClick={() => handleDelete(row)}
              >
                <Trash2 className="mr-2 h-4 w-4" />
                Delete
              </DropdownMenuItem>
            )}
          </DropdownMenuContent>
        </DropdownMenu>
      ),
    },
  ];
  
  // Handle page change
  const handlePageChange = (page: number) => {
    router.get(
      '/organization/branch',
      { 
        page,
        search: searchQuery,
        company_id: companyFilter,
        city: cityFilter
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
      '/organization/branch',
      { 
        search: query,
        company_id: companyFilter,
        city: cityFilter
      },
      { 
        preserveState: true,
        replace: true 
      }
    );
  };
  
  // Handle filter change
  const handleFilterChange = (filters: Record<string, any>) => {
    const companyId = filters.company_id || '';
    const city = filters.city || '';
    
    setCompanyFilter(companyId);
    setCityFilter(city);
    
    router.get(
      '/organization/branch',
      { 
        search: searchQuery,
        company_id: companyId,
        city: city
      },
      { 
        preserveState: true,
        replace: true 
      }
    );
  };
  
  // Define filter options for the data table
  const filterOptions = {
    company_id: {
      label: 'Company',
      options: companiesData.map(company => ({
        label: company.name,
        value: company.id.toString(),
        id: `company-${company.id}`
      }))
    },
    city: {
      label: 'Location',
      options: citiesData.map((city, index) => ({
        label: city,
        value: city,
        id: `city-${index}`
      }))
    }
  };
  
  return (
    <AppLayout title="Branch Management" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <DataTable 
          title="Branches"
          columns={columns}
          data={branchesData}
          searchPlaceholder="Search branches..."
          totalItems={branchesMeta.total}
          currentPage={branchesMeta.current_page}
          perPage={branchesMeta.per_page}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilterChange}
          filterOptions={filterOptions}
          addButton={{
            label: 'Add Branch',
            href: '/organization/branch/create'
          }}
          importButton={{
            label: 'Import Branches',
            onClick: () => setIsImportDialogOpen(true)
          }}
        />
        
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action cannot be undone. This will permanently delete the branch 
                <span className="font-semibold"> {branchToDelete?.name}</span>.
              </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
              <AlertDialogCancel>Cancel</AlertDialogCancel>
              <AlertDialogAction onClick={confirmDelete} className="bg-red-600 hover:bg-red-700">
                Delete
              </AlertDialogAction>
            </AlertDialogFooter>
          </AlertDialogContent>
        </AlertDialog>
        
        <ImportDialog 
          isOpen={isImportDialogOpen} 
          onClose={() => setIsImportDialogOpen(false)} 
          templateUrl="/organization/branch/import/template"
        />
      </div>
    </AppLayout>
  );
}
