import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';

interface AdminSetupStepProps {
  onSubmit: (data: {
    admin_name: string;
    admin_email: string;
    admin_password: string;
    admin_password_confirmation: string;
  }) => void;
  onBack: () => void;
  isLoading: boolean;
  error?: string;
}

export default function AdminSetupStep({
  onSubmit,
  onBack,
  isLoading,
  error,
}: AdminSetupStepProps) {
  const form = useForm({
    admin_name: '',
    admin_email: '',
    admin_password: '',
    admin_password_confirmation: '',
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
            <CardTitle>Admin Setup</CardTitle>
            <CardDescription>
              Create your admin account.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <div>
              <label htmlFor="admin_name" className="block text-sm font-medium leading-6 text-gray-900">
                Admin Name
              </label>
              <div className="mt-2">
                <Input
                  id="admin_name"
                  type="text"
                  value={form.data.admin_name}
                  onChange={(e) => form.setData('admin_name', e.target.value)}
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
                  value={form.data.admin_email}
                  onChange={(e) => form.setData('admin_email', e.target.value)}
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
                  value={form.data.admin_password}
                  onChange={(e) => form.setData('admin_password', e.target.value)}
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
                  value={form.data.admin_password_confirmation}
                  onChange={(e) => form.setData('admin_password_confirmation', e.target.value)}
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
