import DocsLayout from './DocsLayout';

interface DocumentationShowProps {
    html: string;
    file: string;
}

export default function DocsShow({ html, file }: DocumentationShowProps) {
    return (
        <DocsLayout title={file.replace('.md', '')} activeFile={file}>
            <div className="prose prose-lg max-w-4xl mx-auto px-10">
                <div className="prose prose-lg max-w-none" dangerouslySetInnerHTML={{ __html: html || '' }} />
            </div>
        </DocsLayout>
    );
}
