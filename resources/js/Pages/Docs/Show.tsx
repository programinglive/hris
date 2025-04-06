import DocsLayout from './DocsLayout';

interface DocumentationShowProps {
    html: string;
    file: string;
}

export default function DocsShow({ html, file }: DocumentationShowProps) {
    return (
        <DocsLayout title={file.replace('.md', '')} activeFile={file}>
            <div className="prose prose-lg max-w-none bg-[#1E2938] dark:bg-white">
                <div 
                    className="prose prose-lg max-w-none text-gray-900 dark:text-white" 
                    dangerouslySetInnerHTML={{ 
                        __html: html || '' 
                    }} 
                />
            </div>
        </DocsLayout>
    );
}
