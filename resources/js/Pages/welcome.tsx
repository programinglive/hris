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
                                    <Link href="/login" className="text-white hover:text-gray-300">
                                        Login
                                    </Link>
                                    <Link
                                        href="/register-company"
                                        className="bg-white text-black px-4 py-2 rounded-md hover:bg-gray-200 font-medium"
                                    >
                                        Register Company
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </nav>

                {/* Hero Section */}
                <section className="bg-gradient-to-b from-gray-900 to-black text-white pt-32 pb-20">
                    <div className="container mx-auto px-6">
                        <div className="flex flex-col md:flex-row items-center">
                            <div className="md:w-1/2 mb-10 md:mb-0">
                                <h1 className="text-5xl font-bold mb-4">
                                    Streamline Your HR Processes with Our HRIS
                                </h1>
                                <p className="text-xl mb-8 text-gray-300">
                                    Simplify payroll, manage employee data, and boost productivity with our all-in-one HR solution.
                                </p>
                                <div className="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                    <Link
                                        href="/register-company"
                                        className="bg-white text-black px-6 py-3 rounded-md font-semibold hover:bg-gray-200 text-center"
                                    >
                                        Register Your Company
                                    </Link>
                                    <Link
                                        href="#features"
                                        className="border border-white text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-800 text-center"
                                    >
                                        Learn More
                                    </Link>
                                </div>
                            </div>
                            <div className="md:w-1/2">
                                <div className="bg-white p-4 rounded-lg shadow-xl">
                                    <img 
                                        src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" 
                                        alt="HRIS Dashboard" 
                                        className="rounded-lg shadow-md"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Stats Section */}
                <section className="py-12 bg-black text-white">
                    <div className="container mx-auto px-6">
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                            <div className="p-4">
                                <p className="text-4xl font-bold text-white">500+</p>
                                <p className="text-gray-400">Companies</p>
                            </div>
                            <div className="p-4">
                                <p className="text-4xl font-bold text-white">10k+</p>
                                <p className="text-gray-400">Users</p>
                            </div>
                            <div className="p-4">
                                <p className="text-4xl font-bold text-white">99.9%</p>
                                <p className="text-gray-400">Uptime</p>
                            </div>
                            <div className="p-4">
                                <p className="text-4xl font-bold text-white">24/7</p>
                                <p className="text-gray-400">Support</p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-20 bg-gray-900" id="features">
                    <div className="container mx-auto px-6">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl font-bold text-white">Powerful Features for Modern HR</h2>
                            <p className="text-gray-300 mt-4 max-w-2xl mx-auto">Our comprehensive HRIS platform provides everything you need to manage your workforce efficiently.</p>
                        </div>
                        
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {/* Feature 1 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <BadgeDollarSign className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Payroll Management</h3>
                                <p className="text-center text-gray-300">Automate payroll calculations, tax deductions, and ensure accurate payments to your employees every time.</p>
                                <ul className="mt-4 text-gray-300 text-sm">
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Automated calculations
                                    </li>
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Tax compliance
                                    </li>
                                    <li className="flex items-center">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Direct deposit support
                                    </li>
                                </ul>
                            </div>
                            
                            {/* Feature 2 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <Database className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Employee Database</h3>
                                <p className="text-center text-gray-300">Centralized employee data management with secure storage and easy access to important information.</p>
                                <ul className="mt-4 text-gray-300 text-sm">
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Secure data storage
                                    </li>
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Custom fields
                                    </li>
                                    <li className="flex items-center">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Document management
                                    </li>
                                </ul>
                            </div>
                            
                            {/* Feature 3 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <Clock className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Time Tracking</h3>
                                <p className="text-center text-gray-300">Accurate time tracking with flexible options for remote, in-office, and hybrid work arrangements.</p>
                                <ul className="mt-4 text-gray-300 text-sm">
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Mobile check-in/out
                                    </li>
                                    <li className="flex items-center mb-2">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Leave management
                                    </li>
                                    <li className="flex items-center">
                                        <CheckCircle className="w-4 h-4 text-green-500 mr-2" />
                                        Overtime calculation
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            {/* Feature 4 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <Building className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Company Management</h3>
                                <p className="text-center text-gray-300">Organize your company structure with departments, branches, and positions.</p>
                            </div>
                            
                            {/* Feature 5 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <Users className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Team Collaboration</h3>
                                <p className="text-center text-gray-300">Tools to enhance communication and collaboration across departments.</p>
                            </div>
                            
                            {/* Feature 6 */}
                            <div className="bg-black p-8 rounded-lg shadow-md flex flex-col items-center hover:shadow-lg transition-shadow duration-300 border-t-4 border-white text-white">
                                <BarChart3 className="w-12 h-12 text-white mb-4" />
                                <h3 className="text-xl font-semibold mb-2 text-white text-center">Analytics & Reports</h3>
                                <p className="text-center text-gray-300">Comprehensive reporting tools to gain insights into your workforce.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Benefits Section */}
                <section className="bg-gray-800 py-20">
                    <div className="container mx-auto px-6">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl font-bold text-white">Why Choose Our HRIS</h2>
                            <p className="text-gray-300 mt-4 max-w-2xl mx-auto">Experience the advantages that make our platform the preferred choice for growing businesses.</p>
                        </div>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
                            {/* Benefit 1 */}
                            <div className="bg-black p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div className="flex items-start">
                                    <div className="bg-gray-700 p-3 rounded-full mr-4">
                                        <TrendingUp className="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-semibold mb-2 text-white">Increased Efficiency</h3>
                                        <p className="text-gray-300">Automate repetitive HR tasks and workflows to save valuable time. Our system reduces manual data entry by up to 80%, allowing your HR team to focus on strategic initiatives rather than administrative work.</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Benefit 2 */}
                            <div className="bg-black p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div className="flex items-start">
                                    <div className="bg-gray-700 p-3 rounded-full mr-4">
                                        <ShieldCheck className="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-semibold mb-2 text-white">Reduced Errors</h3>
                                        <p className="text-gray-300">Minimize costly mistakes with automated calculations and data validation. Our system ensures accuracy in payroll processing, tax calculations, and compliance reporting, protecting your business from potential penalties.</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Benefit 3 */}
                            <div className="bg-black p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div className="flex items-start">
                                    <div className="bg-gray-700 p-3 rounded-full mr-4">
                                        <Briefcase className="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-semibold mb-2 text-white">Improved Compliance</h3>
                                        <p className="text-gray-300">Stay up-to-date with changing labor laws and regulations. Our system automatically updates to reflect the latest compliance requirements, reducing your legal risk and ensuring proper documentation.</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Benefit 4 */}
                            <div className="bg-black p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div className="flex items-start">
                                    <div className="bg-gray-700 p-3 rounded-full mr-4">
                                        <Calendar className="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-semibold mb-2 text-white">Better Planning</h3>
                                        <p className="text-gray-300">Make informed decisions with comprehensive workforce data at your fingertips. Our analytics tools help you identify trends, forecast needs, and optimize resource allocation for better business outcomes.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Testimonials Section */}
                <section className="py-20 bg-black">
                    <div className="container mx-auto px-6">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl font-bold text-white">What Our Customers Say</h2>
                            <p className="text-gray-300 mt-4 max-w-2xl mx-auto">Hear from businesses that have transformed their HR operations with our platform.</p>
                        </div>
                        
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {/* Testimonial 1 */}
                            <div className="bg-gray-900 p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 relative">
                                <div className="absolute -top-4 left-8 bg-white text-black p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <p className="italic text-gray-300 mb-6">"Implementing this HRIS has been a game-changer for our company. We've reduced our payroll processing time by 75% and eliminated costly errors. The employee self-service features have also significantly reduced HR inquiries."</p>
                                <div className="flex items-center">
                                    <div className="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center mr-4">
                                        <span className="text-white font-bold">JD</span>
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-white">Jane Doe</h4>
                                        <p className="text-sm text-gray-400">HR Director, Tech Solutions Inc.</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Testimonial 2 */}
                            <div className="bg-gray-900 p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 relative">
                                <div className="absolute -top-4 left-8 bg-white text-black p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <p className="italic text-gray-300 mb-6">"As a growing business, we needed an HR solution that could scale with us. This platform has been perfect - easy to set up, intuitive to use, and the support team is always quick to respond when we need help."</p>
                                <div className="flex items-center">
                                    <div className="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center mr-4">
                                        <span className="text-white font-bold">MS</span>
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-white">Michael Smith</h4>
                                        <p className="text-sm text-gray-400">CEO, GrowFast Startups</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Testimonial 3 */}
                            <div className="bg-gray-900 p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 relative">
                                <div className="absolute -top-4 left-8 bg-white text-black p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <p className="italic text-gray-300 mb-6">"The reporting capabilities have given us insights we never had before. We can now make data-driven decisions about staffing, compensation, and benefits that have improved our retention rates significantly."</p>
                                <div className="flex items-center">
                                    <div className="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center mr-4">
                                        <span className="text-white font-bold">AJ</span>
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-white">Amanda Johnson</h4>
                                        <p className="text-sm text-gray-400">Operations Manager, Retail Chain</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Call-to-Action Section */}
                <section className="bg-gradient-to-b from-gray-900 to-black text-white py-20">
                    <div className="container mx-auto px-6 text-center">
                        <h2 className="text-4xl font-bold mb-6">Ready to Transform Your HR?</h2>
                        <p className="text-xl mb-8 max-w-3xl mx-auto">
                            Join hundreds of companies that have simplified their HR operations and improved employee satisfaction with our comprehensive HRIS platform.
                        </p>
                        <div className="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <Link
                                href="/register-company"
                                className="bg-white text-black px-8 py-4 rounded-md font-semibold hover:bg-gray-200 text-center"
                            >
                                Register Your Company
                            </Link>
                            <Link
                                href="/login"
                                className="border-2 border-white text-white px-8 py-4 rounded-md font-semibold hover:bg-gray-800 text-center"
                            >
                                Login to Your Account
                            </Link>
                        </div>
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-900 text-gray-300 py-12">
                    <div className="container mx-auto px-6">
                        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div>
                                <h3 className="text-xl font-semibold mb-4 text-white">HRIS</h3>
                                <p className="mb-4">Comprehensive human resource management system for modern businesses.</p>
                                <div className="flex space-x-4">
                                    <a href="#" className="text-gray-300 hover:text-white">
                                        <span className="sr-only">Facebook</span>
                                        <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fillRule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clipRule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" className="text-gray-300 hover:text-white">
                                        <span className="sr-only">Twitter</span>
                                        <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                    </a>
                                    <a href="#" className="text-gray-300 hover:text-white">
                                        <span className="sr-only">LinkedIn</span>
                                        <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fillRule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clipRule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold mb-4 text-white">Features</h3>
                                <ul className="space-y-2">
                                    <li><a href="#features" className="hover:text-white">Payroll Management</a></li>
                                    <li><a href="#features" className="hover:text-white">Employee Database</a></li>
                                    <li><a href="#features" className="hover:text-white">Time Tracking</a></li>
                                    <li><a href="#features" className="hover:text-white">Analytics & Reports</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold mb-4 text-white">Resources</h3>
                                <ul className="space-y-2">
                                    <li><a href="#" className="hover:text-white">Documentation</a></li>
                                    <li><a href="#" className="hover:text-white">Blog</a></li>
                                    <li><a href="#" className="hover:text-white">Support Center</a></li>
                                    <li><a href="#" className="hover:text-white">Contact Us</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold mb-4 text-white">Legal</h3>
                                <ul className="space-y-2">
                                    <li><a href="#" className="hover:text-white">Privacy Policy</a></li>
                                    <li><a href="#" className="hover:text-white">Terms of Service</a></li>
                                    <li><a href="#" className="hover:text-white">Cookie Policy</a></li>
                                    <li><a href="#" className="hover:text-white">GDPR Compliance</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="border-t border-gray-700 mt-8 pt-8 text-center">
                            <p>&copy; {new Date().getFullYear()} HRIS Platform. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}