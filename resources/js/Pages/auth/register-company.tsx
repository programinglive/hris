import React, { useState } from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import axios from 'axios';

import AuthSimpleLayout from '@/layouts/auth/auth-simple-layout';
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
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

// Step 1: Contact Information Schema
const contactSchema = z.object({
  contact: z.string().min(1, { message: "Contact information is required" }),
  contact_type: z.enum(["email", "phone"], {
    required_error: "Please select a contact type",
  }),
}).refine(
  (data) => {
    if (data.contact_type === "email") {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.contact);
    } else if (data.contact_type === "phone") {
      return /^[0-9+\s]+$/.test(data.contact);
    }
    return false;
  },
  {
    message: "Please enter a valid email or phone number",
    path: ["contact"],
  }
);

// Step 2: Verification Code Schema
const verificationSchema = z.object({
  verification_code: z.string().length(6, { message: "Verification code must be 6 digits" }),
});

// Step 3: Company and Admin Details Schema
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

enum RegistrationStep {
  Contact = 1,
  Verification = 2,
  Details = 3,
}

export default function RegisterCompany() {
  const { auth } = usePage().props;
  const [currentStep, setCurrentStep] = useState<RegistrationStep>(RegistrationStep.Contact);
  const [contactData, setContactData] = useState<z.infer<typeof contactSchema> | null>(null);
  const [verificationCode, setVerificationCode] = useState<string>('');
  const [error, setError] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);

  // Form instances for each step
  const contactForm = useForm<z.infer<typeof contactSchema>>({
    resolver: zodResolver(contactSchema),
  });

  const verificationForm = useForm<z.infer<typeof verificationSchema>>({
    resolver: zodResolver(verificationSchema),
  });

  const detailsForm = useForm<z.infer<typeof detailsSchema>>({
    resolver: zodResolver(detailsSchema),
  });

  const handleContactSubmit = async (data: z.infer<typeof contactSchema>) => {
    setIsLoading(true);
    setError(null);
    
    try {
      const response = await axios.post(route('register.company.validate-contact'), data);
      setContactData(data);
      setCurrentStep(RegistrationStep.Verification);
      setVerificationCode(response.data.verification_code);
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'An error occurred');
    } finally {
      setIsLoading(false);
    }
  };

  const handleVerificationSubmit = async (data: z.infer<typeof verificationSchema>) => {
    setIsLoading(true);
    setError(null);
    
    try {
      await axios.post(route('register.company.verify-code'), {
        ...contactData,
        verification_code: data.verification_code,
      });
      setCurrentStep(RegistrationStep.Details);
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'Invalid verification code');
    } finally {
      setIsLoading(false);
    }
  };

  const handleDetailsSubmit = async (data: z.infer<typeof detailsSchema>) => {
    if (!contactData) {
      setError('Contact data not found');
      return;
    }

    setIsLoading(true);
    setError(null);
    
    try {
      await axios.post(route('register.company.save-details'), {
        ...contactData,
        ...data,
      });
      window.location.href = '/';
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'An error occurred');
    } finally {
      setIsLoading(false);
    }
  };

  const renderStep = () => {
    switch (currentStep) {
      case RegistrationStep.Contact:
        return (
          <Form {...contactForm}>
            <form onSubmit={contactForm.handleSubmit(handleContactSubmit)}>
              <FormField
                control={contactForm.control}
                name="contact"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Contact</FormLabel>
                    <FormControl>
                      <Input {...field} />
                    </FormControl>
                    <FormDescription>
                      Enter your email or phone number
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={contactForm.control}
                name="contact_type"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Contact Type</FormLabel>
                    <FormControl>
                      <select value={field.value} onChange={field.onChange}>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                      </select>
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <Button type="submit" className="w-full" disabled={isLoading}>
                {isLoading ? 'Sending...' : 'Next'}
              </Button>
            </form>
          </Form>
        );

      case RegistrationStep.Verification:
        return (
          <Form {...verificationForm}>
            <form onSubmit={verificationForm.handleSubmit(handleVerificationSubmit)}>
              <FormField
                control={verificationForm.control}
                name="verification_code"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Verification Code</FormLabel>
                    <FormControl>
                      <Input {...field} type="text" maxLength={6} />
                    </FormControl>
                    <FormDescription>
                      Enter the 6-digit verification code sent to your contact
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <Button type="submit" className="w-full" disabled={isLoading}>
                {isLoading ? 'Verifying...' : 'Next'}
              </Button>
            </form>
          </Form>
        );

      case RegistrationStep.Details:
        return (
          <Form {...detailsForm}>
            <form onSubmit={detailsForm.handleSubmit(handleDetailsSubmit)}>
              <div className="grid gap-4">
                {/* Company Information */}
                <div className="space-y-4">
                  <h3 className="font-medium">Company Information</h3>
                  <FormField
                    control={detailsForm.control}
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
                    control={detailsForm.control}
                    name="company_email"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Company Email</FormLabel>
                        <FormControl>
                          <Input {...field} type="email" />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  <FormField
                    control={detailsForm.control}
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
                    control={detailsForm.control}
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
                    control={detailsForm.control}
                    name="company_city"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>City</FormLabel>
                        <FormControl>
                          <Input {...field} />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  <FormField
                    control={detailsForm.control}
                    name="company_country"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Country</FormLabel>
                        <FormControl>
                          <Input {...field} />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                </div>

                {/* Admin Information */}
                <div className="space-y-4">
                  <h3 className="font-medium">Admin Information</h3>
                  <FormField
                    control={detailsForm.control}
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
                    control={detailsForm.control}
                    name="admin_email"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Admin Email</FormLabel>
                        <FormControl>
                          <Input {...field} type="email" />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  <FormField
                    control={detailsForm.control}
                    name="admin_password"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Password</FormLabel>
                        <FormControl>
                          <Input {...field} type="password" />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  <FormField
                    control={detailsForm.control}
                    name="admin_password_confirmation"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Confirm Password</FormLabel>
                        <FormControl>
                          <Input {...field} type="password" />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                </div>
              </div>
              <Button type="submit" className="w-full" disabled={isLoading}>
                {isLoading ? 'Registering...' : 'Register Company'}
              </Button>
            </form>
          </Form>
        );

      default:
        return null;
    }
  };

  return (
    <AuthSimpleLayout
      title="Register Company"
      description="Create your company account and get started with our HRIS system"
    >
      <Head title="Register Company" />
      
      {error && (
        <Alert variant="destructive" className="mb-4">
          <AlertTitle>Error</AlertTitle>
          <AlertDescription>{error}</AlertDescription>
        </Alert>
      )}

      <Card>
        <CardHeader>
          <CardTitle>
            Step {currentStep} of 3
          </CardTitle>
          <CardDescription>
            {currentStep === RegistrationStep.Contact && 'Provide your contact information'}
            {currentStep === RegistrationStep.Verification && 'Verify your contact'}
            {currentStep === RegistrationStep.Details && 'Enter company and admin details'}
          </CardDescription>
        </CardHeader>
        <CardContent>
          {renderStep()}
        </CardContent>
      </Card>
    </AuthSimpleLayout>
  );
}
