import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

interface ContactStepProps {
  onSubmit: (data: {
    contact: string;
    contact_type: 'email' | 'phone';
  }) => void;
  isLoading: boolean;
  error?: string;
}

export default function ContactStep({
  onSubmit,
  isLoading,
  error,
}: ContactStepProps) {
  const form = useForm({
    contact: '',
    contact_type: 'email' as 'email' | 'phone',
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
            <CardTitle>Contact Information</CardTitle>
            <CardDescription>
              Please provide your contact information for verification.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div>
              <label htmlFor="contact_type" className="block text-sm font-medium leading-6 text-gray-900">
                Contact Type
              </label>
              <div className="mt-2">
                <Select
                  value={form.data.contact_type}
                  onValueChange={(value) => form.setData('contact_type', value as 'email' | 'phone')}
                >
                  <SelectTrigger className="w-full">
                    <SelectValue placeholder="Select contact type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="email">Email</SelectItem>
                    <SelectItem value="phone">Phone</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              {form.errors.contact_type && (
                <p className="mt-2 text-sm text-red-600">
                  {form.errors.contact_type}
                </p>
              )}
            </div>
            <div>
              <label htmlFor="contact" className="block text-sm font-medium leading-6 text-gray-900">
                Contact
              </label>
              <div className="mt-2">
                <Input
                  id="contact"
                  type={form.data.contact_type === 'email' ? 'email' : 'tel'}
                  value={form.data.contact}
                  onChange={(e) => form.setData('contact', e.target.value)}
                  className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  autoComplete={form.data.contact_type === 'email' ? 'email' : 'tel'}
                />
              </div>
              {form.errors.contact && (
                <p className="mt-2 text-sm text-red-600">
                  {form.errors.contact}
                </p>
              )}
            </div>
          </CardContent>
        </Card>

        <div className="flex justify-end">
          <Button type="submit" disabled={isLoading}>
            {isLoading ? 'Submitting...' : 'Continue'}
          </Button>
        </div>
      </form>
    </div>
  );
}
