import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Search, ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight, Plus, ArrowUpDown, Filter } from 'lucide-react';
import { useState, useMemo } from 'react';
import { Link } from '@inertiajs/react';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Label } from '@/components/ui/label';

export interface ColumnDef<TData> {
  accessorKey: keyof TData;
  header: string;
  cell?: ({ row }: { row: TData }) => React.ReactNode;
}

export interface DataTableProps<TData> {
  data: TData[];
  columns: ColumnDef<TData>[];
  title?: string;
  searchPlaceholder?: string;
  pagination?: {
    totalItems: number;
    currentPage: number;
    perPage: number;
    onPageChange: (page: number) => void;
  };
  onSearch?: (query: string) => void;
  filterDialog?: {
    isOpen: boolean;
    onOpenChange: (open: boolean) => void;
    title: string;
    fields: Array<{
      label: string;
      type: 'text' | 'select';
      name: string;
      options?: Array<{ value: string; label: string }>;
    }>;
    state: { [key: string]: string | undefined };
    onStateChange: (state: { [key: string]: string | undefined }) => void;
    onApply: () => void;
    onReset: () => void;
  };
  actions?: Array<{
    label: string;
    href?: string;
    onClick?: () => void;
    variant?: 'default' | 'outline' | 'ghost';
    icon?: React.ComponentType<{ className?: string }>;
  }>;
}

