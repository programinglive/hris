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
import { ImportDialog } from '@/Components/level/import-dialog';


interface Level extends Record<string, never> {
  id: number;
  name: string;
  description: string | null;
  level_order: number;
  company: {
    id: number;
    name: string;
  };
  status: string;
  created_at: string;
  updated_at: string;
  positions_count?: number;
}

interface PaginatedData {
  data: Level[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  levels: PaginatedData;
  filters: {
    search?: string;
    status?: string;
  };
}

export default function LevelLists({ levels, filters }: Props) {
  const { url } = usePage();
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [levelToDelete, setLevelToDelete] = useState<number | null>(null);
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
      title: 'Level',
      href: url,
    }
  ];
  
  // Define columns
  const columns = [
    { key: 'name', label: 'Name' },
    { key: 'description', label: 'Description', render: (value: string | null) => value || '-' },
    { key: 'level_order', label: 'Level Order' },
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
      render: (_: never, row: Level) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.level.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.level.edit', row.id)} className="flex items-center">
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
    router.get(route('organization.level.index'), {
      ...filters,
      search: query,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handlePageChange = (page: number) => {
    router.get(route('organization.level.index'), {
      ...filters,
      page
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleFilter = (newFilters: Record<string, never>) => {
    router.get(route('organization.level.index'), {
      ...newFilters,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleDelete = (id: number) => {
    setLevelToDelete(id);
    setIsDeleteDialogOpen(true);
  };
  
  const confirmDelete = () => {
    if (levelToDelete) {
      router.delete(route('organization.level.destroy', levelToDelete));
    }
    setIsDeleteDialogOpen(false);
  };
  
  return (
    <AppLayout title="Level" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-6">Level</h1>
        
        <DataTable
          columns={columns}
          data={levels.data}
          searchPlaceholder="Search levels..."
          totalItems={levels.total}
          currentPage={levels.current_page}
          perPage={levels.per_page}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilter}
          filterOptions={filterOptions}
          addButton={{
            label: "Add Level",
            href: route('organization.level.create')
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
            <AlertDialogTitle>Are you sure you want to delete this level?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the level
              and may affect positions that are assigned to this level.
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
        templateUrl="/organization/level/import/template"
      />
    </AppLayout>
  );
}
