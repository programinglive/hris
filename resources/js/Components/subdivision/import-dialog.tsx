import React, { useState, useCallback } from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import { Alert, AlertDescription, AlertTitle } from '@/Components/ui/alert';
import { AlertCircle, FileSpreadsheet, Upload, X, CheckCircle2 } from 'lucide-react';
import { useDropzone } from 'react-dropzone';

interface ImportDialogProps {
  isOpen: boolean;
  onClose: () => void;
  templateUrl: string;
  companyId?: number;
  divisionId?: number;
}

interface ImportResult {
  total: number;
  success: number;
  failed: number;
  errors: Array<{
    row: number;
    name: string;
    errors: string[];
  }>;
}

export function ImportDialog({ isOpen, onClose, templateUrl, companyId, divisionId }: ImportDialogProps) {
  const [selectedFile, setSelectedFile] = useState<File | null>(null);
  const [importResult, setImportResult] = useState<ImportResult | null>(null);
  const [importStatus, setImportStatus] = useState<'idle' | 'success' | 'error'>('idle');
  const [importMessage, setImportMessage] = useState<string>('');
  const { data, setData, post, processing, errors, reset } = useForm({
    file: null as unknown as File,
    division_id: divisionId || '',
  });

  const onDrop = useCallback((acceptedFiles: File[]) => {
    if (acceptedFiles.length > 0) {
      const file = acceptedFiles[0];
      setSelectedFile(file);
      setData('file', file);
    }
  }, [setData]);

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
    setImportStatus('idle');
    setImportResult(null);
    
    post('/organization/subdivision/import/process', {
      forceFormData: true,
      onSuccess: (page) => {
        // Access the custom props from the response
        const response = page.props as unknown as {
          success: boolean;
          message: string;
          results?: ImportResult;
        };
        
        setImportStatus('success');
        setImportMessage(response.message || 'Import completed successfully');
        if (response.results) {
          setImportResult(response.results);
        }
        // Don't close the dialog, show the success message
      },
      onError: (errors) => {
        setImportStatus('error');
        const errorMessage = typeof errors === 'string' 
          ? errors 
          : (errors.message as string || 'An error occurred during import');
        setImportMessage(errorMessage);
      }
    });
  };

  const downloadTemplate = () => {
    window.location.href = templateUrl;
  };

  const removeFile = () => {
    setSelectedFile(null);
    setData('file', null as unknown as File);
  };

  const handleClose = () => {
    reset();
    setSelectedFile(null);
    setImportStatus('idle');
    setImportResult(null);
    setImportMessage('');
    onClose();
  };
  
  return (
    <Dialog open={isOpen} onOpenChange={(open) => {
      if (!open) {
        handleClose();
      }
    }}>
      <DialogContent className="sm:max-w-md md:max-w-lg">
        <DialogHeader>
          <DialogTitle>Import Sub-Divisions</DialogTitle>
          <DialogDescription>
            Upload an Excel file to import multiple sub-divisions at once.
          </DialogDescription>
        </DialogHeader>

        <form onSubmit={handleSubmit}>
          <div className="grid gap-4 py-4">
            <div className="flex flex-col space-y-4">
              {importStatus === 'success' && (
                <Alert variant="default" className="bg-green-50 border-green-200 text-green-800">
                  <CheckCircle2 className="h-4 w-4 text-green-600" />
                  <AlertTitle>Success</AlertTitle>
                  <AlertDescription>
                    {importMessage}
                    {importResult && (
                      <div className="mt-2 text-sm">
                        <p>Total: {importResult.total} | Successful: {importResult.success} | Failed: {importResult.failed}</p>
                      </div>
                    )}
                  </AlertDescription>
                </Alert>
              )}
              
              {importStatus === 'error' && (
                <Alert variant="destructive">
                  <AlertCircle className="h-4 w-4" />
                  <AlertTitle>Error</AlertTitle>
                  <AlertDescription>{importMessage}</AlertDescription>
                </Alert>
              )}
              
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
                <h3 className="text-sm font-medium">2. Upload Filled Template</h3>
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
                          <X className="h-4 w-4" />
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

              {divisionId && (
                <input type="hidden" name="division_id" value={divisionId} />
              )}
            </div>
          </div>

          <DialogFooter>
            <Button
              type="button"
              variant="outline"
              onClick={handleClose}
              disabled={processing}
            >
              Cancel
            </Button>
            <Button 
              type="submit" 
              disabled={!selectedFile || processing}
              className="ml-2"
            >
              {processing ? 'Importing...' : 'Import'}
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
