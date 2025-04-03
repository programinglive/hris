import React, { useState } from 'react';
import { Head, usePage } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';

export default function SystemSetup() {
  const { auth } = usePage().props;
  const [currentStep, setCurrentStep] = useState(1);
  const [totalSteps] = useState(4);
  const [isLoading, setIsLoading] = useState(false);

  const handleNext = async () => {
    setIsLoading(true);
    try {
      // Add your installation logic here
      setCurrentStep((prev) => prev + 1);
    } catch (error) {
      console.error('Installation error:', error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <InstallationLayout
      title="System Setup"
      description="Configure your system settings and dependencies"
      currentStep={currentStep}
      totalSteps={totalSteps}
      onNext={handleNext}
      isLoading={isLoading}
    >
      {/* Add your system setup form here */}
      <div className="space-y-6">
        <div>
          <label className="block text-sm font-medium text-gray-700">
            Environment
          </label>
          <select className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            <option value="development">Development</option>
            <option value="production">Production</option>
          </select>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">
            Database Connection
          </label>
          <div className="mt-1">
            <input
              type="text"
              placeholder="Database host"
              className="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>
        </div>
      </div>
    </InstallationLayout>
  );
}
