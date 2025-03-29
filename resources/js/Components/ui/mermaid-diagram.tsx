"use client";

import { useEffect, useRef, useState } from "react";
import mermaid from "mermaid";

interface MermaidDiagramProps {
  chart: string;
  className?: string;
}

export function MermaidDiagram({ chart, className }: MermaidDiagramProps) {
  const [svg, setSvg] = useState<string>("");
  const [error, setError] = useState<string | null>(null);
  const mermaidRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const renderDiagram = async () => {
      if (!chart) return;

      try {
        mermaid.initialize({
          startOnLoad: false,
          theme: "default",
          securityLevel: "loose",
        });

        // Generate a valid ID without special characters
        const id = `mermaid-diagram-${Math.floor(Math.random() * 10000)}`;
        
        const { svg } = await mermaid.render(id, chart);
        setSvg(svg);
        setError(null);
      } catch (err) {
        console.error("Mermaid diagram rendering error:", err);
        setError("Failed to render diagram. Please check your syntax.");
      }
    };

    renderDiagram();
  }, [chart]);

  if (error) {
    return (
      <div className="p-4 border border-red-300 bg-red-50 text-red-700 rounded-md">
        <p className="font-medium">Error rendering diagram</p>
        <p className="text-sm">{error}</p>
        <pre className="mt-2 p-2 bg-gray-100 rounded overflow-auto text-xs">
          {chart}
        </pre>
      </div>
    );
  }

  if (!svg) {
    return (
      <div className="flex items-center justify-center p-8 bg-gray-50 rounded-md">
        <div className="animate-spin h-6 w-6 border-2 border-gray-500 rounded-full border-t-transparent"></div>
      </div>
    );
  }

  return (
    <div
      ref={mermaidRef}
      className={className}
      dangerouslySetInnerHTML={{ __html: svg }}
    />
  );
}
