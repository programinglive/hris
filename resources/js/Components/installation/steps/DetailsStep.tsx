import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { 
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';

const detailsSchema = z.object({
  // Company information
  company_name: z.string().min(1, { message: "Company name is required" }),
  company_email: z.string().email({ message: "Please enter a valid email address" }),
  company_phone: z.string().min(1, { message: "Company phone is required" }),
  company_address: z.string().min(1, { message: "Company address is required" }),
  company_city: z.string().min(1, { message: "Company city is required" }),
  company_country: z.string().min(1, { message: "Company country is required" }),
  // Admin information
  admin_name: z.string().min(1, { message: "Admin name is required" }),
  admin_email: z.string().email({ message: "Please enter a valid email address" }),
  admin_password: z.string().min(8, { message: "Password must be at least 8 characters" }),
  admin_password_confirmation: z.string(),
}).refine(
  (data) => data.admin_password === data.admin_password_confirmation,
  {
    message: "Passwords don't match",
    path: ["admin_password_confirmation"],
  }
);

interface DetailsStepProps {
  onSubmit: (data: z.infer<typeof detailsSchema>) => void;
  onBack: () => void;
  isLoading: boolean;
  error?: string;
}

export default function DetailsStep({
  onSubmit,
  onBack,
  isLoading,
  error,
}: DetailsStepProps) {
  const form = useForm<z.infer<typeof detailsSchema>>({
    resolver: zodResolver(detailsSchema),
    defaultValues: {
      company_name: '',
      company_email: '',
      company_phone: '',
      company_address: '',
      company_city: '',
      company_country: '',
      admin_name: '',
      admin_email: '',
      admin_password: '',
      admin_password_confirmation: '',
    },
  });

  const handleSubmit = form.handleSubmit((data) => {
    onSubmit(data);
  });

  return (
    <div className="space-y-4">
      {error && (
        <Card className="bg-red-50 border-red-200">
          <CardContent>
            <p className="text-red-600">{error}</p>
          </CardContent>
        </Card>
      )}

      <Form {...form}>
        <form onSubmit={handleSubmit} className="space-y-4">
          {/* Company Information */}
          <Card>
            <CardHeader>
              <CardTitle>Company Information</CardTitle>
              <CardDescription>Enter your company details</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <FormField
                control={form.control}
                name="company_name"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company Name</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="company_email"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company Email</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="company_phone"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company Phone</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="company_address"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company Address</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="company_city"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company City</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="company_country"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Company Country</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
            </CardContent>
          </Card>

          {/* Admin Information */}
          <Card>
            <CardHeader>
              <CardTitle>Admin Information</CardTitle>
              <CardDescription>Set up your admin account</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <FormField
                control={form.control}
                name="admin_name"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Admin Name</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="admin_email"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Admin Email</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="admin_password"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Password</FormLabel>
                    <FormControl>
                      <Input type="password" {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="admin_password_confirmation"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Confirm Password</FormLabel>
                    <FormControl>
                      <Input type="password" {...field} />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
            </CardContent>
          </Card>

          <div className="flex justify-between">
            <Button
              variant="outline"
              onClick={onBack}
              disabled={isLoading}
            >
              Back
            </Button>
            <Button type="submit" disabled={isLoading}>
              {isLoading ? 'Saving...' : 'Complete Registration'}
            </Button>
          </div>
        </form>
      </Form>
    </div>
  );
}
