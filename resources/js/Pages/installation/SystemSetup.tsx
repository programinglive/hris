import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import InstallationLayout from '@/layouts/installation-layout';

export default function SystemSetup({ currentStep, totalSteps }) {
  const [formData, setFormData] = useState({
    environment: 'development',
    app_name: 'BeautyWorld HRIS',
    app_url: window.location.origin,
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
        <title>System Setup - BeautyWorld HRIS</title>
      </Head>

      <InstallationLayout
        title="System Setup"
        description="Configure your system settings and dependencies"
        currentStep={currentStep}
        totalSteps={totalSteps}
        onNext={handleSubmit}
      >
        <form onSubmit={handleSubmit} className="space-y-6">
          <div>
            <label className="block text-sm font-medium text-gray-700">
              Environment
            </label>
            <select
              name="environment"
              value={formData.environment}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            >
              <option value="development">Development</option>
              <option value="production">Production</option>
            </select>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700">
              Application Name
            </label>
            <input
              type="text"
              name="app_name"
              value={formData.app_name}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700">
              Application URL
            </label>
            <input
              type="url"
              name="app_url"
              value={formData.app_url}
              onChange={handleChange}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
            />
          </div>
        </form>
      </InstallationLayout>
    </>
  );
}
