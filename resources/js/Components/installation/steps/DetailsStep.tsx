import { useState } from 'react';
import { router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Input } from '@/components/ui/input';

interface DetailsStepProps {
  onSubmit: (data: {
    company_name: string;
    company_email: string;
    company_phone: string;
    company_address: string;
    company_city: string;
    company_country: string;
    admin_name: string;
    admin_email: string;
    admin_password: string;
    admin_password_confirmation: string;
    contact_type: 'email' | 'phone';
    contact: string;
    verification_code: string;
  }) => void;
  onBack: () => void;
  isLoading: boolean;
  error?: string;
  contactData: {
    contact: string;
    contact_type: 'email' | 'phone';
  } | null;
  verificationCode: string;
}

export default function DetailsStep({
  onSubmit,
  onBack,
  isLoading,
  error,
  contactData,
  verificationCode,
}: DetailsStepProps) {
  const [formValues, setFormValues] = useState({
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
    contact_type: contactData?.contact_type || 'email',
    contact: contactData?.contact || '',
    verification_code: verificationCode,
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const key = e.target.id;
    const value = e.target.value;
    setFormValues((values) => ({
      ...values,
      [key]: value,
    }));
  };

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    router.post('/installation-wizard/save-company-details', formValues);
  };

  return (
    <div className="space-y-4">
      {error && (
        <Card className="bg-red-50 border-red-200">
          <CardContent>
            <p className="text-red-600">{error}</p>
          </CardContent>
        </Card>
      )}

      <form onSubmit={handleSubmit} className="space-y-4">
        {/* Company Information */}
        <Card>
          <CardHeader>
            <CardTitle>Company Information</CardTitle>
            <CardDescription>Please provide your company details</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="space-y-4">
              <div>
                <label htmlFor="company_name" className="block text-sm font-medium leading-6 text-gray-900">
                  Company Name
                </label>
                <div className="mt-2">
                  <Input
                    id="company_name"
                    type="text"
                    value={formValues.company_name}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="company_email" className="block text-sm font-medium leading-6 text-gray-900">
                  Company Email
                </label>
                <div className="mt-2">
                  <Input
                    id="company_email"
                    type="email"
                    value={formValues.company_email}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="company_phone" className="block text-sm font-medium leading-6 text-gray-900">
                  Company Phone
                </label>
                <div className="mt-2">
                  <Input
                    id="company_phone"
                    type="tel"
                    value={formValues.company_phone}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="company_address" className="block text-sm font-medium leading-6 text-gray-900">
                  Company Address
                </label>
                <div className="mt-2">
                  <Input
                    id="company_address"
                    type="text"
                    value={formValues.company_address}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="company_city" className="block text-sm font-medium leading-6 text-gray-900">
                  Company City
                </label>
                <div className="mt-2">
                  <Input
                    id="company_city"
                    type="text"
                    value={formValues.company_city}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="company_country" className="block text-sm font-medium leading-6 text-gray-900">
                  Company Country
                </label>
                <div className="mt-2">
                  <Input
                    id="company_country"
                    type="text"
                    value={formValues.company_country}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Admin Information */}
        <Card>
          <CardHeader>
            <CardTitle>Admin Information</CardTitle>
            <CardDescription>Please provide admin details</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="space-y-4">
              <div>
                <label htmlFor="admin_name" className="block text-sm font-medium leading-6 text-gray-900">
                  Admin Name
                </label>
                <div className="mt-2">
                  <Input
                    id="admin_name"
                    type="text"
                    value={formValues.admin_name}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="admin_email" className="block text-sm font-medium leading-6 text-gray-900">
                  Admin Email
                </label>
                <div className="mt-2">
                  <Input
                    id="admin_email"
                    type="email"
                    value={formValues.admin_email}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="admin_password" className="block text-sm font-medium leading-6 text-gray-900">
                  Admin Password
                </label>
                <div className="mt-2">
                  <Input
                    id="admin_password"
                    type="password"
                    value={formValues.admin_password}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="admin_password_confirmation" className="block text-sm font-medium leading-6 text-gray-900">
                  Confirm Password
                </label>
                <div className="mt-2">
                  <Input
                    id="admin_password_confirmation"
                    type="password"
                    value={formValues.admin_password_confirmation}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Contact Information */}
        <Card>
          <CardHeader>
            <CardTitle>Contact Information</CardTitle>
            <CardDescription>Please provide contact details</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="space-y-4">
              <div>
                <label htmlFor="contact_type" className="block text-sm font-medium leading-6 text-gray-900">
                  Contact Type
                </label>
                <div className="mt-2">
                  <select
                    id="contact_type"
                    value={formValues.contact_type}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  >
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                  </select>
                </div>
              </div>
              <div>
                <label htmlFor="contact" className="block text-sm font-medium leading-6 text-gray-900">
                  Contact
                </label>
                <div className="mt-2">
                  <Input
                    id="contact"
                    type="text"
                    value={formValues.contact}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
              <div>
                <label htmlFor="verification_code" className="block text-sm font-medium leading-6 text-gray-900">
                  Verification Code
                </label>
                <div className="mt-2">
                  <Input
                    id="verification_code"
                    type="text"
                    value={formValues.verification_code}
                    onChange={handleChange}
                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required
                  />
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        <div className="flex justify-between">
          <Button variant="outline" onClick={onBack} disabled={isLoading}>
            Back
          </Button>
          <Button type="submit" disabled={isLoading}>
            {isLoading ? 'Submitting...' : 'Submit'}
          </Button>
        </div>
      </form>
    </div>
  );
}
