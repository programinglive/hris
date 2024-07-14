document.querySelectorAll("[data-toast]").forEach(function (element) {
    element.addEventListener("click", function () {
        var toastData = {};
        if (element.attributes["data-toast-text"]) {
            toastData.text = element.attributes["data-toast-text"].value.toString();
        }
        if (element.attributes["data-toast-gravity"]) {
            toastData.gravity = element.attributes["data-toast-gravity"].value.toString();
        }
        if (element.attributes["data-toast-position"]) {
            toastData.position = element.attributes["data-toast-position"].value.toString();
        }
        if (element.attributes["data-toast-className"]) {
            toastData.className = element.attributes["data-toast-className"].value.toString();
        }
        if (element.attributes["data-toast-duration"]) {
            toastData.duration = element.attributes["data-toast-duration"].value.toString();
        }
        if (element.attributes["data-toast-close"]) {
            toastData.close = element.attributes["data-toast-close"].value.toString();
        }
        if (element.attributes["data-toast-style"]) {
            toastData.style = element.attributes["data-toast-style"].value.toString();
        }
        if (element.attributes["data-toast-offset"]) {
            toastData.offset = element.attributes["data-toast-offset"];
        }
        Toastify({
            newWindow: true,
            text: toastData.text,
            gravity: toastData.gravity,
            position: toastData.position,
            className: "bg-" + toastData.className,
            stopOnFocus: true,
            offset: {
                x: toastData.offset ? 50 : 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: toastData.offset ? 10 : 0, // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            duration: toastData.duration,
            close: toastData.close == "close" ? true : false,
        }).showToast();
    });
});