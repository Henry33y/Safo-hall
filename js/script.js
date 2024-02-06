const hamburgerBtn = document.querySelector('.hamburger-btn');
const mobileNavContainer = document.querySelector('.mobile-nav-container');
const mobileNav = document.querySelector('.mobile-nav');

hamburgerBtn.addEventListener('click',()=>{
    hamburgerBtn.classList.toggle('clicked');
    toggleMobileNavContainer()
})

mobileNavContainer.addEventListener('click', () => {
    if (hamburgerBtn.classList.contains('clicked')) {
        hideMobileNav();
    }
});

mobileNav.addEventListener('click', (e) => {
    // Stop propagation of the click event
    e.stopPropagation();
});

function toggleMobileNavContainer(){
    if(hamburgerBtn.classList.contains('clicked')){
        mobileNavContainer.style.display = 'flex';
    }
    else{
        mobileNavContainer.style.display = 'none';

    }
}
function hideMobileNav(){
    hamburgerBtn.classList.remove('clicked')
    mobileNavContainer.style.display = 'none'
}







