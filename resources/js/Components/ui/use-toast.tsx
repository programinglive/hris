// Adapted from https://ui.shadcn.com/docs/components/toast
import { useState, useEffect, createContext, useContext } from "react"

interface ToastProps {
  title?: string
  description?: string
  duration?: number
}

interface ToastContextType {
  toast: (props: ToastProps) => void
  dismissToast: () => void
  toasts: ToastProps[]
}

const ToastContext = createContext<ToastContextType>({
  toast: () => {},
  dismissToast: () => {},
  toasts: [],
})

export function ToastProvider({ children }: { children: React.ReactNode }) {
  const [toasts, setToasts] = useState<ToastProps[]>([])

  const toast = (props: ToastProps) => {
    setToasts((prevToasts) => [...prevToasts, props])
    
    // Auto dismiss after duration
    if (props.duration) {
      setTimeout(() => {
        dismissToast()
      }, props.duration)
    }
  }

  const dismissToast = () => {
    setToasts((prevToasts) => prevToasts.slice(1))
  }

  return (
    <ToastContext.Provider value={{ toast, dismissToast, toasts }}>
      {children}
      {toasts.length > 0 && (
        <div className="fixed bottom-4 right-4 z-50 flex flex-col gap-2">
          {toasts.map((toast, index) => (
            <div
              key={index}
              className="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4 max-w-md"
            >
              {toast.title && (
                <h3 className="font-medium text-gray-900 dark:text-gray-100">{toast.title}</h3>
              )}
              {toast.description && (
                <p className="text-sm text-gray-500 dark:text-gray-400 mt-1">{toast.description}</p>
              )}
            </div>
          ))}
        </div>
      )}
    </ToastContext.Provider>
  )
}

export const useToast = () => {
  const context = useContext(ToastContext)
  if (context === undefined) {
    throw new Error("useToast must be used within a ToastProvider")
  }
  return context
}
