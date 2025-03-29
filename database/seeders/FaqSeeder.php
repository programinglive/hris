<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I reset my password?',
                'answer' => 'To reset your password, click on the "Forgot Password" link on the login page. You will receive an email with instructions to reset your password.',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'How do I update my profile information?',
                'answer' => 'You can update your profile information by navigating to the "Profile" section in your dashboard. Click on the "Edit Profile" button to make changes.',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'What is the company registration process?',
                'answer' => 'The company registration process involves the following steps:

1. Fill out the contact information form
2. Verify your email with the code sent to you
3. Complete the company details form
4. Receive confirmation of successful registration

```mermaid
flowchart TD
    A[Start Registration] --> B[Enter Contact Info]
    B --> C[Verify Email Code]
    C --> D[Enter Company Details]
    D --> E[Registration Complete]
    style E fill:#9f9,stroke:#6c6
```',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'question' => 'How does the organizational hierarchy work?',
                'answer' => 'The organizational hierarchy in our system follows this structure:

```mermaid
flowchart TD
    CEO[CEO] --> COO[COO]
    CEO --> CFO[CFO]
    CEO --> CTO[CTO]
    COO --> HR[HR Director]
    COO --> OPS[Operations Director]
    HR --> REC[Recruitment]
    HR --> TRAIN[Training]
    OPS --> BRANCH[Branch Managers]
    BRANCH --> STAFF[Staff]
    style CEO fill:#f96,stroke:#333
    style HR fill:#bbf,stroke:#333
```

This hierarchy determines access levels and reporting structures in the system.

```mermaid
flowchart TD
    A[Company] --> B[Branches]
    B --> C[Divisions]
    C --> D[Departments]
    D --> E[Sub-Divisions]
    E --> F[Positions]
    F --> G[Employees]
```

Each level has specific permissions and access controls.',
                'order' => 4,
                'status' => 'active',
            ],
            [
                'question' => 'What are the steps in the employee onboarding process?',
                'answer' => 'The employee onboarding process follows these steps:

```mermaid
gantt
    title Employee Onboarding Process
    dateFormat  YYYY-MM-DD
    section HR Tasks
    Create employee profile    :a1, 2025-01-01, 2d
    Assign to department      :a2, after a1, 1d
    Setup payroll             :a3, after a2, 2d
    section IT Tasks
    Create email account      :b1, after a1, 1d
    Setup workstation         :b2, after b1, 1d
    System access rights      :b3, after b2, 1d
    section Training
    Company orientation       :c1, after a3, 2d
    Department training       :c2, after c1, 3d
    System training           :c3, after b3, 2d
```

This timeline shows the typical flow for bringing a new employee into the organization.',
                'order' => 5,
                'status' => 'active',
            ],
            [
                'question' => 'How do I export employee data?',
                'answer' => 'You can export employee data by going to the Employee Lists page and clicking on the "Export" button. You can choose to export in CSV, Excel, or PDF format.

```mermaid
flowchart LR
    A[Employee Lists] --> B[Click Export]
    B --> C{Select Format}
    C -->|CSV| D[Download CSV]
    C -->|Excel| E[Download Excel]
    C -->|PDF| F[Download PDF]
    D --> G[Open/Save File]
    E --> G
    F --> G
    style C fill:#f9f,stroke:#333
```

Follow this simple process to export your employee data in your preferred format.',
                'order' => 6,
                'status' => 'active',
            ],
            [
                'question' => 'What browsers are supported?',
                'answer' => 'Our system supports the following browsers:
- Google Chrome (latest 2 versions)
- Mozilla Firefox (latest 2 versions)
- Microsoft Edge (latest 2 versions)
- Safari (latest 2 versions)',
                'order' => 7,
                'status' => 'active',
            ],
            [
                'question' => 'How do I set up two-factor authentication?',
                'answer' => 'To set up two-factor authentication:

```mermaid
sequenceDiagram
    participant U as User
    participant S as System
    participant A as auth App
    
    U->>S: Access Profile Settings
    U->>S: Click on Security
    U->>S: Enable 2FA
    S->>U: Display QR Code
    U->>A: Scan QR Code
    A->>U: Generate Verification Code
    U->>S: Enter Verification Code
    S->>U: Confirm 2FA Setup
    S->>U: Show Backup Codes
```

Follow this sequence to properly set up two-factor authentication for your account. Be sure to save your backup codes in case you lose access to your authenticator app.',
                'order' => 8,
                'status' => 'active',
            ],
            [
                'question' => 'What are the system requirements?',
                'answer' => 'The minimum system requirements are:
- Modern web browser (Chrome, Firefox, Edge, Safari)
- Internet connection (minimum 1 Mbps)
- Screen resolution of at least 1280x720
- JavaScript enabled',
                'order' => 9,
                'status' => 'inactive',
            ],
            [
                'question' => 'How do I manage user permissions?',
                'answer' => 'User permissions can be managed through the Admin panel:

```mermaid
flowchart TD
    A[Admin Panel] --> B[User Management]
    B --> C[Select User]
    C --> D[Edit Permissions]
    D --> E[Assign Roles]
    D --> F[Custom Permissions]
    E --> G[Save Changes]
    F --> G
    G --> H[Permissions Applied]
    style A fill:#bbf,stroke:#333
    style H fill:#9f9,stroke:#333
```

This diagram shows the steps to manage user permissions in the system. You can either assign predefined roles or set custom permissions for each user.
```',
                'order' => 10,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
