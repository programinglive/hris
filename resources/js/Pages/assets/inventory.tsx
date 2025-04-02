import AppLayout from '@/layouts/app/app-layout';
import { DataTable, type ColumnDef } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Plus, Eye } from 'lucide-react';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface Asset {
  id: number;
  name: string;
  category: string;
  serialNumber: string;
  purchaseDate: string;
  assignedTo: string;
  location: string;
  status: string;
  value: string;
}

// Generate dummy data
const generateDummyData = (count: number): Asset[] => {
  const categories = ['Laptop', 'Desktop', 'Monitor', 'Phone', 'Tablet', 'Printer', 'Server', 'Furniture', 'Vehicle'];
  const statuses = ['In Use', 'Available', 'Under Repair', 'Disposed', 'Lost'];
  const locations = ['Main Office', 'Branch Office', 'Remote', 'Warehouse', 'Client Site'];
  
  return Array.from({ length: count }, (_, i) => {
    const category = categories[Math.floor(Math.random() * categories.length)];
    const status = statuses[Math.floor(Math.random() * statuses.length)];
    const value = (Math.random() * 5000 + 100).toFixed(2);
    
    return {
      id: i + 1,
      name: `${category} ${i + 1}`,
      category,
      serialNumber: `SN-${Math.random().toString(36).substring(2, 10).toUpperCase()}`,
      purchaseDate: new Date(Date.now() - Math.floor(Math.random() * 1000 * 60 * 60 * 24 * 365 * 3)).toISOString().split('T')[0],
      assignedTo: Math.random() > 0.3 ? `Employee ${Math.floor(Math.random() * 50) + 1}` : '-',
      location: locations[Math.floor(Math.random() * locations.length)],
      status,
      value: `$${value}`,
    };
  });
};

export default function AssetInventory() {
  const { url } = usePage();
  const [currentPage, setCurrentPage] = useState(1);
  const [perPage] = useState(10);
  const [searchTerm, setSearchTerm] = useState('');

  const columns = [
    {
      accessorKey: 'name' as keyof Asset,
      header: 'Name'
    },
    {
      accessorKey: 'category' as keyof Asset,
      header: 'Category'
    },
    {
      accessorKey: 'serialNumber' as keyof Asset,
      header: 'Serial Number'
    },
    {
      accessorKey: 'purchaseDate' as keyof Asset,
      header: 'Purchase Date'
    },
    {
      accessorKey: 'assignedTo' as keyof Asset,
      header: 'Assigned To'
    },
    {
      accessorKey: 'location' as keyof Asset,
      header: 'Location'
    },
    {
      accessorKey: 'status' as keyof Asset,
      header: 'Status',
      cell: ({ row }: { row: Asset }) => {
        let colorClass = '';
        switch (row.status) {
          case 'In Use':
            colorClass = 'bg-blue-100 text-blue-800';
            break;
          case 'Available':
            colorClass = 'bg-green-100 text-green-800';
            break;
          case 'Under Repair':
            colorClass = 'bg-yellow-100 text-yellow-800';
            break;
          case 'Disposed':
            colorClass = 'bg-gray-100 text-gray-800';
            break;
          case 'Lost':
            colorClass = 'bg-red-100 text-red-800';
            break;
          default:
            colorClass = 'bg-gray-100 text-gray-800';
        }
        
        return (
          <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${colorClass}`}>
            {row.status}
          </span>
        );
      }
    },
    {
      accessorKey: 'actions' as keyof Asset,
      header: 'Actions',
      cell: ({ row }: { row: Asset }) => (
        <div className="flex space-x-2">
          <Button variant="outline" size="sm">
            <Eye className="h-4 w-4" />
          </Button>
          <Button variant="outline" size="sm">
            <Edit className="h-4 w-4" />
          </Button>
          <Button variant="outline" size="sm">
            <Trash2 className="h-4 w-4" />
          </Button>
        </div>
      )
    }
  ];

  const assets = generateDummyData(45);
  const filteredData = assets.filter(
    (asset) =>
      Object.values(asset).some((value) =>
        value.toString().toLowerCase().includes(searchTerm.toLowerCase())
      )
  );
  const paginatedData = filteredData.slice(
    (currentPage - 1) * perPage,
    currentPage * perPage
  );

  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };

  const handleSearch = (search: string) => {
    setSearchTerm(search);
    setCurrentPage(1);
  };

  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Assets',
      href: '#',
    },
    {
      title: 'Inventory',
      href: url,
    }
  ];

  return (
    <AppLayout title="Asset Inventory" breadcrumbs={breadcrumbs}>
      <div className="container mx-auto p-4">
        <div className="mb-6 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Asset Inventory</h1>
          <Button>
            <Plus className="mr-2 h-4 w-4" />
            Add Asset
          </Button>
        </div>
        
        <DataTable
          columns={columns}
          data={paginatedData}
          title="Asset Inventory"
          searchPlaceholder="Search assets..."
          pagination={{
            totalItems: filteredData.length,
            currentPage: currentPage,
            perPage: perPage,
            onPageChange: handlePageChange
          }}
          onSearch={handleSearch}
        />
      </div>
    </AppLayout>
  );
}
