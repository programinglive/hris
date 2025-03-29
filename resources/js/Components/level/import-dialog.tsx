import { useState } from 'react';
import { router } from '@inertiajs/react';
import { 
  Dialog, 
  DialogContent, 
  DialogDescription, 
  DialogFooter, 
  DialogHeader, 
  DialogTitle 
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Download, Upload } from 'lucide-react';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';

interface ImportDialogProps {
  isOpen: boolean;
  onClose: () => void;
  templateUrl: string;
  companies?: { id: number; name: string }[];
}

export function ImportDialog({ isOpen, onClose, templateUrl, companies }: ImportDialogProps) {
  const [file, setFile] = useState<File | null>(null);
  const [companyId, setCompanyId] = useState<string>('');
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState<string | null>(null);

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
        onClose();
      },
      onError: (errors) => {
        setIsUploading(false);
        setError(errors.file || 'An error occurred during upload');
      }
    });
  };

  const downloadTemplate = () => {
    window.location.href = templateUrl;
  };

  return (
    <Dialog open={isOpen} onOpenChange={(open) => !open && onClose()}>
      <DialogContent className="sm:max-w-md">
        <DialogHeader>
          <DialogTitle>Import Levels</DialogTitle>
          <DialogDescription>
            Upload an Excel file with level data to import.
          </DialogDescription>
        </DialogHeader>
        
        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <Label htmlFor="file">Excel File</Label>
            <Input 
              id="file" 
              type="file" 
              accept=".xlsx,.xls,.csv" 
              onChange={handleFileChange}
              className="mt-1"
            />
            {error && <p className="text-sm text-red-500 mt-1">{error}</p>}
          </div>
          
          {companies && companies.length > 0 && (
            <div>
              <Label htmlFor="company_id">Company (Optional)</Label>
              <Select value={companyId} onValueChange={setCompanyId}>
                <SelectTrigger className="mt-1">
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
              <p className="text-xs text-gray-500 mt-1">
                If selected, all imported levels will be assigned to this company.
              </p>
            </div>
          )}
          
          <DialogFooter className="flex justify-between sm:justify-between">
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
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
