import { useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import axios from 'axios';
import { Head, router, Link } from '@inertiajs/react';

import InstallationLayout from '@/layouts/installation-layout';
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
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import RegistrationSuccess from '@/components/installation/RegistrationSuccess';

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
  Success = 4,
}

export default function RegisterCompany() {
  const [currentStep, setCurrentStep] = useState<RegistrationStep>(RegistrationStep.Contact);
  const [contactData, setContactData] = useState<z.infer<typeof contactSchema> | null>(null);
  const [verificationCode, setVerificationCode] = useState<string>(Array(6).fill('').join(''));
  const [error, setError] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);
  const [isResending, setIsResending] = useState(false);
  const [successData, setSuccessData] = useState<{
    companyName: string;
    redirectUrl: string;
  } | null>(null);

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
      setError(error.response?.data?.message || 'Failed to validate contact');
    } finally {
      setIsLoading(false);
    }
  };

  const handleVerificationSubmit = async (data: z.infer<typeof verificationSchema>) => {
    setIsLoading(true);
    setError(null);
    
    try {
      await axios.post(route('register.company.verify-code'), {
        ...data,
        contact: contactData?.contact,
        contact_type: contactData?.contact_type,
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
    setIsLoading(true);
    try {
      await axios.post(route('register.company.complete'), {
        ...data,
        contact: contactData?.contact,
        contact_type: contactData?.contact_type,
        verification_code: verificationCode,
      });

      handleSuccessRedirect(data.company_name);
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'Failed to complete registration');
    } finally {
      setIsLoading(false);
    }
  };

  const handleSuccessRedirect = (companyName: string) => {
    setSuccessData({
      companyName,
      redirectUrl: route('dashboard'),
    });
    setCurrentStep(RegistrationStep.Success);
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

  const handleNextStep = () => {
    setCurrentStep(currentStep + 1);
  };

  const handleBackStep = () => {
    setCurrentStep(currentStep - 1);
  };

  const resendVerificationCode = async () => {
    setIsResending(true);
    try {
      await axios.post(route('register.company.resend-verification-code'), contactData);
    } catch (err: unknown) {
      const error = err as { response?: { data?: { message: string } } };
      setError(error.response?.data?.message || 'Failed to resend verification code');
    } finally {
      setIsResending(false);
    }
  };

  const renderStep = () => {
    switch (currentStep) {
      case RegistrationStep.Contact:
        return (
          <Form {...contactForm}>
            <form onSubmit={contactForm.handleSubmit(handleContactSubmit)} className="space-y-6">
              <FormField
                control={contactForm.control}
                name="contact"
                render={({ field }) => (
                  <FormItem>
                    <FormLabel>Contact Information</FormLabel>
                    <FormControl>
                      <Input placeholder="Enter email or phone number" {...field} />
                    </FormControl>
                    <FormDescription>
                      Enter your email address or phone number for verification
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={contactForm.control}
                name="contact_type"
                render={({ field }) => (
                  <FormItem className="space-y-3">
                    <FormLabel>Contact Type</FormLabel>
                    <FormControl>
                      <select
                        {...field}
                        className="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                      >
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                      </select>
                    </FormControl>
                    <FormDescription>
                      Choose whether you want to verify via email or phone
                    </FormDescription>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <Button type="submit" className="w-full">
                Next
              </Button>
            </form>
          </Form>
        );
      
      case RegistrationStep.Verification:
        return (
          <Form {...verificationForm}>
            <form onSubmit={verificationForm.handleSubmit(handleVerificationSubmit)} className="space-y-6">
              <div className="text-center mb-6">
                <h3 className="text-xl font-semibold">Step 2: Verify Your Contact</h3>
                <p className="text-gray-600 mt-2">
                  We've sent a 6-digit verification code to your {contactData?.contact_type === 'email' ? 'email' : 'phone'}. Please enter it below.
                </p>
              </div>

              <div className="space-y-4">
                <FormField
                  control={verificationForm.control}
                  name="verification_code"
                  render={({ field }) => (
                    <FormItem>
                      <div className="flex items-center justify-center space-x-2">
                        {Array.from({ length: 6 }).map((_, index) => (
                          <FormControl key={index}>
                            <Input
                              {...field}
                              type="text"
                              maxLength={1}
                              className="w-12 h-12 text-center rounded-md border border-input focus:ring-2 focus:ring-primary focus:border-primary"
                              value={field.value[index] || ''}
                              onChange={(e) => {
                                const value = e.target.value;
                                if (value.match(/^[0-9]$/)) {
                                  const newValue = field.value.substring(0, index) + value + field.value.substring(index + 1);
                                  field.onChange(newValue);
                                  if (index < 5) {
                                    const nextInput = document.getElementById(`digit-${index + 1}`);
                                    if (nextInput) {
                                      nextInput.focus();
                                    }
                                  }
                                } else if (value === '') {
                                  const newValue = field.value.substring(0, index) + field.value.substring(index + 1);
                                  field.onChange(newValue);
                                  if (index > 0) {
                                    const prevInput = document.getElementById(`digit-${index - 1}`);
                                    if (prevInput) {
                                      prevInput.focus();
                                    }
                                  }
                                }
                              }}
                              id={`digit-${index}`}
                            />
                          </FormControl>
                        ))}
                      </div>
                      <FormDescription className="text-center mt-2">
                        Enter the 6-digit code sent to your {contactData?.contact_type === 'email' ? 'email' : 'phone'}
                      </FormDescription>
                      <FormMessage />
                    </FormItem>
                  )}
                />
              </div>

              <div className="flex flex-col sm:flex-row justify-between items-center gap-4">
                <Button
                  type="button"
                  variant="outline"
                  onClick={() => {
                    resendVerificationCode();
                  }}
                  disabled={isResending}
                >
                  {isResending ? 'Resending...' : 'Resend Code'}
                </Button>
                <Button type="submit" className="w-full sm:w-auto">
                  Verify
                </Button>
              </div>
            </form>
          </Form>
        );

      case RegistrationStep.Details:
        return (
          <Form {...detailsForm}>
            <form onSubmit={detailsForm.handleSubmit(handleDetailsSubmit)} className="space-y-6">
              {/* Company Information */}
              <div className="space-y-6">
                <h3 className="text-lg font-medium">Company Information</h3>
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
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
                          <Input type="email" {...field} />
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
              </div>

              {/* Admin Information */}
              <div className="space-y-6">
                <h3 className="text-lg font-medium">Admin Information</h3>
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
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
                          <Input type="email" {...field} />
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
                          <Input type="password" {...field} />
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
                          <Input type="password" {...field} />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                </div>
              </div>

              <Button type="submit" className="w-full">
                Register
              </Button>
            </form>
          </Form>
        );

      case RegistrationStep.Success:
        return (
          <RegistrationSuccess
            companyName={successData?.companyName || ''}
            redirectUrl={successData?.redirectUrl || route('dashboard')}
          />
        );

      default:
        return null;
    }
  };

  return (
    <InstallationLayout
      currentStep={currentStep}
      totalSteps={4}
      onNext={handleNextStep}
      onBack={handleBackStep}
      isLoading={isLoading}
    >
      <div className="space-y-8">
        {error && (
          <Alert variant="destructive">
            <AlertTitle>Error</AlertTitle>
            <AlertDescription>{error}</AlertDescription>
          </Alert>
        )}

        {renderStep()}

        <div className="mt-8">
          <Link
            href={route('login')}
            className="text-sm font-medium text-primary hover:underline"
          >
            Already have an account? Sign in
          </Link>
        </div>
      </div>
    </InstallationLayout>
  );
}
