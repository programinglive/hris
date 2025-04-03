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

  const clearInputs = () => {
    setInputValues(Array(6).fill(''));
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
                    className="w-12 text-center"
                    onKeyDown={(e) => handleKeyDown(index, e)}
                    onFocus={() => setShowClearButton(true)}
                    onBlur={() => setShowClearButton(false)}
                  />
                ))}
              </div>

              {showClearButton && (
                <button
                  type="button"
                  onClick={clearInputs}
                  className="absolute right-4 text-gray-400 hover:text-gray-500"
                >
                  ✕
                </button>
              )}
            </div>

            {isError && (
              <p className="mt-2 text-sm text-red-600">
                Invalid verification code. Please try again.
              </p>
            )}

            <div className="flex justify-between items-center">
              <Button
                type="button"
                variant="outline"
                onClick={onBack}
                disabled={isLoading}
              >
                Back
              </Button>

              <div className="flex items-center space-x-4">
                <Button
                  type="button"
                  variant="outline"
                  onClick={onResend}
                  disabled={isResending || showCountdown}
                >
                  {isResending
                    ? 'Resending...'
                    : showCountdown
                    ? `${Math.floor(countdown / 60)}:${String(countdown % 60).padStart(2, '0')}`
                    : 'Resend Code'}
                </Button>

                <Button
                  type="submit"
                  disabled={isLoading || !inputValues.every(v => v !== '')}
                  onClick={() => onVerify(inputValues.join(''))}
                >
                  {isLoading ? 'Verifying...' : 'Verify'}
                </Button>
              </div>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  );
}
