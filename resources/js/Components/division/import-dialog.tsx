import React, { useState, useCallback } from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { AlertCircle, FileSpreadsheet, Upload, X, CheckCircle2 } from 'lucide-react';
import { useDropzone } from 'react-dropzone';

interface ImportDialogProps {
  isOpen: boolean;
  onClose: () => void;
  templateUrl: string;
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

interface ImportResponse {
  success: boolean;
  message: string;
  results?: ImportResult;
}

export function ImportDialog({ isOpen, onClose, templateUrl }: ImportDialogProps) {
  const [selectedFile, setSelectedFile] = useState<File | null>(null);
  const [importResult, setImportResult] = useState<ImportResult | null>(null);
  const [importStatus, setImportStatus] = useState<'idle' | 'success' | 'error'>('idle');
  const [importMessage, setImportMessage] = useState<string>('');
  const { data, setData, post, processing, errors, reset } = useForm({
    file: null as unknown as File,
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
      'text/csv': ['.csv'],
    },
    maxFiles: 1,
  });

  const removeFile = () => {
    setSelectedFile(null);
    setData('file', null as unknown as File);
  };

  const downloadTemplate = () => {
    window.location.href = templateUrl;
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!selectedFile) return;
    
    post('/organization/division/import/process', {
      onSuccess: (page) => {
        const response = page.props.flash as ImportResponse;
        if (response.success) {
          setImportStatus('success');
          setImportMessage(response.message);
          if (response.results) {
            setImportResult(response.results);
          }
        } else {
          setImportStatus('error');
          setImportMessage(response.message || 'An error occurred during import.');
        }
      },
      onError: () => {
        setImportStatus('error');
      }
    });
  };

  const handleClose = () => {
    if (!processing) {
      reset();
      setSelectedFile(null);
      setImportStatus('idle');
      setImportResult(null);
      setImportMessage('');
      onClose();
    }
  };

  return (
    <Dialog open={isOpen} onOpenChange={handleClose}>
      <DialogContent className="sm:max-w-md">
        <form onSubmit={handleSubmit}>
          <DialogHeader>
            <DialogTitle>Import Divisions</DialogTitle>
            <DialogDescription>
              Upload an Excel file to import divisions in bulk.
            </DialogDescription>
          </DialogHeader>
          
          <div className="py-4">
            <div className="space-y-4">
              {importStatus === 'success' && (
                <Alert className="bg-green-50 border-green-200">
                  <CheckCircle2 className="h-4 w-4 text-green-600" />
                  <AlertTitle className="text-green-800">Success</AlertTitle>
                  <AlertDescription className="text-green-700">
                    {importMessage}
                    {importResult && (
                      <div className="mt-2">
                        <p>Total: {importResult.total}</p>
                        <p>Successful: {importResult.success}</p>
                        <p>Failed: {importResult.failed}</p>
                        
                        {importResult.errors.length > 0 && (
                          <div className="mt-2">
                            <p className="font-semibold">Errors:</p>
                            <ul className="list-disc pl-5 mt-1 text-sm">
                              {importResult.errors.map((error, index) => (
                                <li key={index}>
                                  Row {error.row} ({error.name}): {error.errors.join(', ')}
                                </li>
                              ))}
                            </ul>
                          </div>
                        )}
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
                  First, download our Excel template and fill it with your division data.
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
                      <p className="text-xs text-muted-foreground">
                        Click or drag to replace file
                      </p>
                    </div>
                  ) : (
                    <div className="flex flex-col items-center justify-center space-y-2">
                      <Upload className="h-8 w-8 text-muted-foreground" />
                      <div className="space-y-1">
                        <p className="text-sm font-medium">
                          {isDragActive ? 'Drop the file here' : 'Drag & drop your Excel file here'}
                        </p>
                        <p className="text-xs text-muted-foreground">
                          or click to browse files (XLSX, XLS, CSV only)
                        </p>
                      </div>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>

          <DialogFooter className="flex justify-between sm:justify-between">
            <Button
              variant="outline"
              type="button"
              onClick={handleClose}
              disabled={processing}
            >
              {importStatus === 'success' ? 'Close' : 'Cancel'}
            </Button>
            {importStatus !== 'success' && (
              <Button 
                type="submit" 
                disabled={!selectedFile || processing}
              >
                {processing ? 'Importing...' : 'Import Divisions'}
              </Button>
            )}
            {importStatus === 'success' && (
              <Button 
                type="button"
                variant="outline"
                onClick={() => {
                  reset();
                  setSelectedFile(null);
                  setImportStatus('idle');
                  setImportResult(null);
                  setImportMessage('');
                }}
              >
                Import More
              </Button>
            )}
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
