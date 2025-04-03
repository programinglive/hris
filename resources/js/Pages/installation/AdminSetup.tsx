import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';

export default function AdminSetup({ currentStep, totalSteps }) {
  const [formData, setFormData] = useState({
    admin_name: '',
    admin_email: '',
    admin_password: '',
    admin_password_confirmation: '',
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Submit form data to backend
  };

  return (
    <>
      <Head>
        <title>Admin Setup - HRIS Open Source</title>
      </Head>

      <InstallationLayout
        title="Admin Setup"
        description="Create your admin account"
        currentStep={currentStep}
        totalSteps={totalSteps}
        onNext={handleSubmit}
      >
        <form onSubmit={handleSubmit} className="space-y-6">
          <div>
            <label className="block text-sm font-medium text-gray-700">
              Admin Name
            </label>
            <input
              type="text"
              name="admin_name"
              value={formData.admin_name}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700">
              Admin Email
            </label>
            <input
              type="email"
              name="admin_email"
              value={formData.admin_email}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700">
              Password
            </label>
            <input
              type="password"
              name="admin_password"
              value={formData.admin_password}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700">
              Confirm Password
            </label>
            <input
              type="password"
              name="admin_password_confirmation"
              value={formData.admin_password_confirmation}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>
        </form>
      </InstallationLayout>
    </>
  );
}
