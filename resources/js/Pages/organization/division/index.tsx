import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import { useState } from 'react';
import { usePage, Link, router } from '@inertiajs/react';
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
import { ImportDialog } from '@/components/division/import-dialog';

interface Department {
  id: number;
  name: string;
}


interface Division {
  id: number;
  name: string;
  description: string | null;
  department: {
    id: number;
    name: string;
  };
  manager: {
    id: number;
    name: string;
  };
  status: string;
  created_at: string;
  updated_at: string;
  sub_divisions_count?: number;
}

interface Props {
  divisions: Division[];
  departments: Department[];
  filters: {
    search?: string;
    department_id?: string;
    status?: string;
  };
}

export default function DivisionLists({ divisions, departments, filters }: Props) {
  const { url } = usePage();
  const [currentPage, setCurrentPage] = useState(1);
  const [searchQuery, setSearchQuery] = useState(filters.search || '');
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [divisionToDelete, setDivisionToDelete] = useState<Division | null>(null);
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  const perPage = 10;
  
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
      title: 'Division',
      href: url,
    }
  ];
  
  // Filter data based on search query
  const filteredData = searchQuery
    ? divisions.filter(
        (item) =>
          item.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.department.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
          (item.description && item.description.toLowerCase().includes(searchQuery.toLowerCase()))
      )
    : divisions;
  
  // Paginate data
  const paginatedData = filteredData.slice(
    (currentPage - 1) * perPage,
    currentPage * perPage
  );
  
  // Define columns
  const columns = [
    { key: 'name', label: 'Name', render: (value: string) => <div className="font-medium">{value}</div> },
    { 
      key: 'department', 
      label: 'Department',
      render: (_: never, row: Division) => row.department.name
    },
    { 
      key: 'manager', 
      label: 'Manager',
      render: (_: never, row: Division) => row.manager.name
    },
    { 
      key: 'sub_divisions', 
      label: 'Sub Divisions',
      render: (_: never, row: Division) => row.sub_divisions_count || 0
    },
    { 
      key: 'status', 
      label: 'Status',
      render: (value: string) => (
        <Badge 
          variant={value === 'active' ? 'default' : 'secondary'}
          className="capitalize"
        >
          {value}
        </Badge>
      )
    },
    {
      key: 'created_at',
      label: 'Created',
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: never, row: Division) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.division.show', row.id)} className="cursor-pointer">
                <Eye className="mr-2 h-4 w-4" />
                View
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.division.edit', row.id)}>
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
  
  const handleDelete = (division: Division) => {
    setDivisionToDelete(division);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (divisionToDelete) {
      router.delete(route('organization.division.destroy', divisionToDelete.id));
    }
    setIsDeleteDialogOpen(false);
  };
  
  const handleSearch = (query: string) => {
    setSearchQuery(query);
    setCurrentPage(1);
  };
  
  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };
  
  const handleFilterChange = (filters: Record<string, never>) => {
    router.get(route('organization.division.index'), filters, {
      preserveState: true,
      replace: true
    });
  };
  
  return (
    <AppLayout title="Division" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action will permanently delete the division {divisionToDelete?.name}.
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
          templateUrl="/organization/division/import/template"
        />
        
        <h1 className="text-2xl font-bold mb-6">Division</h1>
        
        <DataTable
          columns={columns}
          data={paginatedData}
          searchPlaceholder="Search divisions..."
          totalItems={filteredData.length}
          currentPage={currentPage}
          perPage={perPage}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilterChange}
          filterOptions={{
            department_id: {
              label: 'Department',
              options: [
                ...departments.map(dept => ({
                  label: dept.name,
                  value: dept.id.toString(),
                  id: `dept-${dept.id}`
                }))
              ]
            },
            status: {
              label: 'Status',
              options: [
                { label: 'Active', value: 'active' },
                { label: 'Inactive', value: 'inactive' }
              ]
            }
          }}
          addButton={{
            label: "Add Division",
            href: route('organization.division.create')
          }}
          importButton={{
            label: "Import Divisions",
            onClick: () => setIsImportDialogOpen(true)
          }}
        />
      </div>
    </AppLayout>
  );
}
