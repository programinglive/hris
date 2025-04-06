import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import { initializeTheme } from './hooks/use-appearance';

const appName = import.meta.env.VITE_APP_NAME || 'HRIS Open Source';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        // Get all available page modules
        const tsxModules = import.meta.glob('./Pages/**/*.tsx');
        const jsxModules = import.meta.glob('./Pages/**/*.jsx');
        
        // Combine both sets of modules
        const modules = {
            ...tsxModules,
            ...jsxModules
        };
        
        // Extract module paths for easier comparison
        const availableModulePaths = Object.keys(modules);
        
        // Generate component paths for both extensions
        const componentPaths = [
            `./Pages/${name}.tsx`,
            `./Pages/${name}.jsx`
        ];
        
        // Try to find the component with either extension
        const foundPath = componentPaths.find(path => 
            availableModulePaths.includes(path) || 
            availableModulePaths.some(p => p.toLowerCase() === path.toLowerCase())
        );
        
        if (foundPath) {
            return modules[foundPath]();
        }
        
        // If still not found, throw an error
        throw new Error(`Could not resolve component: ${name}`);
    },
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on load...
initializeTheme();
