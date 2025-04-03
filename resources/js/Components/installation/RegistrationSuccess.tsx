import { useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface RegistrationSuccessProps {
  companyName: string;
}

export default function RegistrationSuccess({ companyName }: RegistrationSuccessProps) {
  useEffect(() => {
    // No need for redirect logic since the backend handles it
  }, []);

  return (
    <div className="min-h-screen bg-background flex flex-col items-center justify-center">
      <Head>
        <title>Registration Successful</title>
      </Head>
      <div className="max-w-md w-full space-y-8">
        <Card>
          <CardHeader>
            <CardTitle className="text-3xl font-bold text-primary">🎉 Registration Successful!</CardTitle>
            <CardDescription>
              Your company {companyName} has been registered successfully.
            </CardDescription>
          </CardHeader>
          <CardContent className="text-center">
            <div className="space-y-4">
              <Button onClick={() => router.visit('/dashboard')} className="w-full flex justify-center py-2 px-4">
                Go to Dashboard
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
