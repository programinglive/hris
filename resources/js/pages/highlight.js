import 'prismjs';
import 'prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js';
import ClipboardJS from 'clipboard/dist/clipboard.min.js';

let elements = document.querySelectorAll('[data-clipboard-action="copy"]');
for (var i = 0; i < elements.length; i++) {
    let element = null;
    var clipboard = new ClipboardJS(elements[i], {
        target: function (trigger) {
            // console.info(trigger.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.language-html'));
            element = trigger.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.hidden');
            if (element) {
                element.classList.remove('hidden')
            }
            return trigger.parentElement.parentElement.parentElement.nextElementSibling.querySelector('.language-html')

        }
    });

    clipboard.on('success', function (e) {
        var caption = e.trigger.innerHTML;
        if (element) {
            element.classList.add('hidden')
        }
        let text = e.trigger.querySelector('span')
        text.innerHTML = 'Copied';
        e.clearSelection();

        setTimeout(function () {
            e.trigger.innerHTML = caption;
        }, 2000);
    });
}

Prism.plugins.NormalizeWhitespace.setDefaults({
    'remove-trailing': true,
    'remove-indent': true,
    'left-trim': true,
    'right-trim': true,
});