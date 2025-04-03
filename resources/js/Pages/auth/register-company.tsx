import React, { useState, useEffect, useRef } from 'react';
import { router } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';
import ContactStep from '@/components/installation/steps/ContactStep';
import VerificationStep from '@/components/installation/steps/VerificationStep';
import CompanyDetailsStep from '@/components/installation/steps/CompanyDetailsStep';
import SystemSettingsStep from '@/components/installation/steps/SystemSettingsStep';
import AdminSetupStep from '@/components/installation/steps/AdminSetupStep';
import CompletionStep from '@/components/installation/steps/CompletionStep';
import CompleteStep from '@/components/installation/steps/CompleteStep';
import RegistrationSuccess from '@/components/installation/RegistrationSuccess';

interface PageProps {
  [key: string]: any;
  flash: {
    verification_code?: string;
    company_name?: string;
  };
  errors: {
    [key: string]: string[];
  };
  deferred?: {
    [key: string]: string[];
  };
}

interface Props {
  title: string;
}

enum RegistrationStep {
  Contact = 1,
  Verification = 2,
  CompanyDetails = 3,
  SystemSettings = 4,
  AdminSetup = 5,
  Completion = 6,
  Complete = 7,
}

export default function RegisterCompany({ title }: Props) {
  const [currentStep, setCurrentStep] = useState<RegistrationStep>(RegistrationStep.Contact);
  const [contactData, setContactData] = useState<{
    contact: string;
    contact_type: 'email' | 'phone';
  } | null>(null);
  const [error, setError] = useState<string | undefined>(undefined);
  const [isLoading, setIsLoading] = useState(false);
  const [isResending, setIsResending] = useState(false);
  const [countdown, setCountdown] = useState(300);
  const [showCountdown, setShowCountdown] = useState(true);
  const { flash, errors, deferred } = usePage<PageProps>().props;
  const formRef = useRef<HTMLFormElement>(null);

  const handleBack = () => {
    if (currentStep === RegistrationStep.CompanyDetails) {
      setCurrentStep(RegistrationStep.Verification);
    } else if (currentStep === RegistrationStep.Verification) {
      setCurrentStep(RegistrationStep.Contact);
    } else if (currentStep === RegistrationStep.SystemSettings) {
      setCurrentStep(RegistrationStep.CompanyDetails);
    } else if (currentStep === RegistrationStep.AdminSetup) {
      setCurrentStep(RegistrationStep.SystemSettings);
    } else if (currentStep === RegistrationStep.Completion) {
      setCurrentStep(RegistrationStep.AdminSetup);
    } else if (currentStep === RegistrationStep.Complete) {
      setCurrentStep(RegistrationStep.Completion);
    }
  };

  const handleContactSubmit = async (data: {
    contact: string;
    contact_type: 'email' | 'phone';
  }) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.post(route('landing-page.installation-wizard.validate-contact'), data, {
        onSuccess: (page) => {
          setContactData(data);
          setCurrentStep(RegistrationStep.Verification);
        },
        onError: (errors: any) => {
          setError(errors.contact?.[0] || 'Failed to validate contact information');
        }
      });
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

      await router.post(route('landing-page.installation-wizard.verify-code'), {
        verification_code: code
      }, {
        onSuccess: (page) => {
          setCurrentStep(RegistrationStep.CompanyDetails);
        },
        onError: (errors: any) => {
          setError(errors.verification_code?.[0] || 'Invalid verification code');
        }
      });
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
        await router.post(route('landing-page.installation-wizard.resend-code'), {
          contact: contactData.contact,
          contact_type: contactData.contact_type
        }, {
          onSuccess: () => {
            setCountdown(300);
            setShowCountdown(true);
          },
          onError: (errors: any) => {
            setError(errors.contact?.[0] || 'Failed to resend verification code');
          }
        });
      }
    } catch (err: any) {
      setError(err.message || 'Failed to resend verification code');
    } finally {
      setIsResending(false);
    }
  };

  const handleCompanyDetailsSubmit = async (data: {
    company_name: string;
    company_email: string;
    company_phone: string;
    company_address: string;
    company_city: string;
    company_country: string;
  }) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.post(route('landing-page.installation-wizard.save-company-details'), {
        ...data,
        contact: contactData?.contact,
        contact_type: contactData?.contact_type,
        verification_code: flash.verification_code
      }, {
        onSuccess: () => {
          setCurrentStep(RegistrationStep.SystemSettings);
        },
        onError: (errors: any) => {
          setError(errors.company_name?.[0] || 'Failed to save company details');
        }
      });
    } catch (err: any) {
      setError(err.message || 'Failed to save company details');
    } finally {
      setIsLoading(false);
    }
  };

  const handleSystemSettingsSubmit = async (data: any) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.visit(route('landing-page.installation-wizard.save-system-settings'), {
        method: 'post',
        data,
        onSuccess: () => {
          setCurrentStep(RegistrationStep.AdminSetup);
        },
        onError: (errors: any) => {
          setError(errors.system_settings?.[0] || 'Failed to save system settings');
        }
      });
    } catch (err: any) {
      setError(err.message || 'Failed to save system settings');
    } finally {
      setIsLoading(false);
    }
  };

  const handleAdminSetupSubmit = async (data: {
    admin_name: string;
    admin_email: string;
    admin_password: string;
  }) => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.visit(route('landing-page.installation-wizard.save-admin-details'), {
        method: 'post',
        data,
        onSuccess: () => {
          setCurrentStep(RegistrationStep.Completion);
        },
        onError: (errors: any) => {
          setError(errors.admin_name?.[0] || 'Failed to save admin details');
        }
      });
    } catch (err: any) {
      setError(err.message || 'Failed to save admin details');
    } finally {
      setIsLoading(false);
    }
  };

  const handleCompletionSubmit = async () => {
    try {
      setIsLoading(true);
      setError(undefined);

      await router.visit(route('landing-page.installation-wizard.complete'), {
        method: 'post',
        onSuccess: () => {
          setCurrentStep(RegistrationStep.Complete);
        },
        onError: (errors: any) => {
          setError(errors.completion?.[0] || 'Failed to complete registration');
        }
      });
    } catch (err: any) {
      setError(err.message || 'Failed to complete registration');
    } finally {
      setIsLoading(false);
    }
  };

  const onNext = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    
    // Get form data directly from the form
    const formData = new FormData(e.currentTarget);
    
    // Convert form data to object
    const data: any = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    if (currentStep === RegistrationStep.Contact) {
      handleContactSubmit({
        contact: data.contact,
        contact_type: data.contact_type as 'email' | 'phone',
      });
    } else if (currentStep === RegistrationStep.Verification) {
      handleVerificationSubmit(data.verification_code);
    } else if (currentStep === RegistrationStep.CompanyDetails) {
      handleCompanyDetailsSubmit(data);
    } else if (currentStep === RegistrationStep.SystemSettings) {
      handleSystemSettingsSubmit(data);
    } else if (currentStep === RegistrationStep.AdminSetup) {
      handleAdminSetupSubmit(data);
    } else if (currentStep === RegistrationStep.Completion) {
      handleCompletionSubmit();
    }
  };

  const renderStep = () => {
    switch (currentStep) {
      case RegistrationStep.Contact:
        return (
          <ContactStep
            onSubmit={(data: { contact: string; contact_type: 'email' | 'phone' }) => {
              handleContactSubmit(data);
            }}
            isLoading={isLoading}
            error={error}
          />
        );
      case RegistrationStep.Verification:
        return (
          <VerificationStep
            contactData={contactData || { contact: '', contact_type: 'email' }}
            onVerify={handleVerificationSubmit}
            onBack={handleBack}
            onResend={handleResendCode}
            isLoading={isLoading}
            isResending={isResending}
            error={error}
            countdown={countdown}
            showCountdown={showCountdown}
          />
        );
      case RegistrationStep.CompanyDetails:
        return (
          <CompanyDetailsStep
            onSubmit={handleCompanyDetailsSubmit}
            onBack={handleBack}
            isLoading={isLoading}
            error={error}
            contactData={contactData!}
            verificationCode={flash.verification_code!}
            companyName={flash.company_name!}
          />
        );
      case RegistrationStep.SystemSettings:
        return (
          <SystemSettingsStep
            onSubmit={handleSystemSettingsSubmit}
            onBack={handleBack}
            isLoading={isLoading}
            error={error}
          />
        );
      case RegistrationStep.AdminSetup:
        return (
          <AdminSetupStep
            onSubmit={handleAdminSetupSubmit}
            onBack={handleBack}
            isLoading={isLoading}
            error={error}
          />
        );
      case RegistrationStep.Completion:
        return (
          <CompletionStep
            onSubmit={handleCompletionSubmit}
            onBack={handleBack}
            isLoading={isLoading}
            error={error}
          />
        );
      case RegistrationStep.Complete:
        return <CompleteStep onBack={handleBack} />;
      default:
        return null;
    }
  };

  return (
    <InstallationLayout
      currentStep={currentStep}
      totalSteps={Object.keys(RegistrationStep).length / 2}
      onNext={onNext}
      onBack={handleBack}
    >
      <div className="min-h-screen flex flex-col">
        <div className="flex-1">
          <header className="bg-white shadow">
            <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              <h1 className="text-3xl font-bold tracking-tight text-gray-900">
                Company Registration
              </h1>
            </div>
          </header>
          <main className="flex-1">
            <div className="mx-auto max-w-4xl py-6 sm:px-6 lg:px-8">
              <div className="bg-white rounded-lg shadow">
                <div className="space-y-6">
                  <form onSubmit={onNext} className="space-y-6">
                    {renderStep()}
                  </form>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </InstallationLayout>
  );
}
