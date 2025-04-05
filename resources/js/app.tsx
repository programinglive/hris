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
        const modules = import.meta.glob('./Pages/**/*.tsx');
        
        // Extract module paths for easier comparison
        const availableModulePaths = Object.keys(modules);
        
        // Generate the component path directly from the name
        const componentPath = `./Pages/${name}.tsx`;
        
        // Check if the exact path exists
        if (availableModulePaths.includes(componentPath)) {
            return modules[componentPath]();
        }
        
        // If not found, try with different casing (fallback)
        const foundPath = availableModulePaths.find(path => 
            path.toLowerCase() === componentPath.toLowerCase()
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
