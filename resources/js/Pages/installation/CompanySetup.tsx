import { Head } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';
import CompanyRegistrationWizard from '@/components/installation/CompanyRegistrationWizard';

interface CompanySetupProps {
  currentStep: number;
  totalSteps: number;
}

export default function CompanySetup({ currentStep, totalSteps }: CompanySetupProps) {
  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    // Handle form submission
  };

  const handleNext = (data: any) => {
    // Handle navigation between steps
  };

  return (
    <>
      <Head>
        <title>Company Setup - BeautyWorld HRIS</title>
      </Head>

      <InstallationLayout
        currentStep={currentStep}
        totalSteps={totalSteps}
        onNext={handleSubmit}
      >
        <form onSubmit={handleSubmit}>
          <CompanyRegistrationWizard
            currentStep={currentStep}
            totalSteps={totalSteps}
            onNext={handleNext}
          />
        </form>
      </InstallationLayout>
    </>
  );
}
