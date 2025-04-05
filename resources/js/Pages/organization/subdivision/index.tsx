import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/Components/ui/data-table';
import { Button } from '@/Components/ui/button';
import { Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import { useState } from 'react';
import { usePage, Link, router } from '@inertiajs/react';
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
import { ImportDialog } from '@/Components/subdivision/import-dialog';

interface Division {
  id: number;
  name: string;
}


interface SubDivision extends Record<string, never> {
  id: number;
  name: string;
  description: string | null;
  division: {
    id: number;
    name: string;
    department: {
      id: number;
      name: string;
    }
  };
  manager: {
    id: number;
    name: string;
  } | null;
  status: string;
  created_at: string;
  updated_at: string;
  positions_count?: number;
}

interface PaginatedData {
  data: SubDivision[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  subdivisions: PaginatedData;
  divisions: Division[];
  filters: {
    search?: string;
    division_id?: string;
    status?: string;
  };
}

export default function SubDivisionLists({ subdivisions, divisions, filters }: Props) {
  const { url } = usePage();
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [subdivisionToDelete, setSubdivisionToDelete] = useState<number | null>(null);
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  
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
      title: 'Sub Division',
      href: url,
    }
  ];
  
  // Define columns
  const columns = [
    { key: 'name', label: 'Name' },
    { key: 'description', label: 'Description', render: (value: string | null) => value || '-' },
    { 
      key: 'division', 
      label: 'Division',
      render: (_: never, row: SubDivision) => row.division.name
    },
    { 
      key: 'manager', 
      label: 'Manager',
      render: (_: never, row: SubDivision) => row.manager ? row.manager.name : '-'
    },
    { 
      key: 'positions_count', 
      label: 'Positions',
      render: (value: number | undefined) => value || 0
    },
    { 
      key: 'status', 
      label: 'Status',
      render: (value: string) => (
        <Badge variant={value === 'active' ? 'default' : 'secondary'}>
          {value}
        </Badge>
      )
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: never, row: SubDivision) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.subdivision.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.subdivision.edit', row.id)} className="flex items-center">
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
  
  // Define filter options
  const filterOptions = {
    division_id: {
      label: 'Division',
      options: [
        { label: 'All Divisions', value: '' },
        ...divisions.map(division => ({
          label: division.name,
          value: division.id.toString()
        }))
      ]
    },
    status: {
      label: 'Status',
      options: [
        { label: 'All Status', value: '' },
        { label: 'Active', value: 'active' },
        { label: 'Inactive', value: 'inactive' }
      ]
    }
  };
  
  const handleSearch = (query: string) => {
    setSearchQuery(query);
    router.get(route('organization.subdivision.index'), {
      ...filters,
      search: query,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handlePageChange = (page: number) => {
    router.get(route('organization.subdivision.index'), {
      ...filters,
      page
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleFilter = (newFilters: Record<string, never>) => {
    router.get(route('organization.subdivision.index'), {
      ...newFilters,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleDelete = (id: number) => {
    setSubdivisionToDelete(id);
    setIsDeleteDialogOpen(true);
  };
  
  const confirmDelete = () => {
    if (subdivisionToDelete) {
      router.delete(route('organization.subdivision.destroy', subdivisionToDelete));
    }
    setIsDeleteDialogOpen(false);
  };
  
  return (
    <AppLayout title="Sub Division" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-6">Sub Division</h1>
        
        <DataTable
          columns={columns}
          data={subdivisions.data}
          searchPlaceholder="Search sub divisions..."
          totalItems={subdivisions.total}
          currentPage={subdivisions.current_page}
          perPage={subdivisions.per_page}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilter}
          filterOptions={filterOptions}
          addButton={{
            label: "Add Sub Division",
            href: route('organization.subdivision.create')
          }}
          importButton={{
            label: "Import",
            onClick: () => setIsImportDialogOpen(true)
          }}
        />
      </div>
      
      <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Are you sure you want to delete this sub division?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the sub division
              and may affect positions that are assigned to this sub division.
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
        templateUrl="/organization/subdivision/import/template"
      />
    </AppLayout>
  );
}
