import { PlaceholderPattern } from '@/Components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { BarChart as BarChartIcon, PieChart, TrendingUp, Users, User, Calendar, FileSpreadsheet } from 'lucide-react';
import {
    Area,
    AreaChart,
    CartesianGrid,
    XAxis,
    YAxis,
    Tooltip,
    Pie,
    PieChart as RechartsPieChart,
    Cell,
    Legend,
    Bar,
    BarChart
} from 'recharts';
import {
    ChartConfig,
    ChartContainer,
} from "@/Components/ui/chart"
import { HighlightCard } from '@/Components/ui/highlight-card';

const chartConfig = {
    employees: {
        label: "Employees",
        color: "hsl(var(--chart-1))",
    },
    amount: {
        label: "Amount",
        color: "hsl(var(--chart-2))",
    },
    requests: {
        label: "Requests",
        color: "hsl(var(--chart-3))",
    },
    satisfaction: {
        label: "Satisfaction",
        color: "hsl(var(--chart-4))",
    },
} satisfies ChartConfig

export default function Dashboard() {

    // Dashboard is the root, so we only need one breadcrumb
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        }
    ];

    return (
        <AppLayout title="Dashboard" breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                {/* Row 1: Four Highlight Cards */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-4">
                    {/* Card 1: Employee Count */}
                    <HighlightCard
                        icon={Users}
                        title="Employee Count"
                        value="125"
                        description="Total employees"
                    />

                    {/* Card 2: New Hire */}
                    <HighlightCard
                        icon={User}
                        title="New Hire"
                        value="5"
                        description="New employees this month"
                    />

                    {/* Card 3: Upcoming Holiday */}
                    <HighlightCard
                        icon={Calendar}
                        title="Upcoming Holiday"
                        value="1"
                        description="Upcoming holiday"
                    />

                    {/* Card 4: Payroll */}
                    <HighlightCard
                        icon={FileSpreadsheet}
                        title="Payroll"
                        value="$1.2M"
                        description="Total payroll this month"
                    />
                </div>

                {/* Row 2: Two Chart Cards */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-2">
                    {/* Chart 1: Employee Growth */}
                    <Card className="col-span-1 row-span-1">
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                <Users className="h-4 w-4" />
                                Employee Growth
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="h-[420px]">
                            <ChartContainer config={chartConfig}>
                                <AreaChart width={747} height={420} data={[
                                    { month: "Jan", employees: 100 },
                                    { month: "Feb", employees: 105 },
                                    { month: "Mar", employees: 110 },
                                    { month: "Apr", employees: 115 },
                                    { month: "May", employees: 120 },
                                    { month: "Jun", employees: 125 },
                                ]}>
                                    <CartesianGrid vertical={false} />
                                    <XAxis
                                        dataKey="month"
                                        tickLine={false}
                                        axisLine={false}
                                        tickMargin={8}
                                        tickFormatter={(value) => value.slice(0, 3)}
                                    />
                                    <YAxis />
                                    <Tooltip />
                                    <Area
                                        dataKey="employees"
                                        type="monotone"
                                        fill="var(--color-employees)"
                                        fillOpacity={0.4}
                                        stroke="var(--color-employees)"
                                        strokeWidth={2}
                                    />
                                </AreaChart>
                            </ChartContainer>
                        </CardContent>
                        <CardFooter>
                            <div className="flex w-full items-start gap-2 text-sm">
                                <div className="grid gap-2">
                                    <div className="flex items-center gap-2 font-medium leading-none">
                                        Trending up by 5% this month <TrendingUp className="h-4 w-4" />
                                    </div>
                                    <div className="flex items-center gap-2 leading-none text-muted-foreground">
                                        January - June 2024
                                    </div>
                                </div>
                            </div>
                        </CardFooter>
                    </Card>

                    {/* Chart 2: Payroll Distribution */}
                    <Card className="col-span-1 row-span-1">
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                <PieChart className="h-4 w-4" />
                                Payroll Distribution
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="h-[420px]">
                            <ChartContainer config={chartConfig}>
                                <RechartsPieChart width={747} height={420}>
                                    <Pie
                                        data={[
                                            { department: "Sales", amount: 50000, color: "hsl(var(--chart-1))" },
                                            { department: "Marketing", amount: 30000, color: "hsl(var(--chart-2))" },
                                            { department: "Engineering", amount: 70000, color: "hsl(var(--chart-3))" },
                                            { department: "HR", amount: 20000, color: "hsl(var(--chart-4))" },
                                            { department: "Finance", amount: 40000, color: "hsl(var(--chart-5))" },
                                        ]}
                                        dataKey="amount"
                                        nameKey="department"
                                        cx="50%"
                                        cy="50%"
                                        outerRadius={80}
                                        fill="#8884d8"
                                        label
                                    >
                                        {[{ department: "Sales", amount: 50000, color: "hsl(var(--chart-1))" },
                                        { department: "Marketing", amount: 30000, color: "hsl(var(--chart-2))" },
                                        { department: "Engineering", amount: 70000, color: "hsl(var(--chart-3))" },
                                        { department: "HR", amount: 20000, color: "hsl(var(--chart-4))" },
                                        { department: "Finance", amount: 40000, color: "hsl(var(--chart-5))" },
                                        ].map((entry, index) => (
                                            <Cell key={`cell-${index}`} fill={entry.color} />
                                        ))}
                                    </Pie>
                                    <Tooltip />
                                    <Legend />
                                </RechartsPieChart>
                            </ChartContainer>
                        </CardContent>
                    </Card>
                </div>

                {/* Row 3: Two Chart Cards */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-2">
                    {/* Chart 3: Time-Off Requests */}
                    <Card className="col-span-1 row-span-1">
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                <BarChartIcon className="h-4 w-4" />
                                Time-Off Requests
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="h-[420px]">
                            <ChartContainer config={chartConfig}>
                                <BarChart width={747} height={420} data={[
                                    { month: "Jan", requests: 5 },
                                    { month: "Feb", requests: 7 },
                                    { month: "Mar", requests: 6 },
                                    { month: "Apr", requests: 8 },
                                    { month: "May", requests: 9 },
                                    { month: "Jun", requests: 10 },
                                ]}>
                                    <CartesianGrid strokeDasharray="3 3" />
                                    <XAxis dataKey="month" />
                                    <YAxis />
                                    <Tooltip />
                                    <Legend />
                                    <Bar dataKey="requests" fill="var(--color-requests)" />
                                </BarChart>
                            </ChartContainer>
                        </CardContent>
                    </Card>

                    {/* Chart 4: Employee Satisfaction */}
                    <Card className="col-span-1 row-span-1">
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                <TrendingUp className="h-4 w-4" />
                                Employee Satisfaction
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="h-[420px]">
                            <ChartContainer config={chartConfig}>
                                <AreaChart width={747} height={420} data={[
                                    { month: "Jan", satisfaction: 4.2 },
                                    { month: "Feb", satisfaction: 4.5 },
                                    { month: "Mar", satisfaction: 4.7 },
                                    { month: "Apr", satisfaction: 4.8 },
                                    { month: "May", satisfaction: 4.9 },
                                    { month: "Jun", satisfaction: 5.0 },
                                ]}>
                                    <CartesianGrid vertical={false} />
                                    <XAxis
                                        dataKey="month"
                                        tickLine={false}
                                        axisLine={false}
                                        tickMargin={8}
                                        tickFormatter={(value) => value.slice(0, 3)}
                                    />
                                    <YAxis />
                                    <Tooltip />
                                    <Area
                                        dataKey="satisfaction"
                                        type="monotone"
                                        fill="var(--color-satisfaction)"
                                        fillOpacity={0.4}
                                        stroke="var(--color-satisfaction)"
                                        strokeWidth={2}
                                    />
                                </AreaChart>
                            </ChartContainer>
                        </CardContent>
                    </Card>
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
            </div>
        </AppLayout>
    );
}