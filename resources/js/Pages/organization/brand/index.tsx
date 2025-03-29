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
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { ImportDialog } from '@/components/brand/import-dialog';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
}

interface Brand {
  id: number;
  name: string;
  code: string;
  logo: string | null;
  company: Company | null;
  branch: Branch | null;
  is_active: boolean;
  created_at: string;
}

interface BrandListsProps {
  brands: {
    data: Brand[];
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

export default function BrandLists({ brands, companies, branches, filters }: BrandListsProps) {
  // Ensure we have default values for all props
  const brandsData = brands?.data || [];
  const companiesData = companies || [];
  const branchesData = branches || [];
  const filtersData = filters || {};
  
  const [searchQuery, setSearchQuery] = useState(filtersData.search || '');
  const [companyFilter, setCompanyFilter] = useState(filtersData.company_id || '');
  const [branchFilter, setBranchFilter] = useState(filtersData.branch_id || '');
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [brandToDelete, setBrandToDelete] = useState<Brand | null>(null);
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);

  const handleDelete = (brand: Brand) => {
    setBrandToDelete(brand);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (brandToDelete) {
      router.delete(`/organization/brand/${brandToDelete.id}`);
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
      title: 'Brand',
      href: '/organization/brand',
    }
  ];

  // Define columns for the data table
  const columns = [
    {
      key: 'name',
      label: 'Brand',
      render: (value: string, row: Brand) => (
        <div className="flex items-center gap-3">
          <Avatar className="h-9 w-9">
            <AvatarImage src={row.logo || undefined} alt={value} />
            <AvatarFallback>{value.substring(0, 2).toUpperCase()}</AvatarFallback>
          </Avatar>
          <div className="font-medium">{value}</div>
        </div>
      ),
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
      key: 'branch',
      label: 'Branch',
      render: (value: Branch | null) => {
        return value ? value.name : 'Not Assigned';
      },
    },
    {
      key: 'is_active',
      label: 'Status',
      render: (value: boolean) => {
        return (
          <Badge 
            variant={value ? 'default' : 'secondary'}
            className="capitalize"
          >
            {value ? 'Active' : 'Inactive'}
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
      render: (_: any, row: Brand) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={`/organization/brand/${row.id}`} className="cursor-pointer">
                <Eye className="mr-2 h-4 w-4" />
                View
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={`/organization/brand/${row.id}/edit`}>
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
      '/organization/brand',
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
      '/organization/brand',
      { 
        page: 1, // Reset to first page on new search
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
      '/organization/brand',
      { 
        page: 1, // Reset to first page on filter change
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
    <AppLayout title="Brand" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        {/* Delete Confirmation Dialog */}
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action will permanently delete the brand {brandToDelete?.name}.
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
        
        <DataTable
          title="Brands"
          columns={columns}
          data={brandsData}
          searchPlaceholder="Search brands..."
          totalItems={brands.total}
          currentPage={brands.current_page}
          perPage={brands.per_page}
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
            label: 'Add Brand',
            href: '/organization/brand/create'
          }}
          importButton={{
            label: 'Import Brands',
            onClick: () => setIsImportDialogOpen(true)
          }}
        />
        <ImportDialog 
          isOpen={isImportDialogOpen} 
          onClose={() => setIsImportDialogOpen(false)} 
          templateUrl="/organization/brand/import/template"
          companies={companiesData}
          branches={branchesData}
        />
      </div>
    </AppLayout>
  );
}
