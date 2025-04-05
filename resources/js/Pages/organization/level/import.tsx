import AppLayout from '@/layouts/app/app-layout';
import { useState } from 'react';
import { router, usePage } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/Components/ui/button';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { Download, Upload } from 'lucide-react';
import { Alert, AlertDescription } from '@/Components/ui/alert';

interface Company {
  id: number;
  name: string;
}

interface Props {
  companies: Company[];
}

export default function ImportLevel({ companies }: Props) {
  const { url, errors } = usePage().props as any;
  const [file, setFile] = useState<File | null>(null);
  const [companyId, setCompanyId] = useState<string>('');
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  
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
      title: 'Level Lists',
      href: route('organization.level.index'),
    },
    {
      title: 'Import Levels',
      href: url,
    }
  ];
  
  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const selectedFile = e.target.files?.[0] || null;
    setFile(selectedFile);
    setError(null);
  };
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!file) {
      setError('Please select a file to upload');
      return;
    }
    
    setIsUploading(true);
    
    const formData = new FormData();
    formData.append('file', file);
    if (companyId) {
      formData.append('company_id', companyId);
    }
    
    router.post(route('organization.level.import.process'), formData, {
      onSuccess: () => {
        setIsUploading(false);
      },
      onError: () => {
        setIsUploading(false);
      }
    });
  };
  
  const downloadTemplate = () => {
    window.location.href = route('organization.level.import.template');
  };
  
  return (
    <AppLayout title="Import Levels" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-6">Import Levels</h1>
        
        <Card className="max-w-2xl mx-auto">
          <CardHeader>
            <CardTitle>Upload Excel File</CardTitle>
            <CardDescription>
              Upload an Excel file with level data to import. You can download a template below.
            </CardDescription>
          </CardHeader>
          <form onSubmit={handleSubmit}>
            <CardContent className="space-y-4">
              {(errors.file || error) && (
                <Alert variant="destructive">
                  <AlertDescription>
                    {errors.file || error}
                  </AlertDescription>
                </Alert>
              )}
              
              <div className="space-y-2">
                <Label htmlFor="file">Excel File</Label>
                <Input 
                  id="file" 
                  type="file" 
                  accept=".xlsx,.xls,.csv" 
                  onChange={handleFileChange}
                />
                <p className="text-sm text-gray-500">
                  Accepted formats: .xlsx, .xls, .csv
                </p>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="company_id">Company (Optional)</Label>
                <Select value={companyId} onValueChange={setCompanyId}>
                  <SelectTrigger id="company_id">
                    <SelectValue placeholder="Select a company" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">All Companies</SelectItem>
                    {companies.map((company) => (
                      <SelectItem key={company.id} value={company.id.toString()}>
                        {company.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <p className="text-sm text-gray-500">
                  If selected, all imported levels will be assigned to this company.
                </p>
              </div>
            </CardContent>
            <CardFooter className="flex justify-between">
              <Button
                type="button"
                variant="outline"
                onClick={downloadTemplate}
                className="flex items-center"
              >
                <Download className="mr-2 h-4 w-4" />
                Download Template
              </Button>
              <Button type="submit" disabled={isUploading} className="flex items-center">
                <Upload className="mr-2 h-4 w-4" />
                {isUploading ? 'Uploading...' : 'Upload'}
              </Button>
            </CardFooter>
          </form>
        </Card>
      </div>
    </AppLayout>
  );
}
