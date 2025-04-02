import React, { useState } from 'react'
import { Head, useForm, usePage } from '@inertiajs/react'
import AppLayout from '@/layouts/app/app-layout'
import { PageProps } from '@/types'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Separator } from '@/components/ui/separator'
import { DownloadIcon, UploadIcon, FileIcon, AlertCircleIcon, CheckCircleIcon } from 'lucide-react'
import { useToast } from '@/components/ui/use-toast'
import { FormError } from '@/components/FormError'

interface ImportError {
  message: string
  row?: number
}

interface Props {
  user: PageProps['user']
  errors?: PageProps['errors']
  flash?: {
    success?: string
    error?: string
  }
}

export default function Import({ user, errors, flash }: Props) {
  const { data, setData, post, processing, reset } = useForm({
    file: null as File | null,
  })

  const [importErrors, setImportErrors] = useState<ImportError[]>([])
  const [successCount, setSuccessCount] = useState(0)
  const [errorCount, setErrorCount] = useState(0)
  const [isProcessing, setIsProcessing] = useState(false)
  const { toast } = useToast()
  const page = usePage()

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0]
    if (file) {
      setData('file', file)
    }
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    
    if (!data.file) {
      toast({
        title: 'Error',
        description: 'Please select a file to import',
        duration: 5000
      })
      return
    }

    setIsProcessing(true)
    
    try {
      const response = await post(route('working-shift.import'), {
        preserveScroll: true,
        onSuccess: () => {
          // Reset form and show success message
          reset()
          toast({
            title: 'Success',
            description: 'Import completed successfully',
            duration: 3000
          })
        },
        onError: (errors: any) => {
          if (errors.file) {
            toast({
              title: 'Error',
              description: errors.file[0],
              duration: 5000
            })
          }
        },
      })

      // Handle flash messages
      if (flash?.success) {
        toast({
          title: 'Success',
          description: flash.success,
          duration: 3000
        })
      }
      if (flash?.error) {
        toast({
          title: 'Error',
          description: flash.error,
          duration: 5000
        })
      }
    } catch (error) {
      toast({
        title: 'Error',
        description: 'An error occurred during import',
        duration: 5000
      })
    } finally {
      setIsProcessing(false)
    }
  }

  return (
    <AppLayout user={user}>
      <Head title="Import Working Shift" />
      
      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card>
            <CardHeader>
              <CardTitle>Import Working Shift</CardTitle>
              <CardDescription>
                Import working shifts from a CSV file
              </CardDescription>
            </CardHeader>
            
            <CardContent>
              <form onSubmit={handleSubmit}>
                <div className="space-y-4">
                  <div>
                    <Label htmlFor="file">CSV File</Label>
                    <Input
                      id="file"
                      type="file"
                      accept=".csv"
                      onChange={handleFileChange}
                      disabled={isProcessing}
                    />
                    <FormError message={errors?.file?.[0]} />
                  </div>

                  <Button type="submit" disabled={isProcessing}>
                    {isProcessing ? 'Processing...' : 'Import'}
                  </Button>
                </div>
              </form>

              {importErrors.length > 0 && (
                <Alert className="mt-4 bg-red-100 text-red-800 border-red-200">
                  <AlertCircleIcon className="h-4 w-4" />
                  <AlertTitle>Import Errors</AlertTitle>
                  <AlertDescription>
                    {importErrors.map((error, index) => (
                      <div key={index} className="mb-2">
                        {error.message} {error.row ? ` (Row ${error.row})` : ''}
                      </div>
                    ))}
                  </AlertDescription>
                </Alert>
              )}

              {successCount > 0 && (
                <Alert className="mt-4 bg-green-100 text-green-800 border-green-200">
                  <CheckCircleIcon className="h-4 w-4" />
                  <AlertTitle>Success</AlertTitle>
                  <AlertDescription>
                    Successfully imported {successCount} working shifts
                  </AlertDescription>
                </Alert>
              )}
            </CardContent>
            <CardFooter className="flex justify-between">
              <Button variant="outline" asChild>
                <a href={route('attendance.working-shift.index')}>Back to Working Shifts</a>
              </Button>
            </CardFooter>
          </Card>
        </div>
      </div>
    </AppLayout>
  )
}
