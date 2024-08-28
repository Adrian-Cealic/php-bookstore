const menu = document.querySelector('#menu');
const overlayMenu = document.querySelector('#overlayMenu');
menu.addEventListener('click', () => {
    const currSrc = menu.getAttribute('src');
    if (currSrc.includes('menu.svg')) {
        menu.setAttribute('src', '../assets/close.svg');
        overlayMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
    } else {
        menu.setAttribute('src', '../assets/menu.svg');
        overlayMenu.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
})