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
}

export default function VerificationStep({
  contactData,
  onVerify,
  onBack,
  onResend,
  isLoading,
  isResending,
  error,
}: VerificationStepProps) {
  const form = useForm({
    verification_code: '',
  });

  const [inputValues, setInputValues] = useState<string[]>(Array(6).fill(''));
  const [countdown, setCountdown] = useState(300); // 5 minutes in seconds
  const [showCountdown, setShowCountdown] = useState(true);
  const [showClearButton, setShowClearButton] = useState(false);
  const [isError, setIsError] = useState(false);

  useEffect(() => {
    const timer = setInterval(() => {
      if (countdown > 0) {
        setCountdown(prev => prev - 1);
      } else {
        setShowCountdown(false);
        clearInterval(timer);
      }
    }, 1000);

    return () => clearInterval(timer);
  }, []);

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

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const code = inputValues.join('');
    onVerify(code);
  };

  const handleClear = () => {
    setInputValues(Array(6).fill(''));
    form.setData('verification_code', '');
    setIsError(false);
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

      <form onSubmit={handleSubmit} className="space-y-4">
        <Card>
          <CardContent className="space-y-4">
            <div>
              <p className="text-lg font-semibold text-gray-900">
                Verification Code
              </p>
              <p className="mt-1 text-sm text-gray-500">
                Enter the 6-digit code sent to your {contactData.contact_type}
              </p>
            </div>

            <div className="grid grid-cols-6 gap-2">
              {inputValues.map((value, index) => (
                <Input
                  key={index}
                  id={`input-${index}`}
                  type="text"
                  maxLength={1}
                  value={value}
                  onChange={(e) => handleInputChange(index, e.target.value)}
                  onKeyDown={(e) => handleKeyDown(index, e)}
                  className={`text-center ${
                    isError ? 'border-red-500' : 'border-gray-300'
                  }`}
                  inputMode="numeric"
                  pattern="[0-9]*"
                />
              ))}
            </div>

            {isError && (
              <p className="mt-2 text-sm text-red-600">
                Please enter a valid 6-digit verification code
              </p>
            )}

            <div className="flex justify-between items-center">
              <Button
                variant="outline"
                onClick={handleClear}
                disabled={!showClearButton}
              >
                Clear
              </Button>

              <div className="flex gap-2">
                <Button
                  variant="outline"
                  onClick={onBack}
                  disabled={isLoading}
                >
                  Back
                </Button>
                <Button
                  type="submit"
                  disabled={isLoading}
                >
                  {isLoading ? 'Verifying...' : 'Verify'}
                </Button>
              </div>
            </div>

            {showCountdown && (
              <p className="mt-2 text-sm text-gray-500">
                {Math.floor(countdown / 60)}:{
                  (countdown % 60).toString().padStart(2, '0')
                }
              </p>
            )}

            {!showCountdown && (
              <Button
                variant="outline"
                onClick={onResend}
                disabled={isResending}
              >
                {isResending ? 'Resending...' : 'Resend Code'}
              </Button>
            )}
          </CardContent>
        </Card>
      </form>
    </div>
  );
}
