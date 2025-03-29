import * as React from "react"
import { format } from "date-fns"
import { CalendarIcon } from "lucide-react"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { Calendar } from "@/components/ui/calendar"
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover"

interface DatePickerProps {
  date: Date | undefined
  onSelect: (date: Date | undefined) => void
  placeholder?: string
  className?: string
  hasError?: boolean
}

export function DatePicker({
  date,
  onSelect,
  placeholder = "Pick a date",
  className,
  hasError = false,
}: DatePickerProps) {
  return (
    <Popover>
      <PopoverTrigger asChild>
        <Button
          variant="outline"
          className={cn(
            "w-full justify-start text-left font-normal",
            !date && "text-muted-foreground",
            hasError && "border-red-500",
            className
          )}
        >
          <CalendarIcon className="mr-2 h-4 w-4" />
          {date ? format(date, "PPP") : <span>{placeholder}</span>}
        </Button>
      </PopoverTrigger>
      <PopoverContent className="w-auto p-0" align="start">
        <Calendar
          mode="single"
          selected={date}
          onSelect={onSelect}
          initialFocus
          className="border rounded-md shadow"
          styles={{
            caption: { display: "flex", justifyContent: "space-between", padding: "0.5rem" },
            caption_label: { fontWeight: 500 },
            nav: { display: "flex", gap: "0.25rem" },
            table: { width: "100%", borderCollapse: "separate", borderSpacing: "0.25rem" },
            head_row: { display: "flex", marginTop: "0.5rem" },
            head_cell: { width: "2.25rem", textAlign: "center", color: "var(--muted-foreground)", fontSize: "0.8rem" },
            row: { display: "flex", width: "100%", marginBottom: "0.25rem" },
            cell: { width: "2.25rem", height: "2.25rem", textAlign: "center", borderRadius: "0.25rem", position: "relative" },
            day: { width: "2.25rem", height: "2.25rem", fontSize: "0.875rem", borderRadius: "0.25rem", padding: 0, margin: 0 },
            day_selected: { backgroundColor: "var(--primary)", color: "var(--primary-foreground)" },
            day_today: { backgroundColor: "var(--accent)", color: "var(--accent-foreground)" }
          }}
        />
      </PopoverContent>
    </Popover>
  )
}
