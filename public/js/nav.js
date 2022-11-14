const headerLogo = document.getElementsByClassName('header-logo')[0];
const nav = document.getElementsByTagName('nav')[0];

function toggleNav() {
    if (nav.classList.contains('d-none')) {
        nav.classList.remove('d-none');
        nav.classList.add('d-flex');
    }
    else {
        nav.classList.remove('d-flex')
        nav.classList.add('d-none')
    }
}

if (headerLogo) headerLogo.addEventListener('click', toggleNav);