import { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    // Extract the className to add conditional styling for dark mode
    const { className, ...otherProps } = props;
    
    return (
        <svg 
            className={className} 
            {...otherProps} 
            viewBox="0 0 24 24" 
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fillRule="evenodd"
                clipRule="evenodd"
                d="M1 22H23V19H1V22ZM14 1.5L8 5.5V7H10V17H12V7H14V17H16V7H18V5.5L14 1.5ZM5 10.5V17H3V10.5L5 10.5ZM5 9L3 9L3 7.5L5 7.5V9ZM21 10.5V17H19V10.5H21ZM19 9H21V7.5H19V9Z"
                className="fill-current"
            />
        </svg>
    );
}
