import { Head } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';
import { useState } from 'react';

interface DatabaseSetupProps {
  currentStep: number;
  totalSteps: number;
}

export default function DatabaseSetup({ currentStep, totalSteps }: DatabaseSetupProps) {
  const [formData, setFormData] = useState({
    database_host: '127.0.0.1',
    database_port: '3306',
    database_name: '',
    database_username: '',
    database_password: '',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    // Submit form data to backend
  };

  return (
    <>
      <Head>
        <title>Database Setup - BeautyWorld HRIS</title>
      </Head>

      <InstallationLayout 
        currentStep={currentStep} 
        totalSteps={totalSteps}
        onNext={handleSubmit}
      >
        <form onSubmit={handleSubmit}>
          <div className="space-y-6">
            <div>
              <label className="block text-sm font-medium text-gray-700">
                Database Host
              </label>
              <input
                type="text"
                name="database_host"
                value={formData.database_host}
                onChange={handleChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                placeholder="127.0.0.1"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-700">
                Database Port
              </label>
              <input
                type="number"
                name="database_port"
                value={formData.database_port}
                onChange={handleChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                placeholder="3306"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-700">
                Database Name
              </label>
              <input
                type="text"
                name="database_name"
                value={formData.database_name}
                onChange={handleChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                placeholder="hris_project"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-700">
                Database Username
              </label>
              <input
                type="text"
                name="database_username"
                value={formData.database_username}
                onChange={handleChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                placeholder="root"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-700">
                Database Password
              </label>
              <input
                type="password"
                name="database_password"
                value={formData.database_password}
                onChange={handleChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
              />
            </div>
          </div>
        </form>
      </InstallationLayout>
    </>
  );
}
