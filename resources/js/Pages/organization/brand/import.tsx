import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { ImportDialog } from '@/Components/brand/import-dialog';
import { FileSpreadsheet } from 'lucide-react';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
}

interface ImportPageProps {
  companies: Company[];
  branches: Branch[];
  templateUrl: string;
}

export default function BrandImport({ companies, branches, templateUrl }: ImportPageProps) {
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);

  return (
    <>
      <Head title="Import Brands" />
      
      <div className="container mx-auto py-6 space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-semibold">Import Brands</h1>
        </div>
        
        <Card>
          <CardHeader>
            <CardTitle>Import Brands</CardTitle>
            <CardDescription>
              Import multiple brands at once using our Excel template.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-6">
            <div className="flex flex-col space-y-4">
              <div className="flex flex-col space-y-2">
                <h3 className="text-sm font-medium">Step 1: Download Template</h3>
                <p className="text-sm text-muted-foreground">
                  Download our Excel template and fill it with your brand data.
                </p>
                <div>
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => window.location.href = templateUrl}
                  >
                    <FileSpreadsheet className="mr-2 h-4 w-4" />
                    Download Template
                  </Button>
                </div>
              </div>
              
              <div className="flex flex-col space-y-2">
                <h3 className="text-sm font-medium">Step 2: Fill the Template</h3>
                <p className="text-sm text-muted-foreground">
                  Fill the template with your brand information. Make sure to follow the format provided.
                </p>
                <ul className="list-disc list-inside text-sm text-muted-foreground space-y-1">
                  <li>Enter the brand name, code, and description</li>
                  <li>Set is_active to "Yes" or "No"</li>
                  <li>Save the file when done</li>
                </ul>
              </div>
              
              <div className="flex flex-col space-y-2">
                <h3 className="text-sm font-medium">Step 3: Upload and Import</h3>
                <p className="text-sm text-muted-foreground">
                  Upload your filled template to import the brands.
                </p>
                <div>
                  <Button onClick={() => setIsImportDialogOpen(true)}>
                    Import Brands
                  </Button>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
      
      <ImportDialog
        isOpen={isImportDialogOpen}
        onClose={() => setIsImportDialogOpen(false)}
        templateUrl={templateUrl}
        companies={companies}
        branches={branches}
      />
    </>
  );
}

BrandImport.layout = (page: React.ReactNode) => <AppLayout children={page} />;
