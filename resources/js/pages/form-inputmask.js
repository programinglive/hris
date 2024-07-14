import Inputmask from 'inputmask'

document.querySelectorAll('[data-toggle="input-mask"]').forEach(e => {
    const maskFormat = e.getAttribute('data-mask-format').toString().replaceAll('0', '9');
    e.setAttribute("data-mask-format", maskFormat);
    const im = new Inputmask(maskFormat);
    im.mask(e);
});