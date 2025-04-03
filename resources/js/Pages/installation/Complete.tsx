import React from 'react';
import { Head } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';
import { Button } from '@/components/ui/button';

export default function Complete({ currentStep, totalSteps }) {
  const handleLogin = () => {
    window.location.href = route('login');
  };

  return (
    <>
      <Head>
        <title>Installation Complete - HRIS Open Source</title>
      </Head>

      <InstallationLayout
        title="Installation Complete"
        description="Your installation is now complete. You can now log in to your account."
        currentStep={currentStep}
        totalSteps={totalSteps}
      >
        <div className="text-center">
          <div className="mb-8">
            <svg
              className="mx-auto h-12 w-12 text-green-500"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M5 13l4 4L19 7"
              />
            </svg>
            <h2 className="mt-3 text-2xl font-bold text-gray-900">Installation Complete!</h2>
            <p className="mt-2 text-gray-600">
              Your system is now ready to use. You can log in with your admin credentials.
            </p>
          </div>

          <Button
            onClick={handleLogin}
            className="w-full md:w-auto"
          >
            Go to Login Page
          </Button>
        </div>
      </InstallationLayout>
    </>
  );
}
