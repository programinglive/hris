import { type PageProps } from '@/types';
import AppLayout from '@/layouts/app/app-layout';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Select } from '@/components/ui/select';
import { Link } from '@inertiajs/react';

interface LeaveRequest {
    id: number;
    employee: {
        name: string;
    };
    leaveType: {
        name: string;
    };
    start_date: string;
    end_date: string;
    status: string;
    reason: string;
}

export default function LeaveRequestShow({ auth, leave }: PageProps & { leave: LeaveRequest }) {
    return (
        <AppLayout>
            <div className="space-y-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold">Leave Request Details</h1>
                    <Link href="/attendance/leave">
                        <Button variant="outline">Back</Button>
                    </Link>
                </div>

                <Card>
                    <div className="space-y-4">
                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <Label>Employee</Label>
                                <Input
                                    value={leave.employee.name}
                                    disabled
                                />
                            </div>

                            <div>
                                <Label>Leave Type</Label>
                                <Input
                                    value={leave.leaveType.name}
                                    disabled
                                />
                            </div>

                            <div>
                                <Label>Start Date</Label>
                                <Input
                                    type="date"
                                    value={leave.start_date}
                                    disabled
                                />
                            </div>

                            <div>
                                <Label>End Date</Label>
                                <Input
                                    type="date"
                                    value={leave.end_date}
                                    disabled
                                />
                            </div>

                            <div>
                                <Label>Status</Label>
                                <Select
                                    value={leave.status}
                                    disabled
                                >
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="cancelled">Cancelled</option>
                                </Select>
                            </div>

                            <div className="col-span-2">
                                <Label>Reason</Label>
                                <Input
                                    type="textarea"
                                    value={leave.reason}
                                    disabled
                                />
                            </div>
                        </div>

                        {auth.user.role === 'admin' && leave.status === 'pending' && (
                            <div className="flex justify-end gap-2">
                                <Link href={`/attendance/leave/${leave.id}/edit`}>
                                    <Button>Edit</Button>
                                </Link>
                            </div>
                        )}
                    </div>
                </Card>
            </div>
        </AppLayout>
    );
}
