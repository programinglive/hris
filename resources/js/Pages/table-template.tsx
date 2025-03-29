import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Plus } from 'lucide-react';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Column {
  key: string;
  label: string;
  render?: (value: any, row: any) => React.ReactNode;
}

interface TableTemplateProps {
  title: string;
  breadcrumbs: BreadcrumbItem[];
  columns: Column[];
  data: any[];
  searchPlaceholder?: string;
}

export function TableTemplate({
  title,
  breadcrumbs,
  columns,
  data,
  searchPlaceholder = 'Search...',
}: TableTemplateProps) {
  const [currentPage, setCurrentPage] = useState(1);
  const [searchQuery, setSearchQuery] = useState('');
  const perPage = 10;
  
  // Filter data based on search query
  const filteredData = searchQuery
    ? data.filter((item) => {
        return Object.values(item).some(
          (value) => 
            typeof value === 'string' && 
            value.toLowerCase().includes(searchQuery.toLowerCase())
        );
      })
    : data;
  
  // Paginate data
  const paginatedData = filteredData.slice(
    (currentPage - 1) * perPage,
    currentPage * perPage
  );
  
  const handleSearch = (query: string) => {
    setSearchQuery(query);
    setCurrentPage(1);
  };
  
  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };
  
  return (
    <AppLayout title={title} breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">{title}</h1>
          <Button>
            <Plus className="mr-2 h-4 w-4" />
            Add {title.replace(/s$/, '')}
          </Button>
        </div>
        
        <DataTable
          columns={columns}
          data={paginatedData}
          title={title}
          searchPlaceholder={searchPlaceholder}
          totalItems={filteredData.length}
          currentPage={currentPage}
          perPage={perPage}
          onPageChange={handlePageChange}
          onSearch={handleSearch}
        />
      </div>
    </AppLayout>
  );
}
