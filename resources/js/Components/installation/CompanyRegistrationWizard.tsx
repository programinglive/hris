import React, { useState, useEffect } from 'react';
import WizardStep from './WizardStep';
import { useForm } from '@inertiajs/react';

interface CompanyRegistrationWizardProps {
  currentStep: number;
  totalSteps: number;
  onNext: (data: any) => void;
}

export default function CompanyRegistrationWizard({ 
  currentStep, 
  totalSteps, 
  onNext 
}: CompanyRegistrationWizardProps) {
  const [stepData, setStepData] = useState({
    basic: {
      company_name: '',
      company_email: '',
      company_phone: '',
    },
    address: {
      company_address: '',
      company_city: '',
      company_country: '',
    },
    verification: {
      terms_accepted: false,
    },
  });

  const { data, setData, post, processing, errors } = useForm({
    ...stepData.basic,
    ...stepData.address,
    ...stepData.verification,
  });

  useEffect(() => {
    // Load saved progress if available
    const savedProgress = localStorage.getItem('companyRegistrationProgress');
    if (savedProgress) {
      const progress = JSON.parse(savedProgress);
      setStepData(progress);
      setData(progress);
    }
  }, []);

  const handleStepChange = (step: string, field: string, value: any) => {
    setStepData(prev => ({
      ...prev,
      [step]: {
        ...prev[step],
        [field]: value,
      },
    }));
    setData(prev => ({
      ...prev,
      [field]: value,
    }));
  };

  const handleNext = () => {
    // Save progress before moving to next step
    localStorage.setItem('companyRegistrationProgress', JSON.stringify(stepData));
    
    // Validate current step data
    const currentStepData = Object.values(stepData)[currentStep - 1];
    const hasErrors = Object.values(currentStepData).some(value => !value);

    if (hasErrors) {
      alert('Please fill in all required fields');
      return;
    }

    // If last step, submit form
    if (currentStep === totalSteps) {
      post(route('install.company.store'), {
        onSuccess: () => {
          // Clear saved progress after successful submission
          localStorage.removeItem('companyRegistrationProgress');
        },
        onError: (errors) => {
          // Handle validation errors
          console.error('Validation errors:', errors);
        },
      });
    } else {
      onNext(data);
    }
  };

  const renderStep = (step: number) => {
    const isCurrent = step === currentStep;
    const isCompleted = step < currentStep;

    switch (step) {
      case 1:
        return (
          <WizardStep 
            title="Basic Information"
            description="Enter your company's basic information"
            isCurrent={isCurrent}
            isCompleted={isCompleted}
          >
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Company Name
                </label>
                <input
                  type="text"
                  name="company_name"
                  value={data.company_name}
                  onChange={(e) => handleStepChange('basic', 'company_name', e.target.value)}
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                  required
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Company Email
                </label>
                <input
                  type="email"
                  name="company_email"
                  value={data.company_email}
                  onChange={(e) => handleStepChange('basic', 'company_email', e.target.value)}
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                  required
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Company Phone
                </label>
                <input
                  type="tel"
                  name="company_phone"
                  value={data.company_phone}
                  onChange={(e) => handleStepChange('basic', 'company_phone', e.target.value)}
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                  required
                />
              </div>
            </div>
          </WizardStep>
        );
      case 2:
        return (
          <WizardStep 
            title="Address Information"
            description="Enter your company's address details"
            isCurrent={isCurrent}
            isCompleted={isCompleted}
          >
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Company Address
                </label>
                <input
                  type="text"
                  name="company_address"
                  value={data.company_address}
                  onChange={(e) => handleStepChange('address', 'company_address', e.target.value)}
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                  required
                />
              </div>
              <div className="grid grid-cols-2 gap-6">
                <div>
                  <label className="block text-sm font-medium text-gray-700">
                    City
                  </label>
                  <input
                    type="text"
                    name="company_city"
                    value={data.company_city}
                    onChange={(e) => handleStepChange('address', 'company_city', e.target.value)}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                    required
                  />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">
                    Country
                  </label>
                  <input
                    type="text"
                    name="company_country"
                    value={data.company_country}
                    onChange={(e) => handleStepChange('address', 'company_country', e.target.value)}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                    required
                  />
                </div>
              </div>
            </div>
          </WizardStep>
        );
      case 3:
        return (
          <WizardStep 
            title="Verification"
            description="Review and verify your company information"
            isCurrent={isCurrent}
            isCompleted={isCompleted}
          >
            <div className="space-y-4">
              <div className="text-sm text-gray-500">
                Please review your company information before proceeding:
              </div>
              <div className="border-t border-gray-200 pt-4">
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Company Name
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_name}</p>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Company Email
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_email}</p>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Company Phone
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_phone}</p>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Company Address
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_address}</p>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      City
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_city}</p>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Country
                    </label>
                    <p className="mt-1 text-sm text-gray-900">{data.company_country}</p>
                  </div>
                </div>
              </div>
              <div className="flex items-center">
                <input
                  id="terms_accepted"
                  name="terms_accepted"
                  type="checkbox"
                  checked={data.terms_accepted}
                  onChange={(e) => handleStepChange('verification', 'terms_accepted', e.target.checked)}
                  className="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                />
                <label htmlFor="terms_accepted" className="ml-2 block text-sm text-gray-900">
                  I agree to the terms and conditions
                </label>
              </div>
            </div>
          </WizardStep>
        );
      default:
        return null;
    }
  };

  return (
    <div className="space-y-6">
      {/* Progress Bar */}
      <div className="relative pt-1">
        <div className="flex mb-2 items-center justify-between">
          <div className="text-right">
            <span className="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-primary bg-primary-100">
              Step {currentStep} of {totalSteps}
            </span>
          </div>
        </div>
        <div className="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
          <div 
            style={{ width: `${(currentStep / totalSteps) * 100}%` }}
            className="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"
          ></div>
        </div>
      </div>

      {/* Step Content */}
      {renderStep(currentStep)}

      {/* Navigation */}
      <div className="flex justify-between items-center">
        {currentStep > 1 && (
          <button
            onClick={() => onNext(data)}
            className="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
          >
            Previous
          </button>
        )}
        <button
          onClick={handleNext}
          disabled={processing}
          className="px-4 py-2 bg-primary border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {currentStep === totalSteps ? 'Complete Registration' : 'Next'}
        </button>
      </div>
    </div>
  );
}
