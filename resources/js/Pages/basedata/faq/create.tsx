import { Button } from "@/Components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/Components/ui/card";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Textarea } from "@/Components/ui/textarea";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/Components/ui/select";
import AppLayout from '@/layouts/app/app-layout'
import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import { Editor } from "@tinymce/tinymce-react";

export default function FaqCreate() {
    const [formData, setFormData] = useState({
        question: "",
        answer: "",
        order: 0,
        status: "active",
    });
    
    const [errors, setErrors] = useState<Record<string, string>>({});
    const [isSubmitting, setIsSubmitting] = useState(false);

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSelectChange = (name: string, value: string) => {
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);
        
        router.post('/basedata/faq', formData, {
            onSuccess: () => {
                setIsSubmitting(false);
            },
            onError: (errors) => {
                setErrors(errors);
                setIsSubmitting(false);
            },
        });
    };

    return (
        <AppLayout>
            <Head title="Create FAQ" />
            
            <div className="container mx-auto py-6">
                <h1 className="text-3xl font-bold mb-6">Create New FAQ</h1>

                <form onSubmit={handleSubmit} className="p-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>FAQ Details</CardTitle>
                            <CardDescription>
                                Create a new frequently asked question
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="question">Question</Label>
                                <Input
                                    id="question"
                                    name="question"
                                    value={formData.question}
                                    onChange={handleChange}
                                    placeholder="Enter the question"
                                />
                                {errors.question && (
                                    <p className="text-sm text-red-500">{errors.question}</p>
                                )}
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="answer">Answer</Label>
                                <Editor
                                    id="answer"
                                    tinymceScriptSrc={`https://cdn.tiny.cloud/1/${import.meta.env.VITE_TINYMCE_API_KEY}/tinymce/6/tinymce.min.js`}
                                    initialValue={formData.answer}
                                    onEditorChange={(content) => {
                                        setFormData((prev) => ({ ...prev, answer: content }));
                                    }}
                                    init={{
                                        height: 300,
                                        menubar: false,
                                        plugins: [
                                            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                                            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                                            'insertdatetime', 'media', 'table', 'preview', 'help', 'wordcount'
                                        ],
                                        toolbar: 'undo redo | blocks | ' +
                                            'bold italic forecolor | alignleft aligncenter ' +
                                            'alignright alignjustify | bullist numlist outdent indent | ' +
                                            'removeformat | help',
                                        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                                    }}
                                />
                                {errors.answer && (
                                    <p className="text-sm text-red-500">{errors.answer}</p>
                                )}
                            </div>

                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="order">Display Order</Label>
                                    <Input
                                        id="order"
                                        name="order"
                                        type="number"
                                        value={formData.order.toString()}
                                        onChange={handleChange}
                                        placeholder="Enter display order"
                                    />
                                    {errors.order && (
                                        <p className="text-sm text-red-500">{errors.order}</p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="status">Status</Label>
                                    <Select 
                                        value={formData.status} 
                                        onValueChange={(value) => handleSelectChange("status", value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select status" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="active">Active</SelectItem>
                                            <SelectItem value="inactive">Inactive</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    {errors.status && (
                                        <p className="text-sm text-red-500">{errors.status}</p>
                                    )}
                                </div>
                            </div>
                        </CardContent>
                        <CardFooter className="flex justify-between">
                            <Button 
                                type="button" 
                                variant="outline" 
                                onClick={() => router.get('/basedata/faq/lists')}
                            >
                                Cancel
                            </Button>
                            <Button type="submit" disabled={isSubmitting}>
                                {isSubmitting ? "Saving..." : "Save FAQ"}
                            </Button>
                        </CardFooter>
                    </Card>
                </form>
            </div>
        </AppLayout>
    );
}