export function DataTable<TData extends Record<string | number | symbol, any>>({
  data,
  columns,
  title,
  searchPlaceholder = 'Search...',
  pagination,
  onSearch,
  filterDialog,
  actions,
}: DataTableProps<TData>) {
  const [search, setSearch] = useState('');
  const [sort, setSort] = useState<{ field: keyof TData; direction: 'asc' | 'desc' } | null>(null);

  const filteredData = useMemo(() => {
    if (!search) return data;
    return data.filter((item) => {
      return columns.some((column) => {
        const value = item[column.accessorKey as keyof TData];
        return String(value).toLowerCase().includes(search.toLowerCase());
      });
    });
  }, [data, search, columns]);

  const sortedData = useMemo(() => {
    if (!sort) return filteredData;
    return [...filteredData].sort((a, b) => {
      const aValue = a[sort.field as keyof TData];
      const bValue = b[sort.field as keyof TData];

      if (aValue === null || aValue === undefined) return 1;
      if (bValue === null || bValue === undefined) return -1;

      if (typeof aValue === 'string' && typeof bValue === 'string') {
        return sort.direction === 'asc' 
          ? aValue.localeCompare(bValue) 
          : bValue.localeCompare(aValue);
      }

      return sort.direction === 'asc' 
        ? (aValue as any) - (bValue as any) 
        : (bValue as any) - (aValue as any);
    });
  }, [filteredData, sort]);

  const handleSort = (field: keyof TData) => {
    if (sort?.field === field) {
      setSort({
        field,
        direction: sort.direction === 'asc' ? 'desc' : 'asc',
      });
    } else {
      setSort({
        field,
        direction: 'asc',
      });
    }
  };

  return (
    <div className="space-y-6">
      {title && (
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-xl font-semibold">{title}</h2>
          <div className="flex items-center gap-4">
            <Input
              type="text"
              placeholder={searchPlaceholder}
              value={search}
              onChange={(e) => {
                setSearch(e.target.value);
                onSearch?.(e.target.value);
              }}
              className="max-w-sm"
            />
            {filterDialog && (
              <Button
                variant="outline"
                onClick={() => filterDialog.onOpenChange(true)}
              >
                <Filter className="mr-2 h-4 w-4" />
                Filter
              </Button>
            )}
            {actions?.map((action, index) => (
              action.href ? (
                <Link
                  key={index}
                  href={action.href}
                  className={`inline-flex items-center gap-2 px-3 py-1 border border-transparent text-sm font-medium rounded-md whitespace-nowrap shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary ${
                    action.variant === 'outline' ? 'bg-white text-primary border-primary hover:bg-primary/10' : ''
                  }`}
                >
                  {action.icon && <action.icon className="h-4 w-4" />}
                  {action.label}
                </Link>
              ) : (
                <Button
                  key={index}
                  variant={action.variant}
                  onClick={action.onClick}
                  className="inline-flex items-center gap-2 px-3 py-1 h-auto whitespace-nowrap"
                >
                  {action.icon && <action.icon className="h-4 w-4" />}
                  {action.label}
                </Button>
              )
            ))}
          </div>
        </div>
      )}

      <div className="rounded-md border">
        <Table>
          <TableHeader>
            <TableRow>
              {columns.map((column) => (
                <TableHead key={column.header} className="px-4 py-3">
                  <div className="flex items-center gap-2">
                    {column.header}
                    {column.accessorKey && (
                      <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => handleSort(column.accessorKey)}
                        className="h-8 w-8"
                      >
                        <ArrowUpDown className="h-4 w-4" />
                      </Button>
                    )}
                  </div>
                </TableHead>
              ))}
            </TableRow>
          </TableHeader>
          <TableBody>
            {sortedData.length === 0 ? (
              <TableRow>
                <TableCell colSpan={columns.length} className="h-24 text-center">
                  No results found.
                </TableCell>
              </TableRow>
            ) : (
              <>
                {sortedData.map((row, index) => (
                  <TableRow key={index} className="hover:bg-muted/50">
                    {columns.map((column) => (
                      <TableCell key={column.header} className="px-4 py-3">
                        {column.cell ? column.cell({ row }) : row[column.accessorKey as keyof TData]}
                      </TableCell>
                    ))}
                  </TableRow>
                ))}
              </>
            )}
          </TableBody>
        </Table>
      </div>

      {pagination && (
        <div className="flex items-center justify-between px-6 py-4 border-t">
          <div className="flex items-center gap-4">
            <Button
              variant="outline"
              size="sm"
              onClick={() => pagination.onPageChange(1)}
              disabled={pagination.currentPage === 1}
              className="px-4 py-2"
            >
              <ChevronsLeft className="h-4 w-4 mr-2" />
              First
            </Button>
            <Button
              variant="outline"
              size="sm"
              onClick={() => pagination.onPageChange(pagination.currentPage - 1)}
              disabled={pagination.currentPage === 1}
              className="px-4 py-2"
            >
              <ChevronLeft className="h-4 w-4 mr-2" />
              Previous
            </Button>
            <span className="text-sm text-muted-foreground">
              Page {pagination.currentPage} of {Math.ceil(pagination.totalItems / pagination.perPage)}
            </span>
            <Button
              variant="outline"
              size="sm"
              onClick={() => pagination.onPageChange(pagination.currentPage + 1)}
              disabled={pagination.currentPage === Math.ceil(pagination.totalItems / pagination.perPage)}
              className="px-4 py-2"
            >
              Next
              <ChevronRight className="h-4 w-4 ml-2" />
            </Button>
            <Button
              variant="outline"
              size="sm"
              onClick={() => pagination.onPageChange(Math.ceil(pagination.totalItems / pagination.perPage))}
              disabled={pagination.currentPage === Math.ceil(pagination.totalItems / pagination.perPage)}
              className="px-4 py-2"
            >
              Last
              <ChevronsRight className="h-4 w-4 ml-2" />
            </Button>
          </div>
          <div className="text-sm text-muted-foreground">
            Showing {pagination.currentPage * pagination.perPage - pagination.perPage + 1} to{' '}
            {Math.min(pagination.currentPage * pagination.perPage, pagination.totalItems)} of{' '}
            {pagination.totalItems} results
          </div>
        </div>
      )}

      {filterDialog && (
        <Dialog open={filterDialog.isOpen} onOpenChange={filterDialog.onOpenChange}>
          <DialogContent className="sm:max-w-[425px]">
            <DialogHeader>
              <DialogTitle>{filterDialog.title}</DialogTitle>
            </DialogHeader>
            <div className="grid gap-4 py-4">
              <div className="grid grid-cols-2 gap-4">
                {filterDialog.fields.map((field) => (
                  <div key={field.name} className="space-y-2">
                    <Label htmlFor={field.name}>{field.label}</Label>
                    {field.type === "select" ? (
                      <Select
                        value={filterDialog.state[field.name as keyof typeof filterDialog.state]}
                        onValueChange={(value) =>
                          filterDialog.onStateChange({
                            ...filterDialog.state,
                            [field.name]: value
                          })
                        }
                      >
                        <SelectTrigger id={field.name}>
                          <SelectValue placeholder={`Select ${field.label.toLowerCase()}`} />
                        </SelectTrigger>
                        <SelectContent>
                          {field.options?.map((option) => (
                            <SelectItem key={option.value} value={option.value}>
                              {option.label}
                            </SelectItem>
                          ))}
                        </SelectContent>
                      </Select>
                    ) : (
                      <Input
                        id={field.name}
                        value={filterDialog.state[field.name as keyof typeof filterDialog.state] || ''}
                        onChange={(e) =>
                          filterDialog.onStateChange({
                            ...filterDialog.state,
                            [field.name]: e.target.value
                          })
                        }
                        placeholder={`Enter ${field.label.toLowerCase()}`}
                      />
                    )}
                  </div>
                ))}
              </div>
            </div>
            <div className="flex justify-end gap-4">
              <Button variant="outline" onClick={filterDialog.onReset}>
                Reset
              </Button>
              <Button onClick={filterDialog.onApply}>Apply</Button>
            </div>
          </DialogContent>
        </Dialog>
      )}
    </div>
  );
}
