import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import AppLayout from '@/layouts/app/app-layout'
import { Head, Link, router } from "@inertiajs/react";
import { Plus, Pencil, Eye, Trash2, Search, Home } from "lucide-react";
import { useState, useEffect } from "react";
import { Input } from "@/components/ui/input";
import { 
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog";

interface Faq {
    id: number;
    question: string;
    answer: string;
    order: number;
    status: 'active' | 'inactive';
}

interface PaginationLinks {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: PaginationLinks[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

interface Props {
    faqs: {
        data: Faq[];
        links: PaginationLinks[];
        meta: PaginationMeta;
    };
    search?: string;
}

export default function FaqLists({ faqs, search = '' }: Props) {
    const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
    const [faqToDelete, setFaqToDelete] = useState<number | null>(null);
    const [perPage, setPerPage] = useState<number>(10);
    const [searchQuery, setSearchQuery] = useState<string>(search);
    const [isSearching, setIsSearching] = useState<boolean>(false);

    const handleDelete = () => {
        if (faqToDelete) {
            router.delete(`/basedata/faq/${faqToDelete}`, {
                onSuccess: () => {
                    setIsDeleteDialogOpen(false);
                    setFaqToDelete(null);
                }
            });
        }
    };

    const openDeleteDialog = (id: number) => {
        setFaqToDelete(id);
        setIsDeleteDialogOpen(true);
    };
    
    const handlePageChange = (page: number) => {
        router.get('/basedata/faq/lists', { page, per_page: perPage, search: searchQuery }, {
            preserveState: true,
            preserveScroll: true,
            only: ['faqs']
        });
    };
    
    const handlePerPageChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const newPerPage = parseInt(e.target.value);
        setPerPage(newPerPage);
        router.get('/basedata/faq/lists', { page: 1, per_page: newPerPage, search: searchQuery }, {
            preserveState: true,
            preserveScroll: true,
            only: ['faqs']
        });
    };
    
    const handleSearch = () => {
        setIsSearching(true);
        router.get('/basedata/faq/lists', { search: searchQuery, per_page: perPage }, {
            preserveState: true,
            preserveScroll: true,
            only: ['faqs'],
            onSuccess: () => {
                setIsSearching(false);
            }
        });
    };
    
    const handleSearchKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            handleSearch();
        }
    };
    
    const clearSearch = () => {
        setSearchQuery('');
        router.get('/basedata/faq/lists', { per_page: perPage }, {
            preserveState: true,
            preserveScroll: true,
            only: ['faqs']
        });
    };

    return (
        <AppLayout>
            <Head title="FAQ Lists" />
            
            <div className="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {/* Breadcrumbs */}
                <div className="flex items-center text-sm text-muted-foreground mb-4">
                    <Link href="/dashboard" className="hover:text-primary flex items-center">
                        <Home className="h-4 w-4 mr-1" />
                        Home
                    </Link>
                    <span className="mx-2">/</span>
                    <Link href="#" className="hover:text-primary">
                        Base Data
                    </Link>
                    <span className="mx-2">/</span>
                    <span className="text-primary font-medium">FAQ</span>
                </div>
                
                <div className="flex justify-between items-center mb-6">
                    <h1 className="text-3xl font-bold">FAQ Lists</h1>
                    <Button asChild>
                        <Link href="/basedata/faq/create">
                            <Plus className="mr-2 h-4 w-4" />
                            Add New FAQ
                        </Link>
                    </Button>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Frequently Asked Questions</CardTitle>
                        <CardDescription>
                            Manage your frequently asked questions here
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            {/* Search box */}
                            <div className="flex items-center w-full sm:w-auto space-x-2">
                                <div className="relative w-full sm:w-64">
                                    <Input
                                        type="text"
                                        placeholder="Search FAQs..."
                                        value={searchQuery}
                                        onChange={(e) => setSearchQuery(e.target.value)}
                                        onKeyDown={handleSearchKeyDown}
                                        className="pr-8"
                                    />
                                    <button 
                                        onClick={handleSearch}
                                        className="absolute right-2 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground"
                                        disabled={isSearching}
                                    >
                                        <Search className="h-4 w-4" />
                                    </button>
                                </div>
                                {searchQuery && (
                                    <Button 
                                        variant="outline" 
                                        size="sm" 
                                        onClick={clearSearch}
                                    >
                                        Clear
                                    </Button>
                                )}
                            </div>
                            
                            {/* Rows per page selector */}
                            <div className="flex items-center space-x-2 ml-auto">
                                <span className="text-sm text-muted-foreground">Rows per page:</span>
                                <select 
                                    value={perPage} 
                                    onChange={handlePerPageChange}
                                    className="h-8 w-16 rounded-md border border-input bg-background px-2 text-sm"
                                >
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Order</TableHead>
                                    <TableHead>Question</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {!faqs.data || faqs.data.length === 0 ? (
                                    <TableRow>
                                        <TableCell colSpan={4} className="text-center py-8 text-muted-foreground">
                                            No FAQs found. Create your first FAQ.
                                        </TableCell>
                                    </TableRow>
                                ) : (
                                    faqs.data.map((faq) => (
                                        <TableRow key={faq.id}>
                                            <TableCell>{faq.order}</TableCell>
                                            <TableCell className="font-medium">{faq.question}</TableCell>
                                            <TableCell>
                                                <Badge variant={faq.status === 'active' ? 'default' : 'secondary'}>
                                                    {faq.status}
                                                </Badge>
                                            </TableCell>
                                            <TableCell className="text-right">
                                                <div className="flex justify-end gap-2">
                                                    <Button variant="outline" size="icon" asChild>
                                                        <Link href={`/basedata/faq/${faq.id}`}>
                                                            <Eye className="h-4 w-4" />
                                                        </Link>
                                                    </Button>
                                                    <Button variant="outline" size="icon" asChild>
                                                        <Link href={`/basedata/faq/${faq.id}/edit`}>
                                                            <Pencil className="h-4 w-4" />
                                                        </Link>
                                                    </Button>
                                                    <Button 
                                                        variant="outline" 
                                                        size="icon" 
                                                        onClick={() => openDeleteDialog(faq.id)}
                                                    >
                                                        <Trash2 className="h-4 w-4" />
                                                    </Button>
                                                </div>
                                            </TableCell>
                                        </TableRow>
                                    ))
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                    {faqs.data && faqs.data.length > 0 && faqs.meta && (
                        <div className="flex items-center justify-between px-6 py-4 border-t">
                            <div className="text-sm text-muted-foreground">
                                Showing <span className="font-medium">{faqs.meta.from || 0}</span> to <span className="font-medium">{faqs.meta.to || 0}</span> of <span className="font-medium">{faqs.meta.total || 0}</span> results
                            </div>
                            <div className="flex items-center space-x-1">
                                <Button
                                    variant="outline"
                                    size="sm"
                                    onClick={() => handlePageChange((faqs.meta.current_page || 1) - 1)}
                                    disabled={(faqs.meta.current_page || 1) <= 1}
                                >
                                    Previous
                                </Button>
                                {faqs.meta.links && faqs.meta.links.slice(1, -1).map((link, i) => (
                                    <Button
                                        key={i}
                                        variant={link.active ? "default" : "outline"}
                                        size="sm"
                                        onClick={() => handlePageChange(parseInt(link.label))}
                                    >
                                        {link.label}
                                    </Button>
                                ))}
                                <Button
                                    variant="outline"
                                    size="sm"
                                    onClick={() => handlePageChange((faqs.meta.current_page || 1) + 1)}
                                    disabled={(faqs.meta.current_page || 1) >= (faqs.meta.last_page || 1)}
                                >
                                    Next
                                </Button>
                            </div>
                        </div>
                    )}
                </Card>
            </div>

            <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                        <AlertDialogDescription>
                            This action cannot be undone. This will permanently delete the FAQ.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction onClick={handleDelete}>Delete</AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </AppLayout>
    );
}
