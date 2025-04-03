# Installation Wizard

Welcome to the HRIS installation wizard! This guide will help you set up your company's HRIS system step by step.

## Step 1: Contact Information

1. **Contact Type Selection**
   - Choose between email or phone as your primary contact method
   - This will be used for verification and future communications

2. **Contact Input**
   - Enter your preferred contact information
   - For email: Must be a valid email address format
   - For phone: Must be a valid phone number

## Step 2: Verification

1. **Verification Code**
   - After submitting your contact information, you'll receive a 6-digit verification code
   - The code will be sent to the contact method you selected (email or phone)
   - The code is valid for 5 minutes and will expire after that time

2. **Verification Process**
   - Enter the 6-digit code in the provided input fields
   - Each digit has its own input field for easy entry
   - The input fields will automatically move to the next field as you type
   - You can use backspace to correct mistakes
   - A clear button is available to reset all fields
   - A countdown timer shows how much time you have left to enter the code

3. **Features**
   - Responsive design that works on both desktop and mobile devices
   - Clear visual feedback for errors and success states
   - Loading states for verification and resend actions
   - Automatic focus management between input fields
   - Error messages that disappear after 5 seconds

4. **Options**
   - **Clear Button**: Reset all input fields
   - **Back Button**: Return to the previous step to change contact information
   - **Resend Code**: Request a new verification code if the original one expired or wasn't received

5. **Error Handling**
   - Invalid code entry will show an error message
   - Expired code will prompt you to request a new one
   - Network errors will be displayed with appropriate messages
   - All error messages are temporary and will fade out after 5 seconds

## Step 3: Company Details

1. **Company Information**
   - Enter your company's name
   - Provide necessary company details
   - This information will be used to set up your primary company

## Step 4: Success

1. **Completion**
   - After successfully completing all steps, you'll be shown a success page
   - The page will display your company name
   - You'll be provided with a redirect URL for further setup

## Navigation

- **Back Button**: Available on Verification and Details steps to go back and modify previous information
- **Next/Submit**: Progress through the wizard by submitting valid information at each step
- **Error Handling**: Each step includes validation and will display appropriate error messages if needed

## Technical Requirements

- This installation wizard is part of a Laravel project with Inertia.js and React.js
- Uses Tailwind CSS for styling and shadcn/ui for components
- Implements proper form validation and error handling
- Uses secure verification code system for contact validation

## Security Features

- All contact information is validated before submission
- Verification codes are time-sensitive and single-use
- Secure handling of sensitive information throughout the process

## Troubleshooting

- If you don't receive a verification code, check your spam folder
- If you encounter errors, review the error messages and correct the information
- If you need technical assistance, contact support using the contact information provided
