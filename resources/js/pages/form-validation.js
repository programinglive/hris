// Form validation
// pristine js validation form

import Pristine from "pristinejs";

const valid_form = document.querySelectorAll(".valid-form");

if (valid_form != null) {
    for (let i = 0; i < valid_form.length; i++) {
        const pristine = new Pristine(valid_form[i]);

        valid_form[i].addEventListener('submit', function (e) {
            e.preventDefault();
            // check if the form is valid
            const valid = pristine.validate(); // returns true or false
        });
    }
}