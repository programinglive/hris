import Plyr from "plyr"
window.Plyr = Plyr;

// youtube
document.addEventListener("DOMContentLoaded", function () {
    window.Plyr && (new Plyr('#player-youtube'));
});

// vimeo
document.addEventListener("DOMContentLoaded", function () {
    window.Plyr && (new Plyr('#player-charlotte'));
});
