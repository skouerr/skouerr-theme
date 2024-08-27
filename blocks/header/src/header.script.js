import './header.style.scss'

document.addEventListener('DOMContentLoaded', () => {

    const hamburgerOrClose = document.querySelector('.hamburger')
    const header = document.querySelector('header.section')
    hamburgerOrClose.addEventListener('click', () => {
        header.classList.toggle('is-open')
    })

})