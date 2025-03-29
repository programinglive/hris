import React, { useState } from 'react';
import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useForm } from '@inertiajs/react';
import { FileSpreadsheet, Upload } from 'lucide-react';
import { useDropzone } from 'react-dropzone';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { AlertCircle } from 'lucide-react';

interface Division {
  id: number;
  name: string;
}

interface Props {
  divisions: Division[];
}

export default function SubDivisionImport({ divisions }: Props) {
  const [selectedFile, setSelectedFile] = useState<File | null>(null);
  
  const { data, setData, post, processing, errors, reset } = useForm({
    file: null as unknown as File,
    division_id: '',
  });
  
  const onDrop = (acceptedFiles: File[]) => {
    if (acceptedFiles.length > 0) {
      const file = acceptedFiles[0];
      setSelectedFile(file);
      setData('file', file);
    }
  };
  
  const { getRootProps, getInputProps, isDragActive } = useDropzone({
    onDrop,
    accept: {
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx'],
      'application/vnd.ms-excel': ['.xls'],
      'text/csv': ['.csv']
    },
    maxFiles: 1
  });
  
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post(route('organization.subdivision.import.process'), {
      forceFormData: true
    });
  };
  
  const removeFile = () => {
    setSelectedFile(null);
    setData('file', null as unknown as File);
  };
  
  const downloadTemplate = () => {
    window.location.href = route('organization.subdivision.import.template');
  };
  
  // Generate breadcrumbs
  const breadcrumbs = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Organization',
      href: '#',
    },
    {
      title: 'Sub-Division',
      href: route('organization.subdivision.index'),
    },
    {
      title: 'Import',
      href: route('organization.subdivision.import'),
    }
  ];
  
  return (
    <AppLayout title="Import Sub-Divisions" breadcrumbs={breadcrumbs}>
      <div className="container mx-auto py-6">
        <Card>
          <CardHeader>
            <CardTitle>Import Sub-Divisions</CardTitle>
            <CardDescription>
              Upload an Excel file to import multiple sub-divisions at once.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-6">
              {errors.file && (
                <Alert variant="destructive">
                  <AlertCircle className="h-4 w-4" />
                  <AlertTitle>Error</AlertTitle>
                  <AlertDescription>{errors.file}</AlertDescription>
                </Alert>
              )}
              
              <div className="space-y-2">
                <div className="flex items-center justify-between">
                  <h3 className="text-sm font-medium">1. Download Template</h3>
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={downloadTemplate}
                    type="button"
                  >
                    <FileSpreadsheet className="mr-2 h-4 w-4" />
                    Download Template
                  </Button>
                </div>
                <p className="text-xs text-muted-foreground">
                  First, download our Excel template and fill it with your sub-division data.
                </p>
              </div>
              
              <div className="space-y-2">
                <h3 className="text-sm font-medium">2. Select Division (Optional)</h3>
                <div className="grid gap-2">
                  <Label htmlFor="division_id">Division</Label>
                  <Select 
                    value={data.division_id} 
                    onValueChange={(value) => setData('division_id', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select a division" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="">-- Select Division --</SelectItem>
                      {divisions.map((division) => (
                        <SelectItem key={division.id} value={division.id.toString()}>
                          {division.name}
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  <p className="text-xs text-muted-foreground">
                    If selected, all imported sub-divisions will be assigned to this division,
                    regardless of the division_id in the import file.
                  </p>
                </div>
              </div>
              
              <div className="space-y-2">
                <h3 className="text-sm font-medium">3. Upload Filled Template</h3>
                <div 
                  {...getRootProps()} 
                  className={`border-2 border-dashed rounded-md p-6 text-center cursor-pointer transition-colors
                    ${isDragActive ? 'border-primary bg-primary/5' : 'border-muted-foreground/25 hover:border-primary/50'}
                    ${selectedFile ? 'bg-muted/50' : ''}
                  `}
                >
                  <input {...getInputProps()} />
                  
                  {selectedFile ? (
                    <div className="flex flex-col items-center justify-center space-y-2">
                      <div className="flex items-center justify-between w-full">
                        <div className="flex items-center">
                          <FileSpreadsheet className="h-8 w-8 text-primary mr-2" />
                          <div className="text-left">
                            <p className="text-sm font-medium">{selectedFile.name}</p>
                            <p className="text-xs text-muted-foreground">
                              {(selectedFile.size / 1024).toFixed(2)} KB
                            </p>
                          </div>
                        </div>
                        <Button
                          variant="ghost"
                          size="icon"
                          onClick={(e) => {
                            e.stopPropagation();
                            removeFile();
                          }}
                          type="button"
                        >
                          <span className="sr-only">Remove file</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="h-4 w-4">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                          </svg>
                        </Button>
                      </div>
                    </div>
                  ) : (
                    <div className="flex flex-col items-center justify-center space-y-2">
                      <Upload className="h-8 w-8 text-muted-foreground" />
                      <div className="space-y-1 text-center">
                        <p className="text-sm font-medium">
                          Drag & drop your file here or click to browse
                        </p>
                        <p className="text-xs text-muted-foreground">
                          Supported formats: XLSX, XLS, CSV (max 10MB)
                        </p>
                      </div>
                    </div>
                  )}
                </div>
              </div>
              
              <div className="flex justify-end gap-2">
                <Button
                  type="button"
                  variant="outline"
                  onClick={() => window.history.back()}
                >
                  Cancel
                </Button>
                <Button 
                  type="submit" 
                  disabled={!selectedFile || processing}
                >
                  {processing ? 'Importing...' : 'Import Sub-Divisions'}
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
