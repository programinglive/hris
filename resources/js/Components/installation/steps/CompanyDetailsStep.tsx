import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

interface CompanyDetailsStepProps {
  onSubmit: (data: {
    company_name: string;
    company_email: string;
    company_phone: string;
    company_address: string;
    company_city: string;
    company_country: string;
  }) => void;
  onBack: () => void;
  isLoading: boolean;
  error?: string;
  contactData: {
    contact: string;
    contact_type: 'email' | 'phone';
  };
  verificationCode: string;
  companyName?: string;
}

export default function CompanyDetailsStep({
  onSubmit,
  onBack,
  isLoading,
  error,
  contactData,
  verificationCode,
  companyName,
}: CompanyDetailsStepProps) {
  const form = useForm({
    company_name: companyName || '',
    company_email: '',
    company_phone: '',
    company_address: '',
    company_city: '',
    company_country: '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    onSubmit(form.data);
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
        <Card>
          <CardHeader>
            <CardTitle>Company Details</CardTitle>
            <CardDescription>
              Please provide your company information.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div>
              <label htmlFor="company_name" className="block text-sm font-medium leading-6 text-gray-900">
                Company Name
              </label>
              <div className="mt-2">
                <Input
                  id="company_name"
                  type="text"
                  value={form.data.company_name}
                  onChange={(e) => form.setData('company_name', e.target.value)}
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
                  value={form.data.company_email}
                  onChange={(e) => form.setData('company_email', e.target.value)}
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
                  value={form.data.company_phone}
                  onChange={(e) => form.setData('company_phone', e.target.value)}
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
                  value={form.data.company_address}
                  onChange={(e) => form.setData('company_address', e.target.value)}
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
                  value={form.data.company_city}
                  onChange={(e) => form.setData('company_city', e.target.value)}
                  required
                />
              </div>
            </div>

            <div>
              <label htmlFor="company_country" className="block text-sm font-medium leading-6 text-gray-900">
                Company Country
              </label>
              <div className="mt-2">
                <Select
                  value={form.data.company_country}
                  onValueChange={(value) => form.setData('company_country', value)}
                  required
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Select country" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="ID">Indonesia</SelectItem>
                    <SelectItem value="US">United States</SelectItem>
                    <SelectItem value="GB">United Kingdom</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>
          </CardContent>
        </Card>

        <div className="flex justify-end space-x-4">
          <Button
            type="button"
            variant="outline"
            onClick={onBack}
            disabled={isLoading}
          >
            Back
          </Button>
          <Button
            type="submit"
            disabled={isLoading}
          >
            {isLoading ? 'Loading...' : 'Next'}
          </Button>
        </div>
      </form>
    </div>
  );
}
