import { Head } from '@inertiajs/react';
import { Button } from '@/Components/ui/button';
import { motion } from 'framer-motion';
import { User, Users, DollarSign, BookOpen, UserPlus, Rocket, Code, Shield, Book, ExternalLink } from 'lucide-react';
import { Link, usePage } from '@inertiajs/react';
import { type SharedData } from '@/types';

export default function Landing() {
    const page = usePage<SharedData>();
    const { auth } = page.props;

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
            <Head>
                <title>HRIS Open Source - Modern HR Management System</title>
                <meta name="description" content="Manage your company's HR with our powerful and flexible open source HRIS system" />
            </Head>

            {/* Hero Section */}
            <div className="relative isolate overflow-hidden">
                <div className="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                    <div className="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-gray-800/50 to-gray-900/50 dark:from-gray-100/50 dark:to-gray-200/50 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" />
                </div>
                
                <div className="px-6 py-24 sm:py-32 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <motion.h1
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8 }}
                            className="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-50 sm:text-6xl"
                        >
                            Modern HR Management System
                        </motion.h1>
                        <motion.p
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.2 }}
                            className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-400"
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
                                <Button asChild size="lg" className="bg-gray-800 text-white hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition-all duration-200">
                                    <Link href={route('register.company')}>
                                        <Rocket className="mr-2 h-5 w-5" />
                                        Get Started
                                    </Link>
                                </Button>
                            </motion.div>
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.8, delay: 0.6 }}
                            >
                                {auth.user ? (
                                    <Button asChild size="lg" variant="outline" className="bg-white text-gray-900 hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition-all duration-200">
                                        <Link href={route('dashboard')}>
                                            <User className="mr-2 h-5 w-5" />
                                            Dashboard
                                        </Link>
                                    </Button>
                                ) : (
                                    <Button asChild size="lg" variant="outline" className="bg-white text-gray-900 hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition-all duration-200">
                                        <Link href={route('login')}>
                                            <User className="mr-2 h-5 w-5" />
                                            Login to Account
                                        </Link>
                                    </Button>
                                )}
                            </motion.div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Features Section */}
            <div className="py-24 sm:py-32 bg-white dark:bg-gray-800">
                <div className="mx-auto max-w-7xl px-6 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Everything you need to manage your HR
                        </h2>
                        <p className="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-400">
                            Our comprehensive HRIS solution covers all aspects of human resource management, 
                            from employee onboarding to payroll processing and beyond.
                        </p>
                    </div>
                    <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                        <dl className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <Users className="h-6 w-6 text-gray-600 dark:text-gray-300" />
                                    <span>Employee Management</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600 dark:text-gray-400">
                                    Manage employee profiles, attendance, leave, and performance. 
                                    Track employee development and career progression.
                                </dd>
                            </div>
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <DollarSign className="h-6 w-6 text-gray-600 dark:text-gray-300" />
                                    <span>Payroll Processing</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600 dark:text-gray-400">
                                    Process salaries, calculate taxes, and generate payslips. 
                                    Automate payroll calculations and manage employee benefits.
                                </dd>
                            </div>
                            <div className="flex flex-col">
                                <dt className="flex items-center gap-2 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <UserPlus className="h-6 w-6 text-gray-600 dark:text-gray-300" />
                                    <span>Recruitment</span>
                                </dt>
                                <dd className="mt-3 text-base leading-7 text-gray-600 dark:text-gray-400">
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
                                <Button asChild size="lg" className="bg-gray-800 text-white hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition-all duration-200">
                                    <Link href={route('register.company.show')}>
                                        <Rocket className="mr-2 h-5 w-5" />
                                        Start Your Free Trial
                                    </Link>
                                </Button>
                            </motion.div>
                        </div>
                    </div>
                </div>
            </div>
            <footer className="mt-24 border-t border-gray-200 py-16 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div className="mx-auto max-w-7xl px-6 lg:px-8">
                    <div className="grid grid-cols-1 gap-x-8 gap-y-16 md:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <h3 className="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Company</h3>
                            <p className="mt-6 text-sm leading-6 text-gray-600 dark:text-gray-400">
                                Open Source HRIS that helps you manage your company's human resources efficiently and effectively.
                            </p>
                        </div>
                        <div>
                            <h3 className="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Resources</h3>
                            <ul role="list" className="mt-6 space-y-4">
                                <li>
                                    <Link href={route('docs')} className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <BookOpen className="inline h-4 w-4 mr-1" />
                                        Documentation
                                    </Link>
                                </li>
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <Code className="inline h-4 w-4 mr-1" />
                                        API Reference
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <Shield className="inline h-4 w-4 mr-1" />
                                        Support
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 className="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Community</h3>
                            <ul role="list" className="mt-6 space-y-4">
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <ExternalLink className="inline h-4 w-4 mr-1" />
                                        GitHub
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <ExternalLink className="inline h-4 w-4 mr-1" />
                                        Discord
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <ExternalLink className="inline h-4 w-4 mr-1" />
                                        Twitter
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 className="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Legal</h3>
                            <ul role="list" className="mt-6 space-y-4">
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <Shield className="inline h-4 w-4 mr-1" />
                                        Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                        <Book className="inline h-4 w-4 mr-1" />
                                        Terms of Service
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div className="mt-16 flex justify-center border-t border-gray-200 pt-10 dark:border-gray-700">
                        <p className="text-sm leading-6 text-gray-600 dark:text-gray-400">
                            &copy; {new Date().getFullYear()} HRIS Open Source. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    );
}
