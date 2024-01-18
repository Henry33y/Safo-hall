const hamburgerBtn = document.querySelector('.hamburger-btn');
const mobileNav = document.querySelector('.mobile-nav-container');

hamburgerBtn.addEventListener('click',()=>{
    hamburgerBtn.classList.toggle('clicked');
    if(hamburgerBtn.classList.contains('clicked')){
        mobileNav.style.display = 'flex';
    }
    else{
        mobileNav.style.display = 'none';

    }
})