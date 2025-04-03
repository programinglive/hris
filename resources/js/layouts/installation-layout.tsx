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
  totalSteps = 6, // Contact, Verification, CompanyDetails, SystemSetup, AdminSetup, Complete
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
    <div className="min-h-screen bg-gradient-to-br from-gray-50 to-white">
      <Head>
        <title>Installation</title>
      </Head>
      
      <div className="flex flex-col min-h-screen">
        {/* Header */}
        <header className="bg-white shadow-sm">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div className="flex justify-between items-center">
              <div className="flex-shrink-0">
                <h1 className="text-xl font-bold text-gray-900">Installation</h1>
              </div>
              <div className="flex items-center space-x-4">
                {currentStep > 1 && (
                  <Button 
                    variant="outline" 
                    onClick={onBack} 
                    disabled={isLoading}
                    className="whitespace-nowrap"
                  >
                    Back
                  </Button>
                )}
                <Button
                  type="button"
                  onClick={handleButtonClick}
                  disabled={isLoading}
                  className="whitespace-nowrap"
                >
                  {isLoading ? 'Loading...' : currentStep === totalSteps ? 'Finish' : 'Next'}
                </Button>
              </div>
            </div>
          </div>
        </header>

        {/* Progress Bar */}
        <div className="bg-white shadow-sm">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div className="flex items-center justify-between">
              <div className="text-sm text-gray-600">
                Step {currentStep} of {totalSteps}
              </div>
              <div className="w-full max-w-xs">
                <div className="bg-gray-200 rounded-full h-2">
                  <div
                    className="bg-primary h-2 rounded-full transition-all duration-300"
                    style={{ width: `${((currentStep - 1) / (totalSteps - 1)) * 100}%` }}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Main Content */}
        <main className="flex-1">
          <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div className="bg-white rounded-lg shadow-lg p-8">
              <div className="space-y-6">
                {children}
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  );
}
