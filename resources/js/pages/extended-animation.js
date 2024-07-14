


function testAnim(x) {
    const sandbox = document.querySelector('#animationSandbox');
    sandbox.classList.add(x, 'animated');
    sandbox.addEventListener('animationend', () => {
        sandbox.classList.remove(x, 'animated');
    }, { once: true });
}

document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.querySelector('.js--triggerAnimation');
    const animations = document.querySelector('.js--animations');

    trigger.addEventListener('click', (e) => {
        e.preventDefault();
        const anim = animations.value;
        testAnim(anim);
    });

    animations.addEventListener('change', () => {
        const anim = animations.value;
        testAnim(anim);
    });
});