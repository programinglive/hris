import AppLayout from '@/layouts/app/app-layout';
import { DataTable } from '@/components/ui/data-table';
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
  const [searchQuery, setSearchQuery] = useState('');
  const perPage = 10;
  
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
  
  // Generate dummy data
  const allData = generateDummyData(45);
  
  // Filter data based on search query
  const filteredData = searchQuery
    ? allData.filter(
        (item) =>
          item.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.category.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.serialNumber.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.assignedTo.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.status.toLowerCase().includes(searchQuery.toLowerCase())
      )
    : allData;
  
  // Paginate data
  const paginatedData = filteredData.slice(
    (currentPage - 1) * perPage,
    currentPage * perPage
  );
  
  // Define columns
  const columns = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Name' },
    { key: 'category', label: 'Category' },
    { key: 'serialNumber', label: 'Serial Number' },
    { key: 'purchaseDate', label: 'Purchase Date' },
    { key: 'assignedTo', label: 'Assigned To' },
    { key: 'value', label: 'Value' },
    { 
      key: 'status', 
      label: 'Status',
      render: (value: string) => {
        let colorClass = '';
        switch (value) {
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
            {value}
          </span>
        );
      }
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: any, row: Asset) => (
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
      ),
    },
  ];
  
  const handleSearch = (query: string) => {
    setSearchQuery(query);
    setCurrentPage(1);
  };
  
  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };
  
  return (
    <AppLayout title="Asset Inventory" breadcrumbs={breadcrumbs}>
      <div className="p-6">
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
