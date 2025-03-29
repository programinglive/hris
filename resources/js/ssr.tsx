import { createInertiaApp } from '@inertiajs/react';
import createServer from '@inertiajs/react/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ReactDOMServer from 'react-dom/server';
import { type RouteName, route } from 'ziggy-js';

const appName = import.meta.env.VITE_APP_NAME || 'HRIS Project';

createServer((page) =>
    createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => {
            // Get all available page modules
            const modules = import.meta.glob('./Pages/**/*.tsx');
            
            // Extract module paths for easier comparison
            const availableModulePaths = Object.keys(modules);
            console.log('Available modules:', availableModulePaths);
            
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
                    console.log('Trying to resolve path:', path);
                    
                    // Check if the module exists
                    if (availableModulePaths.includes(path)) {
                        console.log('Found matching module for path:', path);
                        return resolvePageComponent(path, modules);
                    }
                }
            }
            
            // Direct check for dashboard/Dashboard
            if (pageName.toLowerCase() === 'dashboard') {
                const dashboardPath = './Pages/dashboard.tsx';
                if (availableModulePaths.includes(dashboardPath)) {
                    console.log('Found Dashboard component at:', dashboardPath);
                    return resolvePageComponent(dashboardPath, modules);
                }
            }
            
            // If no match found, try the original path (backward compatibility)
            console.log('No matching module found, using fallback path:', `./Pages/${name}.tsx`);
            return resolvePageComponent(`./Pages/${name}.tsx`, modules);
        },
        setup: ({ App, props }) => {
            /* eslint-disable */
            // @ts-expect-error
            global.route<RouteName> = (name, params, absolute) =>
                route(name, params as any, absolute, {
                    // @ts-expect-error
                    ...page.props.ziggy,
                    // @ts-expect-error
                    location: new URL(page.props.ziggy.location),
                });
            /* eslint-enable */

            return <App {...props} />;
        },
    }),
);
