import { useState, useEffect } from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';

interface VerificationStepProps {
  contactData: {
    contact: string;
    contact_type: 'email' | 'phone';
  };
  onVerify: (code: string) => void;
  onBack: () => void;
  onResend: () => void;
  isLoading: boolean;
  isResending: boolean;
  error?: string;
  countdown: number;
  showCountdown: boolean;
}

export default function VerificationStep({
  contactData,
  onVerify,
  onBack,
  onResend,
  isLoading,
  isResending,
  error,
  countdown,
  showCountdown,
}: VerificationStepProps) {
  const [inputValues, setInputValues] = useState<string[]>(Array(6).fill(''));
  const [isError, setIsError] = useState(false);

  const handleInputChange = (index: number, value: string) => {
    const newValues = [...inputValues];
    newValues[index] = value;
    setInputValues(newValues);

    // Move to next input if current one is filled
    if (value && index < 5) {
      const nextInput = document.getElementById(`input-${index + 1}`);
      if (nextInput) {
        nextInput.focus();
      }
    }
  };

  const handleKeyDown = (index: number, e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Backspace' && index > 0 && !inputValues[index]) {
      const prevInput = document.getElementById(`input-${index - 1}`);
      if (prevInput) {
        prevInput.focus();
      }
    }
  };

  return (
    <div className="space-y-4">
      {error && (
        <Card className="bg-red-50 border-red-200">
          <CardContent>
            <p className="text-red-600">{error}</p>
          </CardContent>
        </Card>
      )}

      <Card>
        <CardContent>
          <div className="space-y-4">
            <div className="text-center">
              <h3 className="text-lg font-medium leading-6 text-gray-900">Verification Code</h3>
              <p className="mt-1 text-sm text-gray-500">
                We've sent a verification code to {contactData.contact_type === 'email' ? 'your email' : 'your phone number'}. Please enter it below.
              </p>
            </div>

            <div className="relative flex items-center justify-center">
              <div className="flex space-x-2">
                {inputValues.map((value, index) => (
                  <Input
                    key={index}
                    type="text"
                    maxLength={1}
                    value={value}
                    onChange={(e) => handleInputChange(index, e.target.value)}
                    onKeyDown={(e) => handleKeyDown(index, e)}
                    className="w-12 text-center"
                    id={`input-${index}`}
                  />
                ))}
              </div>
              {isError && (
                <p className="mt-2 text-sm text-red-600">Invalid verification code</p>
              )}
            </div>

            <div className="mt-4 text-center">
              {showCountdown ? (
                <p className="text-sm text-gray-500">
                  Didn't receive the code?{' '}
                  <button
                    type="button"
                    onClick={onResend}
                    disabled={isResending || countdown > 0}
                    className="text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    {isResending ? 'Resending...' : countdown > 0 ? `Resend in ${Math.floor(countdown / 60)}:${(countdown % 60).toString().padStart(2, '0')}` : 'Resend'}
                  </button>
                </p>
              ) : (
                <p className="text-sm text-gray-500">
                  Please check your {contactData.contact_type === 'email' ? 'email' : 'phone'} for the verification code.
                </p>
              )}
            </div>

            <div className="mt-6 space-y-4">
              <Button
                type="button"
                onClick={() => {
                  const code = inputValues.join('');
                  if (code.length === 6) {
                    onVerify(code);
                  } else {
                    setIsError(true);
                  }
                }}
                disabled={isLoading || inputValues.some(v => v === '')}
                className="w-full"
              >
                {isLoading ? 'Processing...' : 'Verify'}
              </Button>

              <Button
                type="button"
                variant="outline"
                onClick={onBack}
                className="w-full"
              >
                Back
              </Button>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  );
}
