import { useState } from 'react';
import { router } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';
import VerificationStep from '@/components/installation/steps/VerificationStep';
import DetailsStep from '@/components/installation/steps/DetailsStep';
import ContactStep from '@/components/installation/steps/ContactStep';

interface PageProps {
  [key: string]: any;
  flash: {
    verification_code?: string;
  };
  errors: {
    [key: string]: string[];
  };
  deferred?: {
    [key: string]: string[];
  };
}

enum RegistrationStep {
  Contact = 1,
  Verification = 2,
  Details = 3,
}

export default function RegisterCompany({ title }: { title: string }) {
  const [currentStep, setCurrentStep] = useState<RegistrationStep>(RegistrationStep.Contact);
  const [contactData, setContactData] = useState<{
    contact: string;
    contact_type: 'email' | 'phone';
  } | null>(null);
  const [error, setError] = useState<string | undefined>(undefined);
  const [isLoading, setIsLoading] = useState(false);
  const [isResending, setIsResending] = useState(false);
  const { flash, errors, deferred } = usePage<PageProps>().props;

  const handleBack = () => {
    if (currentStep === RegistrationStep.Details) {
      setCurrentStep(RegistrationStep.Verification);
    } else if (currentStep === RegistrationStep.Verification) {
      setCurrentStep(RegistrationStep.Contact);
    }
  };

  const handleContactSubmit = async (data: {
    contact: string;
    contact_type: 'email' | 'phone';
  }) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.post('/installation-wizard/validate-contact', data);
      setContactData(data);
      setCurrentStep(RegistrationStep.Verification);
    } catch (err: any) {
      setError(err.message || 'Failed to validate contact information');
    } finally {
      setIsLoading(false);
    }
  };

  const handleVerificationSubmit = async (code: string) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.post('/installation-wizard/verify-code', {
        verification_code: code,
        contact: contactData?.contact,
        contact_type: contactData?.contact_type,
      });

      setCurrentStep(RegistrationStep.Details);
    } catch (err: any) {
      setError(err.message || 'Failed to verify code');
    } finally {
      setIsLoading(false);
    }
  };

  const handleResendCode = async () => {
    try {
      setIsResending(true);
      setError(undefined);

      if (contactData) {
        await router.post('/installation-wizard/resend-code', contactData);
      }
    } catch (err: any) {
      setError(err.message || 'Failed to resend verification code');
    } finally {
      setIsResending(false);
    }
  };

  const handleDetailsSubmit = async (data: {
    company_name: string;
    company_email: string;
    company_phone: string;
    company_address: string;
    company_city: string;
    company_country: string;
    admin_name: string;
    admin_email: string;
    admin_password: string;
    admin_password_confirmation: string;
  }) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.post('/installation-wizard/save-company-details', {
        ...data,
        contact_type: contactData?.contact_type,
        contact: contactData?.contact,
        verification_code: flash.verification_code,
      });
    } catch (err: any) {
      setError(err.message || 'Failed to save company details');
    } finally {
      setIsLoading(false);
    }
  };

  const renderStep = () => {
    switch (currentStep) {
      case RegistrationStep.Contact:
        return (
          <ContactStep
            onSubmit={handleContactSubmit}
            isLoading={isLoading}
            error={error || undefined}
          />
        );

      case RegistrationStep.Verification:
        if (!contactData) {
          return (
            <div className="text-center py-8">
              <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto"></div>
              <p className="mt-4 text-gray-600">Loading contact information...</p>
            </div>
          );
        }
        return (
          <VerificationStep
            contactData={contactData}
            onVerify={handleVerificationSubmit}
            onBack={handleBack}
            onResend={handleResendCode}
            isLoading={isLoading}
            isResending={isResending}
            error={error || undefined}
          />
        );

      case RegistrationStep.Details:
        return (
          <DetailsStep
            onSubmit={handleDetailsSubmit}
            onBack={handleBack}
            isLoading={isLoading}
            error={error || undefined}
            contactData={contactData}
            verificationCode={flash.verification_code || ''}
          />
        );

      default:
        return null;
    }
  };

  return (
    <InstallationLayout
      currentStep={currentStep}
      totalSteps={Object.keys(RegistrationStep).length}
      onNext={(e: React.FormEvent<HTMLFormElement>) => {
        if (currentStep === RegistrationStep.Verification) {
          e.preventDefault();
          const form = e.currentTarget;
          if (form) {
            form.dispatchEvent(new Event('submit', { bubbles: true }));
          }
        }
      }}
    >
      <div className="flex-1 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div className="w-full max-w-md space-y-8">
          <div>
            <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
              {currentStep === RegistrationStep.Contact
                ? 'Step 1: Contact Information'
                : currentStep === RegistrationStep.Verification
                ? 'Step 2: Verification'
                : 'Step 3: Company & Admin Details'}
            </h2>
          </div>
          
          {error && (
            <div className="rounded-md bg-red-50 p-4">
              <div className="flex">
                <div className="ml-3">
                  <h3 className="text-sm font-medium text-red-800">Error</h3>
                  <div className="mt-2 text-sm text-red-700">
                    <p>{error}</p>
                  </div>
                </div>
              </div>
            </div>
          )}

          {renderStep()}
        </div>
      </div>
    </InstallationLayout>
  );
}
