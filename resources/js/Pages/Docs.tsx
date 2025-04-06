import DocsLayout from './Docs/DocsLayout';

export default function Docs() {
    return (
        <DocsLayout title="Documentation">
            <div className="prose prose-lg max-w-none">
                <p>Welcome to the HRIS Open Source documentation. This guide will help you get started with the application and explore its features.</p>
                
                <h2>Getting Started</h2>
                <p>Start by reading the introduction and installation guides to set up your development environment.</p>
                
                <h2>Features</h2>
                <p>Explore the features section to learn about employee management and organization structure.</p>
                
                <h2>API</h2>
                <p>For developers, the API documentation provides detailed information about available endpoints and usage.</p>
                
                <h2>Reference</h2>
                <p>The reference section contains additional information and resources.</p>
            </div>
        </DocsLayout>
    );
}
