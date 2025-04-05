import { Head } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { useToast } from '@/components/ui/use-toast';
import { useForm } from '@inertiajs/react';

interface CompanyFormData {
    name: string;
    code: string;
    legal_name: string;
    tax_id: string;
    registration_number: string;
    email: string;
    phone: string;
    address: string;
    city: string;
    state: string;
    postal_code: string;
    country: string;
    website: string;
    logo: File | null;
    description: string;
    is_active: boolean;
    administrator: {
        name: string;
        email: string;
        password: string;
        password_confirmation: string;
    };
    [key: string]: string | File | null | boolean | { name: string; email: string; password: string; password_confirmation: string };
}

interface CompanyFormErrors {
    name?: string;
    code?: string;
    legal_name?: string;
    tax_id?: string;
    registration_number?: string;
    email?: string;
    phone?: string;
    address?: string;
    city?: string;
    state?: string;
    postal_code?: string;
    country?: string;
    website?: string;
    description?: string;
    logo?: string;
    is_active?: string;
    administrator?: {
        name?: string;
        email?: string;
        password?: string;
        password_confirmation?: string;
    };
}

interface RegisterCompanyProps {
    errors: {
        session?: string;
    };
}

export default function RegisterCompany({ errors }: RegisterCompanyProps) {
    const { toast } = useToast();
    
    const form = useForm<CompanyFormData>({
        name: '',
        code: '',
        legal_name: '',
        tax_id: '',
        registration_number: '',
        email: '',
        phone: '',
        address: '',
        city: '',
        state: '',
        postal_code: '',
        country: 'Indonesia',
        website: '',
        logo: null,
        description: '',
        is_active: true,
        administrator: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        },
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        form.post(route('register.company.store'), {
            preserveScroll: true,
            onSuccess: () => {
                toast({
                    title: 'Success',
                    description: 'Company registration completed successfully!',
                    duration: 5000,
                });
            },
            onError: (errors: CompanyFormErrors) => {
                toast({
                    title: 'Error',
                    description: errors.session || 'Registration failed. Please try again.',
                    duration: 5000,
                });
            },
        });
    };

    const handleLogoChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            form.setData('logo', file);
        }
    };

    return (
        <div className="container mx-auto px-4 py-8">
            {errors.session && (
                <div className="bg-red-100 border border-red-400 p-4 mb-4">
                    <p className="text-red-600">{errors.session}</p>
                </div>
            )}
            
            <div className="max-w-4xl mx-auto">
                <h1 className="text-2xl font-bold mb-6">Register Company</h1>
                
                <form onSubmit={handleSubmit} className="space-y-6">
                    {/* Company Information */}
                    <div className="space-y-4">
                        <h2 className="text-xl font-semibold">Company Information</h2>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <Label>Company Name</Label>
                                <Input
                                    type="text"
                                    value={form.data.name}
                                    onChange={(e) => form.setData('name', e.target.value)}
                                    autoComplete="organization"
                                />
                                {(form.errors.name as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.name}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Company Code</Label>
                                <Input
                                    type="text"
                                    value={form.data.code}
                                    onChange={(e) => form.setData('code', e.target.value)}
                                    autoComplete="off"
                                />
                                {(form.errors.code as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.code}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Legal Name</Label>
                                <Input
                                    type="text"
                                    value={form.data.legal_name}
                                    onChange={(e) => form.setData('legal_name', e.target.value)}
                                    autoComplete="organization"
                                />
                                {(form.errors.legal_name as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.legal_name}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Tax ID</Label>
                                <Input
                                    type="text"
                                    value={form.data.tax_id}
                                    onChange={(e) => form.setData('tax_id', e.target.value)}
                                    autoComplete="tax-id"
                                />
                                {(form.errors.tax_id as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.tax_id}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Registration Number</Label>
                                <Input
                                    type="text"
                                    value={form.data.registration_number}
                                    onChange={(e) => form.setData('registration_number', e.target.value)}
                                    autoComplete="organization"
                                />
                                {(form.errors.registration_number as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.registration_number}</p>
                                )}
                            </div>
                        </div>

                        <div className="space-y-4">
                            <div>
                                <Label>Email</Label>
                                <Input
                                    type="email"
                                    value={form.data.email}
                                    onChange={(e) => form.setData('email', e.target.value)}
                                    autoComplete="organization"
                                />
                                {(form.errors.email as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.email}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Phone</Label>
                                <Input
                                    type="tel"
                                    value={form.data.phone}
                                    onChange={(e) => form.setData('phone', e.target.value)}
                                    autoComplete="tel"
                                />
                                {(form.errors.phone as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.phone}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Website</Label>
                                <Input
                                    type="url"
                                    value={form.data.website}
                                    onChange={(e) => form.setData('website', e.target.value)}
                                    autoComplete="url"
                                />
                                {(form.errors.website as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.website}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Description</Label>
                                <Textarea
                                    value={form.data.description}
                                    onChange={(e) => form.setData('description', e.target.value)}
                                />
                                {(form.errors.description as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.description}</p>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Address Information */}
                    <div className="space-y-4">
                        <h2 className="text-xl font-semibold">Address Information</h2>
                        
                        <div className="space-y-4">
                            <div>
                                <Label>Address</Label>
                                <Input
                                    type="text"
                                    value={form.data.address}
                                    onChange={(e) => form.setData('address', e.target.value)}
                                    autoComplete="street-address"
                                />
                                {(form.errors.address as string) && (
                                    <p className="mt-1 text-sm text-red-600">{form.errors.address}</p>
                                )}
                            </div>
                            
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <Label>City</Label>
                                    <Input
                                        type="text"
                                        value={form.data.city}
                                        onChange={(e) => form.setData('city', e.target.value)}
                                        autoComplete="address-level2"
                                    />
                                    {(form.errors.city as string) && (
                                        <p className="mt-1 text-sm text-red-600">{form.errors.city}</p>
                                    )}
                                </div>
                                
                                <div>
                                    <Label>State/Province</Label>
                                    <Input
                                        type="text"
                                        value={form.data.state}
                                        onChange={(e) => form.setData('state', e.target.value)}
                                        autoComplete="address-level1"
                                    />
                                    {(form.errors.state as string) && (
                                        <p className="mt-1 text-sm text-red-600">{form.errors.state}</p>
                                    )}
                                </div>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <Label>Postal Code</Label>
                                    <Input
                                        type="text"
                                        value={form.data.postal_code}
                                        onChange={(e) => form.setData('postal_code', e.target.value)}
                                        autoComplete="postal-code"
                                    />
                                    {(form.errors.postal_code as string) && (
                                        <p className="mt-1 text-sm text-red-600">{form.errors.postal_code}</p>
                                    )}
                                </div>
                                
                                <div>
                                    <Label>Country</Label>
                                    <Select
                                        value={form.data.country}
                                        onValueChange={(value) => form.setData('country', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="Indonesia">Indonesia</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    {(form.errors.country as string) && (
                                        <p className="mt-1 text-sm text-red-600">{form.errors.country}</p>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Administrator Information */}
                    <div className="space-y-4">
                        <h2 className="text-xl font-semibold">Administrator Information</h2>
                        
                        <div className="space-y-4">
                            <div>
                                <Label>Full Name</Label>
                                <Input
                                    type="text"
                                    value={form.data.administrator?.name || ''}
                                    onChange={(e) => form.setData('administrator', {
                                        ...form.data.administrator,
                                        name: e.target.value
                                    })}
                                    autoComplete="name"
                                />
                                {(form.errors.administrator as CompanyFormErrors['administrator'])?.name && (
                                    <p className="mt-1 text-sm text-red-600">{(form.errors.administrator as CompanyFormErrors['administrator'])?.name}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Email</Label>
                                <Input
                                    type="email"
                                    value={form.data.administrator?.email || ''}
                                    onChange={(e) => form.setData('administrator', {
                                        ...form.data.administrator,
                                        email: e.target.value
                                    })}
                                    autoComplete="email"
                                />
                                {(form.errors.administrator as CompanyFormErrors['administrator'])?.email && (
                                    <p className="mt-1 text-sm text-red-600">{(form.errors.administrator as CompanyFormErrors['administrator'])?.email}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Password</Label>
                                <Input
                                    type="password"
                                    value={form.data.administrator?.password || ''}
                                    onChange={(e) => form.setData('administrator', {
                                        ...form.data.administrator,
                                        password: e.target.value
                                    })}
                                    autoComplete="new-password"
                                />
                                {(form.errors.administrator as CompanyFormErrors['administrator'])?.password && (
                                    <p className="mt-1 text-sm text-red-600">{(form.errors.administrator as CompanyFormErrors['administrator'])?.password}</p>
                                )}
                            </div>
                            
                            <div>
                                <Label>Confirm Password</Label>
                                <Input
                                    type="password"
                                    value={form.data.administrator?.password_confirmation || ''}
                                    onChange={(e) => form.setData('administrator', {
                                        ...form.data.administrator,
                                        password_confirmation: e.target.value
                                    })}
                                    autoComplete="new-password"
                                />
                                {(form.errors.administrator as CompanyFormErrors['administrator'])?.password_confirmation && (
                                    <p className="mt-1 text-sm text-red-600">{(form.errors.administrator as CompanyFormErrors['administrator'])?.password_confirmation}</p>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Logo Upload */}
                    <div className="space-y-4">
                        <h2 className="text-xl font-semibold">Company Logo</h2>
                        
                        <Card>
                            <CardContent className="p-6">
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between">
                                        <Label>Logo</Label>
                                        {form.data.logo && (
                                            <div className="flex items-center gap-2">
                                                <span className="text-sm text-gray-500">{form.data.logo.name}</span>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    onClick={() => form.setData('logo', null)}
                                                >
                                                    Remove
                                                </Button>
                                            </div>
                                        )}
                                    </div>
                                    <div className="flex items-center gap-4">
                                        <input
                                            type="file"
                                            accept="image/*"
                                            onChange={handleLogoChange}
                                            className="hidden"
                                            id="logo-upload"
                                        />
                                        <Button variant="outline" type="button" onClick={() => document.getElementById('logo-upload')?.click()}>
                                            {form.data.logo ? 'Change Logo' : 'Upload Logo'}
                                        </Button>
                                    </div>
                                        {(form.errors.logo as string) && (
                                            <p className="mt-1 text-sm text-red-600">{form.errors.logo}</p>
                                        )}
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        <div className="flex justify-end">
                            <Button type="submit" disabled={form.processing}>
                                Register Company
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
