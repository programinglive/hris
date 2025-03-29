// Model type definitions for the application

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at?: string;
}

export interface WorkShift {
  id: number;
  name: string;
  start_time: string;
  end_time: string;
  grace_period_minutes: number;
  working_days: number[];
  working_days_formatted: string;
  is_default: boolean;
  company_id: number;
  company?: {
    id: number;
    name: string;
  };
  created_at: string;
  updated_at: string;
}

export interface UserWorkShift {
  id: number;
  user_id: number;
  work_shift_id: number;
  effective_date: string;
  end_date?: string;
  created_at: string;
  updated_at: string;
  user?: User;
  work_shift?: WorkShift;
}
