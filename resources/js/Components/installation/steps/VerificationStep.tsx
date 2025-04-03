import { useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { 
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';

const verificationSchema = z.object({
  verification_code: z.string().length(6, { message: "Verification code must be 6 digits" }),
});

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

  const form = useForm<z.infer<typeof verificationSchema>>({
    resolver: zodResolver(verificationSchema),
    defaultValues: {
      verification_code: '',
    },
  });

  const handleInputChange = (index: number, value: string) => {
    const newValues = [...inputValues];
    newValues[index] = value;
    setInputValues(newValues);

    const fullCode = newValues.join('');
    form.setValue('verification_code', fullCode);

    if (value && index < 5) {
      const nextInput = document.querySelector<HTMLInputElement>(`input[data-index="${index + 1}"]`);
      if (nextInput) {
        nextInput.focus();
      }
    }
  };

  const handleKeyDown = (index: number, e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Backspace' && inputValues[index] === '' && index > 0) {
      const prevInput = document.querySelector<HTMLInputElement>(`input[data-index="${index - 1}"]`);
      if (prevInput) {
        prevInput.focus();
      }
    }
  };

  const handleSubmit = form.handleSubmit((data) => {
    onVerify(data.verification_code);
  });

  return (
    <div className="space-y-4">
      {error && (
        <Card className="bg-red-50 border-red-200">
          <CardContent>
            <p className="text-red-600">{error}</p>
          </CardContent>
        </Card>
      )}
      
      <Form {...form}>
        <form onSubmit={handleSubmit} className="space-y-4">
          <FormField
            control={form.control}
            name="verification_code"
            render={() => (
              <FormItem>
                <FormLabel>Verification Code</FormLabel>
                <FormControl>
                  <div className="flex gap-2">
                    {inputValues.map((value, index) => (
                      <Input
                        key={index}
                        data-index={index}
                        value={value}
                        onChange={(e) => handleInputChange(index, e.target.value)}
                        onKeyDown={(e) => handleKeyDown(index, e)}
                        maxLength={1}
                        className="w-12 text-center"
                        autoFocus={index === 0}
                      />
                    ))}
                  </div>
                </FormControl>
                <FormDescription>
                  We've sent a 6-digit code to {contactData.contact}
                </FormDescription>
                <FormMessage>{form.formState.errors.verification_code?.message}</FormMessage>
              </FormItem>
            )}
          />

          <div className="flex justify-between">
            <Button
              variant="outline"
              onClick={onBack}
              disabled={isLoading}
            >
              Back
            </Button>
            <Button type="submit" disabled={isLoading}>
              {isLoading ? 'Verifying...' : 'Verify Code'}
            </Button>
          </div>
        </form>
      </Form>

      <Button
        variant="outline"
        onClick={onResend}
        disabled={isResending}
        className="mt-4"
      >
        {isResending ? 'Resending...' : 'Resend Code'}
      </Button>
    </div>
  );
}
