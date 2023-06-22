const hed = document.getElementById('header_fixed_jud');
const nav = hed.querySelector('.navbar');

let pos = false;

function hedFixed() {
    let result = false;
    if (pos) {
        if(hed.clientHeight > window.scrollY) {
            nav.classList.remove('header_fixed');
            nav.id = 'nav_style';
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

window.addEventListener('scroll',function(){
    if (hedFixed()) {
        hed.style.height = nav.clientHeight + 'px';
    }
});

window.addEventListener('resize', function () {
    pos = false;
    nav.classList.remove('header_fixed');
    hed.style.height = nav.clientHeight + 'px';
    hedFixed();
});

window.addEventListener('DOMContentLoaded', function () {   
    hed.style.height = nav.clientHeight + 'px';
    hedFixed();
});