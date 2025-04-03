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
        
        // Convert route names to proper case for component paths
        const segments = name.split('/');
        const pageName = segments.pop() || ''; // Get the last segment (filename)
        
        // Generate all possible folder paths
        const folderPaths = [''];
        if (segments.length > 0) {
            // Original path
            folderPaths.push(segments.join('/') + '/');
            
            // Capitalized folders
            const capitalizedFolders = segments.map(segment => 
                segment.charAt(0).toUpperCase() + segment.slice(1)
            );
            folderPaths.push(capitalizedFolders.join('/') + '/');
        }
        
        // Generate all possible file name variants
        const fileVariants = [
            pageName,
            pageName.charAt(0).toUpperCase() + pageName.slice(1), // PascalCase
            pageName.toLowerCase(), // lowercase
            pageName.toUpperCase() // UPPERCASE (rare but possible)
        ];
        
        // Try all possible combinations of folder paths and file variants
        for (const folderPath of folderPaths) {
            for (const fileVariant of fileVariants) {
                const path = `./Pages/${folderPath}${fileVariant}.tsx`;
                
                // Check if the module exists
                if (availableModulePaths.includes(path)) {
                    return resolvePageComponent(path, modules);
                }
            }
        }
        
        // If no match found, try the original path (backward compatibility)
        return resolvePageComponent(`./Pages/${name}.tsx`, modules);
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
