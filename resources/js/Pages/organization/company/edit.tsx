import { usePage } from '@inertiajs/react';
import { router } from '@inertiajs/react';
import { 
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Switch } from "@/components/ui/switch";
import { Button } from "@/components/ui/button";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from 'zod';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';
import { useForm, useFormState, SubmitHandler, Controller } from 'react-hook-form';
import { useEffect, useCallback, useMemo } from 'react';
import type { PageProps } from '@/types';

interface Company {
  id: number;
  name: string;
  legal_name?: string;
  tax_id?: string;
  registration_number?: string;
  email: string;
  phone?: string;
  address?: string;
  city?: string;
  state?: string;
  postal_code?: string;
  country?: string;
  website?: string;
  description?: string;
  is_active: boolean;
  owner_id?: number;
}

interface Props {
  company: Company;
}

const formSchema = z.object({
  name: z.string().min(2, {
    message: "Company name must be at least 2 characters.",
  }),
  legal_name: z.string().optional(),
  tax_id: z.string().optional(),
  registration_number: z.string().optional(),
  email: z.string().email({
    message: "Please enter a valid email address.",
  }),
  phone: z.string().optional(),
  address: z.string().optional(),
  city: z.string().optional(),
  state: z.string().optional(),
  postal_code: z.string().optional(),
  country: z.string().optional(),
  website: z.string().optional(),
  description: z.string().optional(),
  is_active: z.boolean(),
  owner_id: z.number().optional(),
});

type FormValues = z.infer<typeof formSchema>;

const EditCompany = ({ company }: Props) => {
  // Get inertia instance at component level
  const page = usePage<PageProps>();

  // Memoize form values to prevent unnecessary re-renders
  const formValues = useMemo(() => ({
    name: company.name,
    legal_name: company.legal_name ?? '',
    tax_id: company.tax_id ?? '',
    registration_number: company.registration_number ?? '',
    email: company.email,
    phone: company.phone ?? '',
    address: company.address ?? '',
    city: company.city ?? '',
    state: company.state ?? '',
    postal_code: company.postal_code ?? '',
    country: company.country ?? '',
    website: company.website ?? '',
    description: company.description ?? '',
    is_active: company.is_active,
    owner_id: company.owner_id,
  }), [company]);

  const form = useForm<FormValues>({
    resolver: zodResolver(formSchema),
    defaultValues: formValues,
  });

  const { isSubmitting, errors } = useFormState({
    control: form.control
  });

  // Memoize the submit handler to prevent unnecessary re-renders
  const onSubmit = useCallback(async (data: FormValues) => {
    try {
      await router.put(`/organization/company/${company.id}`, data);
    } catch (error) {
      console.error('Failed to update company:', error);
    }
  }, [company.id, router]);

  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = useMemo(() => [
    {
      title: 'Dashboard',
      href: '/',
    },
    {
      title: 'Organization',
      href: '#',
    },
    {
      title: 'Company',
      href: '/organization/company',
    },
    {
      title: 'Edit',
      href: `/organization/company/${company.id}/edit`,
    }
  ], [company.id]);

  // Memoize cancel handler
  const handleCancel = useCallback(() => {
    router.visit(route('organization.company.index'));
  }, []);

  return (
    <AppLayout title={`Edit ${company.name}`} breadcrumbs={breadcrumbs}>
      <div className="p-6 overflow-auto thin-scrollbar">
        <div className="mb-6">
          <h1 className="text-2xl font-bold">Edit Company</h1>
          <p className="text-gray-500">Update company information</p>
        </div>
        
        <div className="bg-white rounded-lg shadow p-6">
          <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <FormField
                  control={form.control}
                  name="name"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Company Name *</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter company name" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="legal_name"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Legal Name</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter legal name" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="email"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Email Address *</FormLabel>
                      <FormControl>
                        <Input type="email" placeholder="Enter email address" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="phone"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Phone Number</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter phone number" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="tax_id"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Tax ID</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter tax ID" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="registration_number"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Registration Number</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter registration number" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="address"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Address</FormLabel>
                      <FormControl>
                        <Textarea placeholder="Enter address" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="city"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>City</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter city" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="state"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>State</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter state" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="postal_code"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Postal Code</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter postal code" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="country"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Country</FormLabel>
                      <FormControl>
                        <Input placeholder="Enter country" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="website"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Website</FormLabel>
                      <FormControl>
                        <Input type="url" placeholder="Enter website URL" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="description"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Description</FormLabel>
                      <FormControl>
                        <Textarea placeholder="Enter description" {...field} />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
                
                <FormField
                  control={form.control}
                  name="is_active"
                  render={({ field }) => (
                    <FormItem className="flex flex-row items-center justify-between rounded-md border p-3">
                      <div className="space-y-1.5">
                        <FormLabel className="text-base">Active Status</FormLabel>
                        <FormDescription>
                          Toggle to activate or deactivate the company
                        </FormDescription>
                      </div>
                      <FormControl>
                        <Controller
                          name="is_active"
                          control={form.control}
                          render={({ field }) => (
                            <Switch
                              checked={field.value}
                              onCheckedChange={field.onChange}
                              className="data-[state=checked]:bg-primary"
                            />
                          )}
                        />
                      </FormControl>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>
              
              <div className="flex justify-end space-x-2">
                <Button 
                  variant="outline" 
                  type="button" 
                  onClick={handleCancel}
                >
                  Cancel
                </Button>
                <Button type="submit" disabled={isSubmitting}>Update Company</Button>
              </div>
            </form>
          </Form>
        </div>
      </div>
    </AppLayout>
  );
};

export default EditCompany;