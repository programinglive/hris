import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { usePage } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import { useState } from 'react';
import type { Page } from '@inertiajs/core';

interface SystemSettingsStepProps {
  onSubmit: (data: any) => void;
  onBack: () => void;
  error: any;
  isLoading?: boolean;
}

interface PageProps {
  [key: string]: any;
  auth: {
    user?: {
      primary_company?: any;
    };
  };
}

export default function SystemSettingsStep({
  onSubmit,
  onBack,
  error,
  isLoading = false,
}: SystemSettingsStepProps) {
  const { auth } = usePage<PageProps>().props;
  const company = auth.user?.primary_company;

  const { data, setData, post, processing } = useForm({
    company_id: company?.id,
    attendance: {
      late_threshold: '15',
      early_threshold: '15',
      overtime_start: '18:00:00',
      overtime_threshold: '30',
      allow_manual_attendance: true,
    },
    leave: {
      maximum_leave_balance: '30',
      minimum_leave_balance: '0',
      leave_approval_required: true,
      maximum_leave_request_days: '30',
    },
    payroll: {
      default_pay_period: 'monthly',
      payroll_processing_days: '7',
      tax_deduction: true,
    },
    general: {
      company_time_zone: 'Asia/Jakarta',
      date_format: 'Y-m-d',
      time_format: 'H:i',
      language: 'en',
    },
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    onSubmit(data);
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
          <CardHeader>
            <CardTitle>System Settings</CardTitle>
            <CardDescription>
              Configure your company's system settings.
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            {/* Attendance Settings */}
            <div className="space-y-2">
              <CardHeader className="space-y-0">
                <CardTitle className="text-sm font-medium">Attendance</CardTitle>
              </CardHeader>
              <div className="space-y-2">
                <div>
                  <Label htmlFor="late_threshold">Late Threshold (minutes)</Label>
                  <Input
                    id="late_threshold"
                    type="number"
                    value={data.attendance.late_threshold}
                    onChange={(e) => setData('attendance.late_threshold', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="early_threshold">Early Threshold (minutes)</Label>
                  <Input
                    id="early_threshold"
                    type="number"
                    value={data.attendance.early_threshold}
                    onChange={(e) => setData('attendance.early_threshold', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="overtime_start">Overtime Start Time</Label>
                  <Input
                    id="overtime_start"
                    type="time"
                    value={data.attendance.overtime_start}
                    onChange={(e) => setData('attendance.overtime_start', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="overtime_threshold">Overtime Threshold (minutes)</Label>
                  <Input
                    id="overtime_threshold"
                    type="number"
                    value={data.attendance.overtime_threshold}
                    onChange={(e) => setData('attendance.overtime_threshold', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="allow_manual_attendance">Allow Manual Attendance</Label>
                  <Select
                    value={data.attendance.allow_manual_attendance ? 'true' : 'false'}
                    onValueChange={(value) => setData('attendance.allow_manual_attendance', value === 'true')}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="true">Yes</SelectItem>
                      <SelectItem value="false">No</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
              </div>
            </div>

            {/* Leave Settings */}
            <div className="space-y-2">
              <CardHeader className="space-y-0">
                <CardTitle className="text-sm font-medium">Leave</CardTitle>
              </CardHeader>
              <div className="space-y-2">
                <div>
                  <Label htmlFor="maximum_leave_balance">Maximum Leave Balance</Label>
                  <Input
                    id="maximum_leave_balance"
                    type="number"
                    value={data.leave.maximum_leave_balance}
                    onChange={(e) => setData('leave.maximum_leave_balance', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="minimum_leave_balance">Minimum Leave Balance</Label>
                  <Input
                    id="minimum_leave_balance"
                    type="number"
                    value={data.leave.minimum_leave_balance}
                    onChange={(e) => setData('leave.minimum_leave_balance', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="leave_approval_required">Leave Approval Required</Label>
                  <Select
                    value={data.leave.leave_approval_required ? 'true' : 'false'}
                    onValueChange={(value) => setData('leave.leave_approval_required', value === 'true')}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="true">Yes</SelectItem>
                      <SelectItem value="false">No</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label htmlFor="maximum_leave_request_days">Maximum Leave Request Days</Label>
                  <Input
                    id="maximum_leave_request_days"
                    type="number"
                    value={data.leave.maximum_leave_request_days}
                    onChange={(e) => setData('leave.maximum_leave_request_days', e.target.value)}
                    required
                  />
                </div>
              </div>
            </div>

            {/* Payroll Settings */}
            <div className="space-y-2">
              <CardHeader className="space-y-0">
                <CardTitle className="text-sm font-medium">Payroll</CardTitle>
              </CardHeader>
              <div className="space-y-2">
                <div>
                  <Label htmlFor="default_pay_period">Default Pay Period</Label>
                  <Select
                    value={data.payroll.default_pay_period}
                    onValueChange={(value) => setData('payroll.default_pay_period', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="monthly">Monthly</SelectItem>
                      <SelectItem value="biweekly">Bi-weekly</SelectItem>
                      <SelectItem value="weekly">Weekly</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label htmlFor="payroll_processing_days">Payroll Processing Days</Label>
                  <Input
                    id="payroll_processing_days"
                    type="number"
                    value={data.payroll.payroll_processing_days}
                    onChange={(e) => setData('payroll.payroll_processing_days', e.target.value)}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="tax_deduction">Tax Deduction</Label>
                  <Select
                    value={data.payroll.tax_deduction ? 'true' : 'false'}
                    onValueChange={(value) => setData('payroll.tax_deduction', value === 'true')}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="true">Yes</SelectItem>
                      <SelectItem value="false">No</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
              </div>
            </div>

            {/* General Settings */}
            <div className="space-y-2">
              <CardHeader className="space-y-0">
                <CardTitle className="text-sm font-medium">General</CardTitle>
              </CardHeader>
              <div className="space-y-2">
                <div>
                  <Label htmlFor="company_time_zone">Company Time Zone</Label>
                  <Select
                    value={data.general.company_time_zone}
                    onValueChange={(value) => setData('general.company_time_zone', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="Asia/Jakarta">Asia/Jakarta</SelectItem>
                      <SelectItem value="UTC">UTC</SelectItem>
                      <SelectItem value="Asia/Singapore">Asia/Singapore</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label htmlFor="date_format">Date Format</Label>
                  <Select
                    value={data.general.date_format}
                    onValueChange={(value) => setData('general.date_format', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="Y-m-d">YYYY-MM-DD</SelectItem>
                      <SelectItem value="d-m-Y">DD-MM-YYYY</SelectItem>
                      <SelectItem value="m/d/Y">MM/DD/YYYY</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label htmlFor="time_format">Time Format</Label>
                  <Select
                    value={data.general.time_format}
                    onValueChange={(value) => setData('general.time_format', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="H:i">24-hour</SelectItem>
                      <SelectItem value="h:i A">12-hour</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label htmlFor="language">Language</Label>
                  <Select
                    value={data.general.language}
                    onValueChange={(value) => setData('general.language', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select option" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="en">English</SelectItem>
                      <SelectItem value="id">Indonesian</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        <div className="flex justify-end space-x-4">
          <Button
            type="button"
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
            {isLoading ? 'Loading...' : 'Next'}
          </Button>
        </div>
      </form>
    </div>
  );
}
