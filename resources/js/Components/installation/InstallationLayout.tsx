import { Card, CardContent } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';

interface InstallationLayoutProps {
  currentStep: number;
  totalSteps: number;
  children: React.ReactNode;
  onNext?: (e: React.FormEvent<HTMLFormElement>) => void; // add onNext prop
}

export default function InstallationLayout({
  currentStep,
  totalSteps,
  children,
  onNext, // add onNext prop to function params
}: InstallationLayoutProps) {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-md w-full space-y-8">
        <div>
          <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Company Registration
          </h2>
          <p className="mt-2 text-center text-sm text-gray-600">
            Step {currentStep} of {totalSteps}
          </p>
          <Progress
            className="mt-4"
            value={(currentStep / totalSteps) * 100}
          />
        </div>
        <Card>
          <CardContent className="space-y-6">
            {children}
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
