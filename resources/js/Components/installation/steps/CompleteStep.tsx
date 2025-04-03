import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface CompleteStepProps {
  onBack: () => void;
}

export default function CompleteStep({ onBack }: CompleteStepProps) {
  return (
    <div className="space-y-4">
      <Card>
        <CardHeader>
          <CardTitle>Registration Complete</CardTitle>
          <CardDescription>
            Your registration is complete! You can now log in to your account.
          </CardDescription>
        </CardHeader>
        <CardContent className="text-center">
          <Button
            onClick={onBack}
            className="w-full"
          >
            Back to Login
          </Button>
        </CardContent>
      </Card>
    </div>
  );
}
