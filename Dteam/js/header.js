const hed = document.getElementById('header_fixed_jud');
const nav = hed.querySelector('.navbar');
const dNedId = nav.id;

let pos = false;

function navFixed() {
    let result = false;
    if (pos) {
        if(hed.clientHeight > window.scrollY) {
            nav.classList.remove('header_fixed');
            nav.id = dNedId;
            pos = false;
            result = true;
        }
    }else {
        if (hed.clientHeight < window.scrollY) {
            nav.classList.add('header_fixed');
            nav.id = 'nav_min_style';
            pos = true;
        }
    }
    return result;
}

function hedResize() {
    hed.style.height = nav.clientHeight + 'px';
}

window.addEventListener('scroll', function () {
    if (navFixed()) {
        hedResize();
    }
});

window.addEventListener('resize', function () {
    pos = false;
    nav.classList.remove('header_fixed');
    hedResize();
    navFixed();
});

window.addEventListener('DOMContentLoaded', function () {   
    hedResize();
    navFixed();
});