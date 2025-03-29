import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import AppLayout from '@/layouts/app/app-layout'
import { Head, Link } from "@inertiajs/react";
import { ArrowLeft, Pencil } from "lucide-react";
import { MermaidDiagram } from "@/components/ui/mermaid-diagram";
import { useEffect, useState } from "react";

interface Faq {
    id: number;
    question: string;
    answer: string;
    order: number;
    status: 'active' | 'inactive';
    created_at: string;
    updated_at: string;
}

interface Props {
    faq: Faq;
}

export default function FaqShow({ faq }: Props) {
    const [mermaidDiagram, setMermaidDiagram] = useState<string | null>(null);
    const [textContent, setTextContent] = useState<string>(faq.answer);

    useEffect(() => {
        // Check if the answer contains a mermaid diagram
        if (faq.answer.includes('```mermaid')) {
            const matches = faq.answer.match(/```mermaid\n([\s\S]*?)```/);
            if (matches && matches[1]) {
                setMermaidDiagram(matches[1].trim());
                // Remove the mermaid code from the displayed text
                setTextContent(faq.answer.replace(/```mermaid\n[\s\S]*?```/g, '').trim());
            }
        }
    }, [faq.answer]);

    return (
        <AppLayout>
            <Head title="View FAQ" />
            
            <div className="container mx-auto py-6">
                <div className="flex items-center mb-6">
                    <Button variant="outline" size="icon" asChild className="mr-4">
                        <Link href="/basedata/faq/lists">
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    </Button>
                    <h1 className="text-3xl font-bold">View FAQ</h1>
                </div>

                <Card>
                    <CardHeader className="flex flex-row items-center justify-between">
                        <div>
                            <CardTitle>FAQ Details</CardTitle>
                            <CardDescription>
                                View the details of this frequently asked question
                            </CardDescription>
                        </div>
                        <Button variant="outline" asChild>
                            <Link href={`/basedata/faq/${faq.id}/edit`}>
                                <Pencil className="mr-2 h-4 w-4" />
                                Edit
                            </Link>
                        </Button>
                    </CardHeader>
                    <CardContent className="space-y-6">
                        <div>
                            <h3 className="text-lg font-semibold mb-2">Question</h3>
                            <p className="text-gray-700">{faq.question}</p>
                        </div>
                        
                        <div>
                            <h3 className="text-lg font-semibold mb-2">Answer</h3>
                            <div className="p-4 bg-gray-50 rounded-md">
                                <div className="text-gray-700 whitespace-pre-wrap">{textContent}</div>
                                {mermaidDiagram && (
                                    <div className="mt-4 p-4 bg-white rounded-md border">
                                        <h4 className="text-md font-medium mb-3">Diagram</h4>
                                        <MermaidDiagram chart={mermaidDiagram} className="max-w-full overflow-auto" />
                                    </div>
                                )}
                            </div>
                        </div>
                        
                        <div className="grid grid-cols-2 gap-6">
                            <div>
                                <h3 className="text-lg font-semibold mb-2">Display Order</h3>
                                <p className="text-gray-700">{faq.order}</p>
                            </div>
                            
                            <div>
                                <h3 className="text-lg font-semibold mb-2">Status</h3>
                                <Badge variant={faq.status === 'active' ? 'default' : 'secondary'}>
                                    {faq.status}
                                </Badge>
                            </div>
                        </div>
                        
                        <div className="grid grid-cols-2 gap-6 pt-2 border-t">
                            <div>
                                <h3 className="text-sm font-medium mb-1 text-gray-500">Created At</h3>
                                <p className="text-gray-700">
                                    {new Date(faq.created_at).toLocaleString()}
                                </p>
                            </div>
                            
                            <div>
                                <h3 className="text-sm font-medium mb-1 text-gray-500">Last Updated</h3>
                                <p className="text-gray-700">
                                    {new Date(faq.updated_at).toLocaleString()}
                                </p>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button variant="outline" asChild className="w-full">
                            <Link href="/basedata/faq/lists">
                                Back to FAQ List
                            </Link>
                        </Button>
                    </CardFooter>
                </Card>
            </div>
        </AppLayout>
    );
}
