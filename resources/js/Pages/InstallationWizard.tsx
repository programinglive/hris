import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { Clock, AlertCircle } from 'lucide-react';

export default function InstallationWizard() {
    return (
        <div className="min-h-screen bg-white">
            <Head>
                <title>Installation Wizard - Coming Soon</title>
                <meta name="description" content="Installation wizard for HRIS Open Source - Coming Soon" />
            </Head>

            <div className="relative isolate overflow-hidden">
                <div className="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                    <div className="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-primary to-secondary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" />
                </div>
                
                <div className="px-6 py-24 sm:py-32 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <motion.div
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8 }}
                            className="mb-8"
                        >
                            <Clock className="mx-auto h-12 w-12 text-primary" />
                        </motion.div>
                        
                        <motion.h1
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.2 }}
                            className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                        >
                            Coming Soon
                        </motion.h1>
                        <motion.p
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.4 }}
                            className="mt-6 text-lg leading-8 text-gray-600"
                        >
                            The installation wizard is currently under development and will be available soon.
                            Stay tuned for updates!
                        </motion.p>
                        
                        <motion.div
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.6 }}
                            className="mt-10 flex items-center justify-center gap-x-6"
                        >
                            <AlertCircle className="h-6 w-6 text-yellow-500" />
                            <span className="text-sm text-gray-500">Development in progress</span>
                        </motion.div>
                    </div>
                </div>
            </div>
        </div>
    );
}
