import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { type LucideIcon } from "lucide-react";

interface HighlightCardProps {
    icon: LucideIcon;
    title: string;
    value: string | number;
    description: string;
    className?: string;
}

export function HighlightCard({
    icon: Icon,
    title,
    value,
    description,
    className = "",
}: HighlightCardProps) {
    return (
        <Card className={`col-span-1 row-span-1 ${className}`}>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle className="flex items-center gap-2">
                    <Icon className="h-4 w-4" />
                    {title}
                </CardTitle>
            </CardHeader>
            <CardContent>
                <div className="text-2xl font-bold">{value}</div>
                <p className="text-xs text-muted-foreground">{description}</p>
            </CardContent>
        </Card>
    );
}
