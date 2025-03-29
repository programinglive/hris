<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class StoreLeaveRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'leave_type_id' => 'required|exists:leave_types,leave_type_id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected', 'cancelled'])],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->fails()) {
                return;
            }

            $startDate = Carbon::parse($this->start_date);
            $endDate = Carbon::parse($this->end_date);
            $totalDays = $startDate->diffInDays($endDate) + 1;

            $this->merge([
                'total_days' => $totalDays,
            ]);
        });
    }
}
