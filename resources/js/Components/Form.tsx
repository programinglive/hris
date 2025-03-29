import {type ReactNode} from 'react';

interface FormProps {
    children: ReactNode;
    onSubmit: (event: React.FormEvent<HTMLFormElement>) => void;
    className?: string;
}

export function Form({children, onSubmit, className = ''}: FormProps) {
    return (
        <form onSubmit={onSubmit} className={className}>
            {children}
        </form>
    );
}
