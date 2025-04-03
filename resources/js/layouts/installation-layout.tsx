import React from 'react';
import { Head } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface InstallationLayoutProps {
  currentStep: number;
  totalSteps: number;
  onNext: (e: React.FormEvent<HTMLFormElement>) => void;
  onBack?: () => void;
  isLoading?: boolean;
}

export default function InstallationLayout({
  currentStep,
  totalSteps,
  onNext,
  onBack,
  isLoading = false,
  children,
}: InstallationLayoutProps & { children: React.ReactNode }) {
  const handleFormSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    onNext(e);
  };

  const handleButtonClick = () => {
    const form = document.querySelector('form');
    if (form) {
      const event = new Event('submit', { bubbles: true });
      form.dispatchEvent(event);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      <Head>
        <title>Installation</title>
      </Head>
      <main className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-2xl">
          <div className="text-center">
            <h1 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
              Installation
            </h1>
            <p className="mt-2 text-lg leading-8 text-gray-600">
              Step {currentStep} of {totalSteps}
            </p>
          </div>
          <div className="mt-10">
            <div className="space-y-6">
              {children}
            </div>
            <div className="mt-6 flex justify-between space-x-4">
              {onBack && (
                <Button variant="outline" onClick={onBack} disabled={isLoading}>
                  Back
                </Button>
              )}
              <Button
                type="button"
                onClick={handleButtonClick}
                disabled={isLoading}
              >
                {isLoading ? 'Loading...' : 'Next'}
              </Button>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
}
