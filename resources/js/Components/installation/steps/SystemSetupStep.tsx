import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';

interface SystemSetupStepProps {
  onSubmit: (data: {
    system_name: string;
    system_email: string;
    system_phone: string;
  }) => void;
  onBack: () => void;
  isLoading: boolean;
  error?: string;
}

export default function SystemSetupStep({
  onSubmit,
  onBack,
  isLoading,
  error,
}: SystemSetupStepProps) {
  const form = useForm({
    system_name: '',
    system_email: '',
    system_phone: '',
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
            <CardTitle>System Setup</CardTitle>
            <CardDescription>
              Configure your HRIS system settings.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div>
              <label htmlFor="system_name" className="block text-sm font-medium leading-6 text-gray-900">
                System Name
              </label>
              <div className="mt-2">
                <Input
                  id="system_name"
                  type="text"
                  value={form.data.system_name}
                  onChange={(e) => form.setData('system_name', e.target.value)}
                />
              </div>
            </div>

            <div>
              <label htmlFor="system_email" className="block text-sm font-medium leading-6 text-gray-900">
                System Email
              </label>
              <div className="mt-2">
                <Input
                  id="system_email"
                  type="email"
                  value={form.data.system_email}
                  onChange={(e) => form.setData('system_email', e.target.value)}
                />
              </div>
            </div>

            <div>
              <label htmlFor="system_phone" className="block text-sm font-medium leading-6 text-gray-900">
                System Phone
              </label>
              <div className="mt-2">
                <Input
                  id="system_phone"
                  type="tel"
                  value={form.data.system_phone}
                  onChange={(e) => form.setData('system_phone', e.target.value)}
                />
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
            Next
          </Button>
        </div>
      </form>
    </div>
  );
}
