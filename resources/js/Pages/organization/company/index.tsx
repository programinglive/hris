import React, { useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { DataTable } from '@/Components/ui/data-table';
import { Button } from '@/Components/ui/button';
import { Plus, Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';
import { 
  DropdownMenu, 
  DropdownMenuContent, 
  DropdownMenuItem, 
  DropdownMenuTrigger 
} from '@/Components/ui/dropdown-menu';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from '@/Components/ui/alert-dialog';
import { Badge } from '@/Components/ui/badge';
import { Card } from '@/Components/ui/card';
import { ImportDialog } from '@/Components/company/import-dialog';

interface Company {
  id: number;
  name: string;
  email: string;
  phone: string | null;
  city: string | null;
  country: string | null;
  is_active: boolean;
}

interface FilterState {
  status: string | null;
  city: string | null;
  country: string | null;
}

interface PaginatedData {
  data: Company[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  companies: PaginatedData;
  filters: {
    search?: string;
    status?: string;
    city?: string;
    country?: string;
  };
}

interface Action {
  label: string;
  href?: string;
  onClick?: () => void;
  variant?: 'default' | 'outline' | 'ghost';
  icon?: React.ComponentType<{ className?: string }>;
}

export default function CompanyIndex({ companies, filters }: Props) {
  const { url } = usePage();
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [companyToDelete, setCompanyToDelete] = useState<number | null>(null);
  const [isFilterDialogOpen, setIsFilterDialogOpen] = useState(false);
  const [filterState, setFilterState] = useState<FilterState>({
    status: filters.status || null,
    city: filters.city || null,
    country: filters.country || null,
  });
  
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
      title: 'Companies',
      href: url,
    }
  ];
  
  // Define columns
  const columns = [
    {
      accessorKey: 'name' as keyof Company,
      header: 'Name',
      cell: ({ row }: { row: Company }) => row.name,
    },
    {
      accessorKey: 'email' as keyof Company,
      header: 'Email',
      cell: ({ row }: { row: Company }) => row.email,
    },
    {
      accessorKey: 'phone' as keyof Company,
      header: 'Phone',
      cell: ({ row }: { row: Company }) => row.phone || '-',
    },
    { 
      accessorKey: 'location' as keyof Company,
      header: 'Location',
      cell: ({ row }: { row: Company }) => {
        return row.city && row.country 
          ? `${row.city}, ${row.country}`
          : row.city || row.country || '-';
      }
    },
    { 
      accessorKey: 'is_active' as keyof Company,
      header: 'Status',
      cell: ({ row }: { row: Company }) => (
        <Badge variant={row.is_active ? 'default' : 'secondary'}>
          {row.is_active ? 'Active' : 'Inactive'}
        </Badge>
      )
    },
    {
      accessorKey: 'actions' as keyof Company,
      header: 'Actions',
      cell: ({ row }: { row: Company }) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.company.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.company.edit', row.id)} className="flex items-center">
                <Edit className="mr-2 h-4 w-4" />
                <span>Edit</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem 
              onClick={() => handleDelete(row.id)}
              className="flex items-center text-red-600 focus:text-red-600 focus:bg-red-50"
            >
              <Trash2 className="mr-2 h-4 w-4" />
              <span>Delete</span>
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      ),
    },
  ];
  
  const handleSearch = (query: string) => {
    router.get(route('organization.company.index'), {
      ...filters,
      search: query,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handlePageChange = (page: number) => {
    router.get(route('organization.company.index'), {
      ...filters,
      page
    }, {
      preserveState: true,
      replace: true
    });
  };

  const handleDelete = (id: number) => {
    setCompanyToDelete(id);
    setIsDeleteDialogOpen(true);
  };
  
  const confirmDelete = () => {
    if (companyToDelete) {
      router.delete(route('organization.company.destroy', companyToDelete));
    }
    setIsDeleteDialogOpen(false);
  };

  const handleFilter = () => {
    const newFilters: { [key: string]: string | number | undefined } = {
      page: 1
    };

    // Only include filters that have values
    if (filterState.status !== null && filterState.status !== '') {
      newFilters.status = filterState.status;
    }

    if (filterState.city !== null && filterState.city !== '') {
      newFilters.city = filterState.city;
    }

    if (filterState.country !== null && filterState.country !== '') {
      newFilters.country = filterState.country;
    }

    router.get(route('organization.company.index'), newFilters, {
      preserveState: true,
      replace: true
    });
    setIsFilterDialogOpen(false);
  };

  const resetFilters = () => {
    setFilterState({
      status: null,
      city: null,
      country: null,
    });
    router.get(route('organization.company.index'), {
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
    setIsFilterDialogOpen(false);
  };

  const actions: Action[] = [
    {
      label: "Import",
      icon: Plus,
      variant: "outline",
      onClick: () => setIsImportDialogOpen(true)
    },
    {
      label: "Create Company",
      icon: Plus,
      href: route('organization.company.create')
    }
  ];

  return (
    <AppLayout title="Companies" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <Card className="p-6">
          <DataTable<Company>
            data={companies.data}
            columns={columns}
            title="Companies"
            searchPlaceholder="Search companies..."
            pagination={{
              totalItems: companies.total,
              currentPage: companies.current_page,
              perPage: companies.per_page,
              onPageChange: handlePageChange
            }}
            onSearch={handleSearch}
            filterDialog={{
              isOpen: isFilterDialogOpen,
              onOpenChange: (open) => {
                setIsFilterDialogOpen(open);
                if (open) {
                  // Reset filters when dialog opens
                  setFilterState({
                    status: null,
                    city: null,
                    country: null,
                  });
                  // Reset URL query parameters
                  router.get(route('organization.company.index'), {
                    page: 1,
                    status: null,
                    city: null,
                    country: null,
                  }, {
                    preserveState: true,
                    replace: true
                  });
                }
              },
              title: "Filter Companies",
              description: "Refine your search by applying filters below",
              fields: [
                {
                  label: "Status",
                  type: "select",
                  name: "status",
                  options: [
                    { value: "active", label: "Active" },
                    { value: "inactive", label: "Inactive" }
                  ]
                },
                {
                  label: "City",
                  type: "text",
                  name: "city",
                  placeholder: "Enter city name"
                },
                {
                  label: "Country",
                  type: "text",
                  name: "country",
                  placeholder: "Enter country name"
                }
              ],
              state: {
                status: filterState.status || '',
                city: filterState.city || '',
                country: filterState.country || ''
              },
              onStateChange: (state) => {
                setFilterState({
                  status: state.status || null,
                  city: state.city || null,
                  country: state.country || null
                });
              },
              onApply: handleFilter,
              onReset: resetFilters,
              className: "space-y-4"
            }}
            actions={actions}
          />
        </Card>

        {/* Delete Confirmation Dialog */}
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action will permanently delete this company.
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
          templateUrl="/organization/company/import/template"
        />
      </div>
    </AppLayout>
  );
}
