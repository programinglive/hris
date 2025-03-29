import * as React from "react";
import { Slot } from "@radix-ui/react-slot";
import { cva, type VariantProps } from "class-variance-authority";
import { cn } from "@/lib/utils";
import { Link as InertiaLink } from "@inertiajs/react";

const linkVariants = cva(
  "inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50",
  {
    variants: {
      variant: {
        default: "text-primary hover:text-primary/80",
        destructive: "text-destructive hover:text-destructive/80",
        outline: "border border-input bg-background hover:bg-accent hover:text-accent-foreground",
        secondary: "text-secondary-foreground hover:text-secondary-foreground/80",
        ghost: "hover:bg-accent hover:text-accent-foreground",
        muted: "text-muted-foreground hover:text-muted-foreground/80",
      },
      size: {
        default: "h-10 px-4 py-2",
        sm: "h-9 px-3",
        lg: "h-11 px-8",
        icon: "h-10 w-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "default",
    },
  }
);

export interface LinkProps
  extends Omit<React.AnchorHTMLAttributes<HTMLAnchorElement>, 'href'>,
    VariantProps<typeof linkVariants> {
  asChild?: boolean;
  href: string;
}

const Link = React.forwardRef<HTMLAnchorElement, LinkProps>(
  ({ className, variant, size, asChild = false, href, children, ...props }, ref) => {
    const Comp = asChild ? Slot : "a";
    
    if (asChild) {
      return (
        <Comp
          className={cn(linkVariants({ variant, size, className }))}
          ref={ref}
          {...props}
        />
      );
    }
    
    return (
      <InertiaLink
        href={href}
        className={cn(linkVariants({ variant, size, className }))}
      >
        {children}
      </InertiaLink>
    );
  }
);
Link.displayName = "Link";

export { Link };
