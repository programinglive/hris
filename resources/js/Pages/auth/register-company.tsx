import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import axios from 'axios';

import AuthLayout from '@/layouts/auth-layout';
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
  company_name: z.string().min(2, {
    message: "Company name must be at least 2 characters.",
  }),
  
  // Admin user information
  admin_name: z.string().min(2, {
    message: "Name must be at least 2 characters.",
  }),
  admin_email: z.string().email({
    message: "Please enter a valid email address.",
  }),
  admin_password: z.string().min(8, {
    message: "Password must be at least 8 characters.",
  }),
  admin_password_confirmation: z.string(),
}).refine((data) => data.admin_password === data.admin_password_confirmation, {
  message: "Passwords don't match",
  path: ["admin_password_confirmation"],
});


// Define the steps of the registration process
type RegistrationStep = 'contact' | 'verify' | 'details' | 'success';

export default function RegisterCompany() {
  // State for managing the current step and error/success messages
  const [currentStep, setCurrentStep] = useState<RegistrationStep>('contact');
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<string | null>(null);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [contactInfo, setContactInfo] = useState<{ contact: string; contact_type: 'email' | 'phone' } | null>(null);

  // Step 1: Contact Information Form
  const contactForm = useForm<z.infer<typeof contactSchema>>({  
    resolver: zodResolver(contactSchema),
    defaultValues: {
      contact: '',
      contact_type: 'email',
    },
  });

  // Step 2: Verification Code Form
  const verificationForm = useForm<z.infer<typeof verificationSchema>>({  
    resolver: zodResolver(verificationSchema),
    defaultValues: {
      verification_code: '',
    },
  });

  // Step 3: Company and Admin Details Form
  const detailsForm = useForm<z.infer<typeof detailsSchema>>({  
    resolver: zodResolver(detailsSchema),
    defaultValues: {
      company_name: '',
      admin_name: '',
      admin_email: '',
      admin_password: '',
      admin_password_confirmation: '',
    },
  });

  // Handle contact form submission (Step 1)
  const onContactSubmit = async (values: z.infer<typeof contactSchema>) => {
    setError(null);
    setIsSubmitting(true);
    
    try {
      const response = await axios.post(route('register.company.validate-contact'), values);
      
      if (response.data.success) {
        setContactInfo(values);
        setSuccess(response.data.message);
        setCurrentStep('verify');
      }
    } catch (err: never) {
      setError(err.response?.data?.message || 'An error occurred while validating your contact information.');
    } finally {
      setIsSubmitting(false);
    }
  };

  // Handle verification code submission (Step 2)
  const onVerificationSubmit = async (values: z.infer<typeof verificationSchema>) => {
    setError(null);
    setIsSubmitting(true);
    
    try {
      const response = await axios.post(route('register.company.verify-code'), values);
      
      if (response.data.success) {
        setSuccess(response.data.message);
        setCurrentStep('details');
      }
    } catch (err: never) {
      setError(err.response?.data?.message || 'Invalid verification code. Please try again.');
    } finally {
      setIsSubmitting(false);
    }
  };

  // Handle company and admin details submission (Step 3)
  const onDetailsSubmit = async (values: z.infer<typeof detailsSchema>) => {
    setError(null);
    setIsSubmitting(true);
    
    try {
      const response = await axios.post(route('register.company.save-details'), values);
      
      if (response.data.success) {
        setSuccess(response.data.message);
        setCurrentStep('success');
        
        // Redirect to dashboard after a short delay
        setTimeout(() => {
          window.location.href = response.data.redirect;
        }, 2000);
      }
    } catch (err: never) {
      setError(err.response?.data?.message || 'An error occurred while saving your company details.');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <AuthLayout 
      title="Register Your Company" 
      description="Create an account to manage your company with our HRIS system"
    >
      <Head title="Register Your Company" />
      
      <div className="w-full max-w-lg mx-auto">
        {/* Error and Success Messages */}
        {error && (
          <Alert className="mb-4 bg-red-50 border-red-200 text-red-800">
            <AlertTitle>Error</AlertTitle>
            <AlertDescription>{error}</AlertDescription>
          </Alert>
        )}
        
        {success && (
          <Alert className="mb-4 bg-green-50 border-green-200 text-green-800">
            <AlertTitle>Success</AlertTitle>
            <AlertDescription>{success}</AlertDescription>
          </Alert>
        )}
        
        {/* Step 1: Contact Information */}
        {currentStep === 'contact' && (
          <Card className="shadow-lg border-0">
            <CardHeader className="px-6 py-4">
              <CardTitle>Step 1: Contact Information</CardTitle>
              <CardDescription>
                Enter your email or phone number to receive a verification code
              </CardDescription>
            </CardHeader>
            <CardContent className="px-6 py-4">
              <Form {...contactForm}>
                <form onSubmit={contactForm.handleSubmit(onContactSubmit)} className="space-y-6">
                  <div className="space-y-6">
                    <FormField
                      control={contactForm.control}
                      name="contact_type"
                      render={({ field }) => (
                        <FormItem className="space-y-1">
                          <FormLabel>Contact Type</FormLabel>
                          <div className="flex space-x-4">
                            <div className="flex items-center">
                              <input
                                type="radio"
                                id="email-type"
                                value="email"
                                checked={field.value === 'email'}
                                onChange={() => field.onChange('email')}
                                className="mr-2"
                              />
                              <label htmlFor="email-type">Email</label>
                            </div>
                            <div className="flex items-center">
                              <input
                                type="radio"
                                id="phone-type"
                                value="phone"
                                checked={field.value === 'phone'}
                                onChange={() => field.onChange('phone')}
                                className="mr-2"
                              />
                              <label htmlFor="phone-type">Phone</label>
                            </div>
                          </div>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                    
                    <FormField
                      control={contactForm.control}
                      name="contact"
                      render={({ field }) => (
                        <FormItem>
                          <FormLabel>
                            {contactForm.watch('contact_type') === 'email' ? 'Email Address' : 'Phone Number'}
                          </FormLabel>
                          <FormControl>
                            <Input 
                              placeholder={contactForm.watch('contact_type') === 'email' 
                                ? "Enter your email address" 
                                : "Enter your phone number"} 
                              type={contactForm.watch('contact_type') === 'email' ? "email" : "tel"}
                              {...field} 
                            />
                          </FormControl>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                  </div>
                  
                  <div className="flex flex-col space-y-4 pt-6">
                    <Button 
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full px-6 py-3 bg-black hover:bg-gray-800 text-white font-medium"
                    >
                      {isSubmitting ? 'Sending...' : 'Send Verification Code'}
                    </Button>
                    
                    <Button
                      type="button"
                      variant="outline"
                      className="w-full px-4 py-2 text-sm"
                      asChild
                    >
                      <Link href={route('login')}>
                        Already have an account? Login
                      </Link>
                    </Button>
                  </div>
                </form>
              </Form>
            </CardContent>
          </Card>
        )}
        
        {/* Step 2: Verification Code */}
        {currentStep === 'verify' && (
          <Card className="shadow-lg border-0">
            <CardHeader className="px-6 py-4">
              <CardTitle>Step 2: Verify Your Contact</CardTitle>
              <CardDescription>
                Enter the 6-digit verification code sent to {contactInfo?.contact}
              </CardDescription>
            </CardHeader>
            <CardContent className="px-6 py-4">
              <Form {...verificationForm}>
                <form onSubmit={verificationForm.handleSubmit(onVerificationSubmit)} className="space-y-6">
                  <FormField
                    control={verificationForm.control}
                    name="verification_code"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Verification Code</FormLabel>
                        <FormControl>
                          <Input 
                            placeholder="Enter 6-digit code" 
                            maxLength={6}
                            {...field} 
                          />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  
                  <div className="flex flex-col space-y-4 pt-6">
                    <Button 
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full px-6 py-3 bg-black hover:bg-gray-800 text-white font-medium"
                    >
                      {isSubmitting ? 'Verifying...' : 'Verify Code'}
                    </Button>
                    
                    <Button
                      type="button"
                      variant="outline"
                      className="w-full px-4 py-2"
                      onClick={() => setCurrentStep('contact')}
                    >
                      Back
                    </Button>
                  </div>
                </form>
              </Form>
            </CardContent>
          </Card>
        )}
        
        {/* Step 3: Company and Admin Details */}
        {currentStep === 'details' && (
          <Card className="shadow-lg border-0">
            <CardHeader className="px-6 py-4">
              <CardTitle>Step 3: Complete Registration</CardTitle>
              <CardDescription>
                Enter your company name and admin user details
              </CardDescription>
            </CardHeader>
            <CardContent className="px-6 py-4">
              <Form {...detailsForm}>
                <form onSubmit={detailsForm.handleSubmit(onDetailsSubmit)} className="space-y-6">
                  <div className="space-y-6">
                    <FormField
                      control={detailsForm.control}
                      name="company_name"
                      render={({ field }) => (
                        <FormItem>
                          <FormLabel>Company Name</FormLabel>
                          <FormControl>
                            <Input placeholder="Enter company name" {...field} />
                          </FormControl>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                    
                    <FormField
                      control={detailsForm.control}
                      name="admin_name"
                      render={({ field }) => (
                        <FormItem>
                          <FormLabel>Admin Name</FormLabel>
                          <FormControl>
                            <Input placeholder="Enter admin name" {...field} />
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
                            <Input type="email" placeholder="Enter admin email" {...field} />
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
                            <Input type="password" placeholder="Create a password" {...field} />
                          </FormControl>
                          <FormDescription>
                            Password must be at least 8 characters long
                          </FormDescription>
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
                            <Input type="password" placeholder="Confirm your password" {...field} />
                          </FormControl>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                  </div>
                  
                  <div className="flex flex-col space-y-4 pt-6">
                    <Button 
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full px-6 py-3 bg-black hover:bg-gray-800 text-white font-medium"
                    >
                      {isSubmitting ? 'Registering...' : 'Complete Registration'}
                    </Button>
                    
                    <Button
                      type="button"
                      variant="outline"
                      className="w-full px-4 py-2"
                      onClick={() => setCurrentStep('verify')}
                    >
                      Back
                    </Button>
                  </div>
                </form>
              </Form>
            </CardContent>
          </Card>
        )}
        
        {/* Step 4: Success */}
        {currentStep === 'success' && (
          <Card className="shadow-lg border-0">
            <CardHeader className="px-6 py-4">
              <CardTitle>Registration Successful!</CardTitle>
              <CardDescription>
                Your company has been registered successfully.
              </CardDescription>
            </CardHeader>
            <CardContent className="px-6 py-4">
              <div className="text-center py-4">
                <p className="mb-4">Redirecting you to the dashboard...</p>
                <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 mx-auto"></div>
              </div>
            </CardContent>
          </Card>
        )}
      </div>
    </AuthLayout>
  );
}
