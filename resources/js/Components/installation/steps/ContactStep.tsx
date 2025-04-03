import { useState } from 'react';
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
  const [values, setValues] = useState({
    contact: '',
    contact_type: 'email' as 'email' | 'phone',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const key = e.target.id;
    const value = e.target.value;
    setValues(prev => ({
      ...prev,
      [key]: value,
    }));
  };

  const handleSelectChange = (value: string) => {
    setValues(prev => ({
      ...prev,
      contact_type: value as 'email' | 'phone',
    }));
  };

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    
    // Basic validation
    if (!values.contact.trim()) {
      return;
    }

    if (values.contact_type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.contact)) {
      return;
    }

    if (values.contact_type === 'phone' && !/^[0-9+\s]+$/.test(values.contact)) {
      return;
    }

    onSubmit(values);
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

      <Card>
        <CardHeader>
          <CardTitle>Contact Information</CardTitle>
          <CardDescription>
            Please enter your contact information to receive the verification code
          </CardDescription>
        </CardHeader>
        <CardContent>
          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="space-y-2">
              <label htmlFor="contact" className="block text-sm font-medium text-gray-700">
                Contact
              </label>
              <Input
                id="contact"
                value={values.contact}
                onChange={handleChange}
                placeholder="Enter your email or phone number"
                required
              />
              <p className="text-sm text-gray-500">
                Enter your email or phone number
              </p>
            </div>

            <div className="space-y-2">
              <label htmlFor="contact_type" className="block text-sm font-medium text-gray-700">
                Contact Type
              </label>
              <Select
                onValueChange={handleSelectChange}
                defaultValue={values.contact_type}
              >
                <SelectTrigger>
                  <SelectValue placeholder="Select contact type" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="email">Email</SelectItem>
                  <SelectItem value="phone">Phone</SelectItem>
                </SelectContent>
              </Select>
              <p className="text-sm text-gray-500">
                Select how you want to receive the verification code
              </p>
            </div>

            <Button type="submit" disabled={isLoading}>
              {isLoading ? 'Submitting...' : 'Next'}
            </Button>
          </form>
        </CardContent>
      </Card>
    </div>
  );
}
