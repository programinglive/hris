import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import React from 'react';
import {
    BadgeDollarSign,
    Database,
    Clock,
    TrendingUp,
    ShieldCheck,
    ArrowRight,
    Building,
    Users,
    BarChart3,
    CheckCircle,
    ChevronRight,
    Briefcase,
    Calendar,
    Award
} from 'lucide-react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome to Your HRIS SaaS" />

            <div className="min-h-screen bg-gray-900 text-white">
                {/* Navigation Bar */}
                <nav className="bg-black shadow-md fixed w-full z-10">
                    <div className="container mx-auto px-6 py-4 flex justify-between items-center">
                        <Link href="/" className="text-2xl font-bold text-white flex items-center">
                            <ArrowRight className="mr-2" />
                            HRIS
                        </Link>
                        <div>
                            {auth.user ? (
                                <Link href="/dashboard" className="text-white hover:text-gray-300">
                                    Dashboard
                                </Link>
                            ) : (
                                <div className="space-x-4">
                                    <Link href="/register-company" className="bg-white text-black px-4 py-2 rounded-md hover:bg-gray-200 font-medium">
                                        Register Company
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </nav>

                {/* Main Content */}
                <main className="mt-20">
                    <div className="container mx-auto px-6 py-12">
                        <div className="text-center">
                            <h1 className="text-4xl font-bold mb-6">
                                Welcome to HRIS SaaS
                            </h1>
                            <p className="text-xl text-gray-300 mb-12">
                                Your complete Human Resource Information System solution
                            </p>

                            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div className="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition-colors">
                                    <Database className="w-12 h-12 text-blue-500 mb-4" />
                                    <h3 className="text-lg font-semibold">Centralized Data</h3>
                                    <p className="text-gray-400">Manage all your HR data in one place</p>
                                </div>
                                <div className="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition-colors">
                                    <Users className="w-12 h-12 text-green-500 mb-4" />
                                    <h3 className="text-lg font-semibold">Employee Management</h3>
                                    <p className="text-gray-400">Track employee information and performance</p>
                                </div>
                                <div className="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition-colors">
                                    <Calendar className="w-12 h-12 text-purple-500 mb-4" />
                                    <h3 className="text-lg font-semibold">Attendance Tracking</h3>
                                    <p className="text-gray-400">Monitor employee attendance and leave</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </>
    );
}