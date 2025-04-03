import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/react';
import { useState } from 'react';

interface CompletionStepProps {
  onSubmit: () => void;
  onBack: () => void;
  isLoading?: boolean;
  error?: string;
}

export default function CompletionStep({
  onSubmit,
  onBack,
  isLoading = false,
  error,
}: CompletionStepProps) {
  const { data, setData, post, processing } = useForm({
    company_id: '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    onSubmit();
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
            <CardTitle>Completion</CardTitle>
            <CardDescription>
              Please review your registration details and complete the registration.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div>
              <Label htmlFor="company_id">Company ID</Label>
              <Input
                id="company_id"
                value={data.company_id}
                onChange={(e) => setData('company_id', e.target.value)}
                disabled
              />
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
            {isLoading ? 'Loading...' : 'Complete Registration'}
          </Button>
        </div>
      </form>
    </div>
  );
}
