import React, { useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { DataTable } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Plus, Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';
import { 
  DropdownMenu, 
  DropdownMenuContent, 
  DropdownMenuItem, 
  DropdownMenuTrigger 
} from '@/components/ui/dropdown-menu';
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
import { Card } from '@/components/ui/card';
import { ImportDialog } from '@/components/branch/import-dialog';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
  code: string;
  address: string;
  city: string | null;
  company: Company | null;
  is_main_branch: boolean;
  is_active: boolean;
  created_at: string;
}

interface FilterState {
  company_id: string | null;
  city: string | null;
}

interface PaginatedData {
  data: Branch[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  branches: PaginatedData;
  companies: Company[];
  filters: {
    search?: string;
    company_id?: string;
    city?: string;
  };
}

interface Action {
  label: string;
  href?: string;
  onClick?: () => void;
  variant?: 'default' | 'outline' | 'ghost';
  icon?: React.ComponentType<{ className?: string }>;
}

export default function BranchIndex({ branches, companies, filters }: Props) {
  const { url } = usePage();
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [isFilterDialogOpen, setIsFilterDialogOpen] = useState(false);
  const [branchToDelete, setBranchToDelete] = useState<number | null>(null);
  const [filterState, setFilterState] = useState<FilterState>({
    company_id: filters.company_id || null,
    city: filters.city || null,
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
      title: 'Branches',
      href: url,
    }
  ];
  
  // Define columns
  const columns = [
    {
      accessorKey: 'name' as keyof Branch,
      header: 'Branch Name',
      cell: ({ row }: { row: Branch }) => row.name,
    },
    {
      accessorKey: 'code' as keyof Branch,
      header: 'Code',
      cell: ({ row }: { row: Branch }) => row.code,
    },
    {
      accessorKey: 'company' as keyof Branch,
      header: 'Company',
      cell: ({ row }: { row: Branch }) => {
        return row.company ? row.company.name : 'Not Assigned';
      },
    },
    {
      accessorKey: 'city' as keyof Branch,
      header: 'Location',
      cell: ({ row }: { row: Branch }) => {
        const city = row.city;
        const address = row.address;
        return city ? city : (address ? address.substring(0, 30) + (address.length > 30 ? '...' : '') : 'Not specified');
      },
    },
    {
      accessorKey: 'is_active' as keyof Branch,
      header: 'Status',
      cell: ({ row }: { row: Branch }) => (
        <div className="flex gap-2">
          <Badge 
            variant={row.is_active ? 'default' : 'secondary'}
            className="capitalize"
          >
            {row.is_active ? 'Active' : 'Inactive'}
          </Badge>
          {row.is_main_branch && (
            <Badge variant="success">
              Main
            </Badge>
          )}
        </div>
      ),
    },
    {
      accessorKey: 'created_at' as keyof Branch,
      header: 'Created',
      cell: ({ row }: { row: Branch }) => row.created_at,
    },
    {
      accessorKey: 'actions' as keyof Branch,
      header: 'Actions',
      cell: ({ row }: { row: Branch }) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.branch.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.branch.edit', row.id)} className="flex items-center">
                <Edit className="mr-2 h-4 w-4" />
                <span>Edit</span>
              </Link>
            </DropdownMenuItem>
            {!row.is_main_branch && (
              <DropdownMenuItem 
                onClick={() => handleDelete(row.id)}
                className="flex items-center text-red-600 focus:text-red-600 focus:bg-red-50"
              >
                <Trash2 className="mr-2 h-4 w-4" />
                <span>Delete</span>
              </DropdownMenuItem>
            )}
          </DropdownMenuContent>
        </DropdownMenu>
      ),
    },
  ];

  const handleSearch = (query: string) => {
    const newFilters: { [key: string]: string | number | undefined } = {
      ...filters,
      search: query.trim() || undefined,
      page: 1
    };

    // Remove empty filter values
    Object.keys(newFilters).forEach(key => {
      if (!newFilters[key]) {
        delete newFilters[key];
      }
    });

    router.get(route('organization.branch.index'), newFilters, {
      preserveState: true,
      replace: true
    });
  };

  const handlePageChange = (page: number) => {
    const newFilters: { [key: string]: string | number | undefined } = {
      page
    };

    if (filters.search) {
      newFilters.search = filters.search;
    }

    if (filterState.company_id) {
      newFilters.company_id = filterState.company_id;
    }

    if (filterState.city) {
      newFilters.city = filterState.city;
    }

    router.get(route('organization.branch.index'), newFilters, {
      preserveState: true,
      replace: true
    });
  };

  const handleDelete = (id: number) => {
    setBranchToDelete(id);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (branchToDelete) {
      router.delete(route('organization.branch.destroy', branchToDelete));
    }
    setIsDeleteDialogOpen(false);
  };

  const handleFilter = () => {
    const newFilters: { [key: string]: string | number | undefined } = {
      ...filters,
      page: 1
    };

    if (filterState.company_id !== null && filterState.company_id !== '') {
      newFilters.company_id = filterState.company_id;
    }

    if (filterState.city !== null && filterState.city !== '') {
      newFilters.city = filterState.city;
    }

    router.get(route('organization.branch.index'), newFilters, {
      preserveState: true,
      replace: true
    });
    setIsFilterDialogOpen(false);
  };

  const resetFilters = () => {
    setFilterState({
      company_id: null,
      city: null,
    });
    router.get(route('organization.branch.index'), {
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
    setIsFilterDialogOpen(false);
  };

  const actions: Action[] = [
    {
      label: "Add Branch",
      href: route('organization.branch.create'),
      variant: "default",
      icon: Plus
    },
    {
      label: "Import",
      onClick: () => setIsImportDialogOpen(true),
      variant: "outline",
      icon: Plus
    }
  ];

  return (
    <AppLayout title="Branches" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <Card className="p-6">
          <DataTable<Branch>
            data={branches.data}
            columns={columns}
            title="Branches"
            searchPlaceholder="Search branches..."
            pagination={{
              totalItems: branches.total,
              currentPage: branches.current_page,
              perPage: branches.per_page,
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
                    company_id: null,
                    city: null,
                  });
                  // Reset URL query parameters
                  router.get(route('organization.branch.index'), {
                    page: 1,
                    filter_dialog: true,
                  }, {
                    preserveState: true,
                    replace: true
                  });
                }
              },
              title: "Filter Branches",
              description: "Use these filters to narrow down your branch search. You can filter by company and city.",
              fields: [
                {
                  label: "Company",
                  type: "select",
                  name: "company_id",
                  options: companies.map(company => ({
                    value: company.id.toString(),
                    label: company.name
                  })),
                  placeholder: "Select Company"
                },
                {
                  label: "City",
                  type: "text",
                  name: "city",
                  placeholder: "Enter City"
                }
              ],
              state: {
                company_id: filterState.company_id || '',
                city: filterState.city || ''
              },
              onStateChange: (state) => {
                setFilterState({
                  company_id: state.company_id || null,
                  city: state.city || null
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
                This action will permanently delete this branch.
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
          templateUrl={route('organization.branch.import.template')}
          accessibility={{ 
            title: 'Import Branches', 
            description: 'Import branches from an Excel file.' 
          }}
        />
      </div>
    </AppLayout>
  );
}
