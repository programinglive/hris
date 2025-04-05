import { Head } from '@inertiajs/react';
import { Button } from '@/Components/ui/button';
import { motion } from 'framer-motion';
import { User, Users, DollarSign, BookOpen, UserPlus, Rocket } from 'lucide-react';

export default function Landing() {
    return (
        <div className="min-h-screen bg-gradient-to-br from-gray-50 to-white">
            <Head>
                <title>HRIS Open Source - Modern HR Management System</title>
                <meta name="description" content="Manage your company's HR with our powerful and flexible open source HRIS system" />
            </Head>

            {/* Hero Section */}
            <div className="relative isolate overflow-hidden">
                <div className="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                    <div className="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-primary to-secondary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" />
                </div>
                
                <div className="px-6 py-24 sm:py-32 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <motion.h1
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8 }}
                            className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                        >
                            Modern HR Management System
                        </motion.h1>
                        <motion.p
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.2 }}
                            className="mt-6 text-lg leading-8 text-gray-600"
                        >
                            Open source HRIS that helps you manage your company's human resources efficiently and effectively. 
                            Streamline your HR processes with our comprehensive solution built for modern businesses.
                        </motion.p>
                        <div className="mt-10 flex items-center justify-center gap-x-6">
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.8, delay: 0.4 }}
                            >
                                <Button asChild size="lg" className="bg-primary text-white hover:bg-primary/90">
                                    <a href={route('register.company')}>
                                        <Rocket className="mr-2 h-4 w-4" />
                                        Getting Started
                                    </a>
                                </Button>
                            </motion.div>
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.8, delay: 0.6 }}
                            >
                                <Button asChild size="lg" variant="outline" className="text-gray-900 hover:bg-gray-100">
                                    <a href={route('login')}>
                                        <User className="mr-2 h-4 w-4" />
                                        Login to Account
                                    </a>
                                </Button>
                            </motion.div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Features Section */}
            <div className="py-24 sm:py-32">
                <div className="mx-auto max-w-7xl px-6 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            Everything you need to manage your HR
                        </h2>
                        <p className="mt-2 text-lg leading-8 text-gray-600">
                            Our comprehensive HRIS solution covers all aspects of human resource management, 
                            from employee onboarding to payroll processing and beyond.
                        </p>
                    </div>
                    <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                        <dl className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900">
                                    <Users className="h-6 w-6 text-primary" />
                                    <span>Employee Management</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600">
                                    Manage employee profiles, attendance, leave, and performance. 
                                    Track employee development and career progression.
                                </dd>
                            </div>
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900">
                                    <DollarSign className="h-6 w-6 text-primary" />
                                    <span>Payroll Processing</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600">
                                    Process salaries, calculate taxes, and generate payslips. 
                                    Automate payroll calculations and manage employee benefits.
                                </dd>
                            </div>
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900">
                                    <UserPlus className="h-6 w-6 text-primary" />
                                    <span>Recruitment</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600">
                                    Manage job postings, applications, and interview scheduling. 
                                    Track candidate progress through the hiring pipeline.
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {/* CTA Section */}
            <div className="bg-gray-900">
                <div className="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8 lg:py-40">
                    <div className="text-center">
                        <h2 className="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Ready to transform your HR management?
                        </h2>
                        <p className="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                            Join thousands of companies using our open source HRIS to streamline their HR processes. 
                            Get started with a free trial today and experience the power of modern HR management.
                        </p>
                        <div className="mt-10 flex items-center justify-center gap-x-6">
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.8, delay: 0.4 }}
                            >
                                <Button asChild size="lg" className="bg-white text-gray-900 hover:bg-gray-100">
                                    <a href={route('register.company.show')}>
                                        <BookOpen className="mr-2 h-4 w-4" />
                                        Start Your Free Trial
                                    </a>
                                </Button>
                            </motion.div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
