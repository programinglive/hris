import flatpickr from "flatpickr";

// flatpickr

flatpickr('#datepicker-basic', {
    defaultDate: new Date()
});

flatpickr('#datepicker-datetime', {
    enableTime: true,
    dateFormat: "m-d-Y H:i",
    defaultDate: new Date()
});

flatpickr('#datepicker-humanfd', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    defaultDate: new Date()
});

flatpickr('#datepicker-minmax', {
    minDate: "today",
    defaultDate: new Date(),
    maxDate: new Date().fp_incr(14) // 14 days from now
});

flatpickr('#datepicker-disable', {
    onReady: function () {
        this.jumpToDate("2025-01")
    },
    disable: ["2025-01-30", "2025-02-21", "2025-03-08", new Date(2025, 4, 9)],
    dateFormat: "Y-m-d",
    defaultDate: new Date()
});

flatpickr('#datepicker-multiple', {
    mode: "multiple",
    dateFormat: "Y-m-d",
    defaultDate: new Date()
});

flatpickr('#datepicker-range', {
    mode: "range",
    defaultDate: new Date()
});

flatpickr('#datepicker-timepicker', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: new Date()
});

flatpickr('#datepicker-inline', {
    inline: true,
    defaultDate: new Date()
});