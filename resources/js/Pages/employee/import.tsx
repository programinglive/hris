import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/Components/ui/button';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Alert, AlertDescription, AlertTitle } from '@/Components/ui/alert';
import { AlertCircle, FileSpreadsheet, Upload } from 'lucide-react';

interface ImportProps {
  companies: Array<{ id: number; name: string }>;
  branches: Array<{ id: number; name: string; company_id: number }>;
  brands: Array<{ id: number; name: string; company_id: number }>;
  departments: Array<{ id: number; name: string; parent_id: number | null }>;
  divisions: Array<{ id: number; name: string; department_id: number }>;
  subdivisions: Array<{ id: number; name: string; division_id: number }>;
  positionLevels: Array<{ id: number; name: string }>;
  departmentNames: string[];
  positions: string[];
  statuses: string[];
  genders: string[];
  maritalStatuses: string[];
  errors?: Record<string, string>;
}

export default function ImportEmployees({
  companies,
  branches,
  brands,
  departments,
  divisions,
  subdivisions,
  positionLevels,
  departmentNames,
  positions,
  statuses,
  genders,
  maritalStatuses,
  errors = {},
}: ImportProps) {
  const [selectedFile, setSelectedFile] = useState<File | null>(null);
  const { data, setData, post, processing } = useForm({
    file: null as unknown as File,
  });

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
      const file = e.target.files[0];
      setSelectedFile(file);
      setData('file', file);
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post(route('employee.import.process'), {
      forceFormData: true,
    });
  };

  const downloadTemplate = () => {
    window.location.href = route('employee.import.template');
  };

  return (
    <AppLayout>
      <Head title="Import Employees" />
      <div className="container py-6">
        <div className="mb-6">
          <h1 className="text-2xl font-bold tracking-tight">Import Employees</h1>
          <p className="text-muted-foreground">
            Import multiple employees from an Excel file
          </p>
        </div>

        <div className="grid gap-6 md:grid-cols-2">
          <Card>
            <CardHeader>
              <CardTitle>Instructions</CardTitle>
              <CardDescription>
                Follow these steps to import employees
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="space-y-2">
                <h3 className="font-medium">Step 1: Download Template</h3>
                <p className="text-sm text-muted-foreground">
                  Download our Excel template with the required format
                </p>
                <Button
                  variant="outline"
                  onClick={downloadTemplate}
                  className="mt-2"
                >
                  <FileSpreadsheet className="mr-2 h-4 w-4" />
                  Download Template
                </Button>
              </div>

              <div className="space-y-2">
                <h3 className="font-medium">Step 2: Fill the Template</h3>
                <p className="text-sm text-muted-foreground">
                  Fill in the template with your employee data. Make sure all required fields are completed.
                </p>
                <div className="mt-2 text-sm">
                  <p className="font-medium">Required Fields:</p>
                  <ul className="list-disc pl-5 space-y-1 mt-1">
                    <li>Name</li>
                    <li>Email</li>
                    <li>Password</li>
                    <li>Employee ID</li>
                    <li>Status</li>
                  </ul>
                </div>
              </div>

              <div className="space-y-2">
                <h3 className="font-medium">Step 3: Upload & Import</h3>
                <p className="text-sm text-muted-foreground">
                  Upload the filled template and click Import to add the employees
                </p>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Upload File</CardTitle>
              <CardDescription>
                Upload your filled employee template
              </CardDescription>
            </CardHeader>
            <form onSubmit={handleSubmit}>
              <CardContent className="space-y-4">
                {errors.file && (
                  <Alert variant="destructive">
                    <AlertCircle className="h-4 w-4" />
                    <AlertTitle>Error</AlertTitle>
                    <AlertDescription>{errors.file}</AlertDescription>
                  </Alert>
                )}

                <div className="space-y-2">
                  <Label htmlFor="file">Excel File</Label>
                  <Input
                    id="file"
                    type="file"
                    accept=".xlsx,.csv"
                    onChange={handleFileChange}
                    className="cursor-pointer"
                  />
                  <p className="text-xs text-muted-foreground">
                    Accepted formats: .xlsx, .csv
                  </p>
                </div>

                {selectedFile && (
                  <div className="rounded-md bg-muted p-3">
                    <div className="text-sm">
                      <span className="font-medium">Selected file:</span>{' '}
                      {selectedFile.name}
                    </div>
                    <div className="text-xs text-muted-foreground">
                      {(selectedFile.size / 1024).toFixed(2)} KB
                    </div>
                  </div>
                )}
              </CardContent>
              <CardFooter className="flex justify-between">
                <Button
                  variant="outline"
                  type="button"
                  onClick={() => window.history.back()}
                >
                  Cancel
                </Button>
                <Button type="submit" disabled={!selectedFile || processing}>
                  <Upload className="mr-2 h-4 w-4" />
                  {processing ? 'Importing...' : 'Import Employees'}
                </Button>
              </CardFooter>
            </form>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
