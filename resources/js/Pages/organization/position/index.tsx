import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/Components/ui/data-table';
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
import { type ColumnDef } from '@/Components/ui/data-table';
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
import React from 'react';

interface Level {
  id: number;
  name: string;
  level_order: number;
}

interface SubDivision {
  id: number;
  name: string;
  division: {
    id: number;
    name: string;
    department: {
      id: number;
      name: string;
    }
  };
}

interface Position {
  id: number;
  name: string;
  description: string | null;
  level: {
    id: number;
    name: string;
  } | null;
  subDivision: {
    id: number;
    name: string;
    division: {
      id: number;
      name: string;
      department: {
        id: number;
        name: string;
      }
    }
  } | null;
  company: {
    id: number;
    name: string;
  };
  min_salary: number | null;
  max_salary: number | null;
  status: string;
  created_at: string;
  updated_at: string;
}

interface PaginatedData {
  data: Position[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  positions: PaginatedData;
  levels: Level[];
  subDivisions: SubDivision[];
  filters: {
    search?: string;
    level_id?: string;
    sub_division_id?: string;
    status?: string;
  };
}

export default function PositionLists({ positions, levels, subDivisions, filters }: Props) {
  const { url } = usePage();
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [positionToDelete, setPositionToDelete] = useState<number | null>(null);
  
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
      title: 'Position',
      href: url,
    }
  ];
  
  // Format salary as currency
  const formatSalary = (amount: number | null) => {
    if (amount === null) return 'N/A';
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
    }).format(amount);
  };
  
  // Define columns
  const columns: ColumnDef<Position>[] = [
    { key: 'name', label: 'Name' },
    { 
      key: 'level', 
      label: 'Level',
      render: (_, row: Position) => row.level ? row.level.name : 'Not Assigned'
    },
    { 
      key: 'subDivision', 
      label: 'Sub Division',
      render: (_, row: Position) => row.subDivision ? row.subDivision.name : 'Not Assigned'
    },
    { 
      key: 'department', 
      label: 'Department',
      render: (_, row: Position) => 
        row.subDivision ? row.subDivision.division.department.name : 'Not Assigned'
    },
    { 
      key: 'salary_range', 
      label: 'Salary Range',
      render: (_, row: Position) => 
        `${formatSalary(row.min_salary)} - ${formatSalary(row.max_salary)}`
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
      key: 'actions',
      label: 'Actions',
      render: (_, row: Position) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <button className="h-8 w-8 p-0 bg-transparent border-none cursor-pointer">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('organization.position.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('organization.position.edit', row.id)} className="flex items-center">
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
  
  // Define filter options for the DataTable
  const filterOptions = {
    level_id: {
      label: 'Level',
      options: [
        { label: 'All Levels', value: '' },
        ...levels.map(level => ({ 
          label: level.name, 
          value: level.id.toString(),
          id: `level-${level.id}`
        }))
      ]
    },
    sub_division_id: {
      label: 'Sub Division',
      options: [
        { label: 'All Sub Divisions', value: '' },
        ...subDivisions.map(subDiv => ({ 
          label: subDiv.name, 
          value: subDiv.id.toString(),
          id: `subDiv-${subDiv.id}`
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
    router.get(route('organization.position.index'), {
      ...filters,
      search: query,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handlePageChange = (page: number) => {
    router.get(route('organization.position.index'), {
      ...filters,
      page
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleFilter = (filters: Record<string, never>) => {
    router.get(route('organization.position.index'), {
      ...filters,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };
  
  const handleDelete = (id: number) => {
    setPositionToDelete(id);
    setIsDeleteDialogOpen(true);
  };
  
  const confirmDelete = () => {
    if (positionToDelete) {
      router.delete(route('organization.position.destroy', positionToDelete));
    }
    setIsDeleteDialogOpen(false);
  };
  
  return (
    <AppLayout title="Position" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-6">Position</h1>
        
        <DataTable
          columns={columns}
          data={positions.data}
          totalItems={positions.total}
          currentPage={positions.current_page}
          perPage={positions.per_page}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
          onFilter={handleFilter}
          filterOptions={filterOptions}
          searchPlaceholder="Search positions..."
          addButton={{
            label: "Add Position",
            href: route('organization.position.create')
          }}
        />
      </div>
      
      <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Are you sure you want to delete this position?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the position
              and all associated data.
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
    </AppLayout>
  );
}
