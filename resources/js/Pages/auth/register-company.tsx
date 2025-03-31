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
  const [verificationCode, setVerificationCode] = useState<string>(Array(6).fill('').join(''));
  const [error, setError] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);

  // Form instances for each step
  const contactForm = useForm<z.infer<typeof contactSchema>>({
    resolver: zodResolver(contactSchema),
    defaultValues: {
      contact: '',
      contact_type: "email",
    },
  });

  const verificationForm = useForm<z.infer<typeof verificationSchema>>({
    resolver: zodResolver(verificationSchema),
    defaultValues: {
      verification_code: '',
    },
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
        verification_code: verificationCode,
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
      
      // Clear form data
      contactForm.reset();
      verificationForm.reset();
      detailsForm.reset();
      
      // Reset state
      setContactData(null);
      setVerificationCode('');
      setCurrentStep(RegistrationStep.Contact);
      
      // Redirect to login page
      window.location.href = '/';
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'An error occurred');
    } finally {
      setIsLoading(false);
    }
  };

  const handleDigitChange = (index: number, value: string) => {
    const digits = verificationCode.split('');
    digits[index] = value;
    const newCode = digits.join('');
    setVerificationCode(newCode);
    
    // Update form value
    verificationForm.setValue('verification_code', newCode);
    
    // Focus next input if not last
    if (index < 5) {
      const nextInput = document.getElementById(`digit-${index + 1}`);
      if (nextInput) {
        nextInput.focus();
      }
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
                      Enter your email address
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
              <div className="space-y-4">
                <div className="text-center">
                  <p className="text-lg font-semibold">Step 2 of 3</p>
                  <p className="text-gray-500">Verify your email address</p>
                </div>
                
                <FormField
                  control={verificationForm.control}
                  name="verification_code"
                  render={({ field }) => (
                    <FormItem>
                      <FormLabel>Verification Code</FormLabel>
                      <FormControl>
                        <div className="flex space-x-2">
                          {Array.from({ length: 6 }).map((_, index) => (
                            <Input
                              key={index}
                              id={`digit-${index}`}
                              type="text"
                              maxLength={1}
                              className="w-12 text-center"
                              value={verificationCode[index]}
                              onChange={(e) => {
                                const value = e.target.value;
                                if (value.match(/^[0-9]$/)) {
                                  handleDigitChange(index, value);
                                } else if (value === '') {
                                  // Handle backspace
                                  handleDigitChange(index, '');
                                  if (index > 0) {
                                    const prevInput = document.getElementById(`digit-${index - 1}`);
                                    if (prevInput) {
                                      prevInput.focus();
                                    }
                                  }
                                }
                              }}
                            />
                          ))}
                        </div>
                      </FormControl>
                      <FormDescription>
                        Enter the 6-digit code sent to your email
                      </FormDescription>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>
              
              <Button type="submit" className="w-full" disabled={isLoading}>
                {isLoading ? 'Verifying...' : 'Verify'}
              </Button>
            </form>
          </Form>
        );

      case RegistrationStep.Details:
        return (
          <Form {...detailsForm}>
            <form onSubmit={detailsForm.handleSubmit(handleDetailsSubmit)}>
              {/* Company Information */}
              <div className="space-y-4">
                <Card>
                  <CardHeader>
                    <CardTitle>Company Information</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
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
                  </CardContent>
                </Card>
              </div>

              {/* Admin Information */}
              <div className="space-y-4">
                <Card>
                  <CardHeader>
                    <CardTitle>Admin Information</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
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
                  </CardContent>
                </Card>
              </div>

              <Button type="submit" className="w-full" disabled={isLoading}>
                {isLoading ? 'Registering...' : 'Register'}
              </Button>
            </form>
          </Form>
        );

      default:
        return null;
    }
  };

  return (
    <AuthSimpleLayout>
      <Head title="Register Company" />

      <div className="w-full max-w-md space-y-8">
        <div>
          <h2 className="mt-6 text-3xl font-bold tracking-tight text-gray-900">
            Register Your Company
          </h2>
          <p className="mt-2 text-sm text-gray-600">
            Create a new company account
          </p>
        </div>

        {error && (
          <Alert variant="destructive">
            <AlertTitle>Error</AlertTitle>
            <AlertDescription>{error}</AlertDescription>
          </Alert>
        )}

        {/* Step Indicator */}
        <div className="space-y-2">
          <div className="flex items-center justify-center">
            <div className="flex items-center space-x-4">
              <div className={`w-8 h-8 flex items-center justify-center rounded-full ${
                currentStep === RegistrationStep.Contact ? 'bg-primary text-white' : 'bg-gray-200'
              }`}>
                1
              </div>
              <div className={`w-8 h-8 flex items-center justify-center rounded-full ${
                currentStep === RegistrationStep.Verification ? 'bg-primary text-white' : 'bg-gray-200'
              }`}>
                2
              </div>
              <div className={`w-8 h-8 flex items-center justify-center rounded-full ${
                currentStep === RegistrationStep.Details ? 'bg-primary text-white' : 'bg-gray-200'
              }`}>
                3
              </div>
            </div>
          </div>
          <div className="flex items-center justify-center space-x-4 text-sm text-gray-500">
            <span>Contact</span>
            <span>Verify</span>
            <span>Details</span>
          </div>
        </div>

        {renderStep()}

        <div className="mt-6">
          <Link
            href={route('login')}
            className="text-sm font-medium text-primary hover:underline"
          >
            Already have an account? Sign in
          </Link>
        </div>
      </div>
    </AuthSimpleLayout>
  );
}
