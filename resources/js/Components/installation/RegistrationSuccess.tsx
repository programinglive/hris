import { useEffect, useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface RegistrationSuccessProps {
  companyName: string;
}

export default function RegistrationSuccess({ companyName }: RegistrationSuccessProps) {
  const [countdown, setCountdown] = useState(5);

  const handleRedirect = () => {
    router.visit('/dashboard');
  };

  useEffect(() => {
    if (countdown > 0) {
      const timer = setTimeout(() => {
        setCountdown(countdown - 1);
      }, 1000);
      return () => clearTimeout(timer);
    } else {
      handleRedirect();
    }
  }, [countdown]);

  return (
    <div className="min-h-screen bg-background flex flex-col items-center justify-center">
      <Head>
        <title>Registration Successful - BeautyWorld HRIS</title>
      </Head>

      <div className="max-w-md w-full space-y-8">
        <Card>
          <CardHeader>
            <CardTitle className="text-3xl font-bold text-primary">🎉 Registration Successful!</CardTitle>
            <CardDescription>
              Your company {companyName} has been successfully registered.
            </CardDescription>
          </CardHeader>
          <CardContent className="text-center">
            <div className="space-y-4">
              <p className="text-gray-600">
                We're redirecting you to the dashboard in {countdown} seconds...
              </p>
              <Button onClick={handleRedirect} className="w-full flex justify-center py-2 px-4">
                Go to Dashboard
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
