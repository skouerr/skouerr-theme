import './documentation.style.scss'

document.addEventListener('DOMContentLoaded', () => {
    const blockDocumentation = document.querySelectorAll('.block-documentation')
    blockDocumentation.forEach((block) => {
        console.log('Block',block)
        handleBlockDocumentation(block)
    })

    const code = document.querySelectorAll('pre code')
    code.forEach((block) => {
        handleCodeBlock(block)
    })
   
    hljs.highlightAll();
})

const handleBlockDocumentation = (block) => {

    const navigation = block.querySelector('.navigation')
    const content = block.querySelector('.content')
    const titlesInContent = content.querySelectorAll('h1, h2')
    const navigationItems = navigation.querySelectorAll('a')

    document.addEventListener('scroll', () => {

        const scrollPosition = window.scrollY
        let currentTitle = null

        titlesInContent.forEach((title) => {
            if (title.offsetTop <= scrollPosition + 200) {
                currentTitle = title.textContent
            }
        })

        const currentAnchor = navigation.querySelector('a[data-title="'+currentTitle+'"]')

        navigationItems.forEach((item) => {
            item?.classList?.remove('active')
        })
        currentAnchor?.classList?.add('active')

        const sanitizedTitle = currentTitle.replace(/ /g, '-').toLowerCase()
        window.history.pushState(null, null, '#'+sanitizedTitle)
    })

    navigationItems.forEach((item)=>{
        console.log('navigation items',item)
        item.addEventListener('click', (event) => {
            event.preventDefault()
            const title = event.target.getAttribute('data-title')
            const element = Array.from(titlesInContent).find((titleElement) => titleElement.textContent === title)
            window.scrollTo({
                top: element.offsetTop - 40,
                behavior: 'smooth'
            })
            navigationItems.forEach((item) => {
                item?.classList?.remove('active')
            })
            item.classList?.add('active')

        })
    })







}

const handleCodeBlock = (block) => {
   block.addEventListener('click', (event) => {
         const range = document.createRange()
         range.selectNodeContents(block)
         const selection = window.getSelection()
         selection.removeAllRanges()
         selection.addRange(range)
         document.execCommand('copy')
         selection.removeAllRanges()
    
         const tooltip = document.createElement('div')
         tooltip.classList.add('tooltip')
         tooltip.textContent = 'Copied!'
         block.appendChild(tooltip)
    
         setTimeout(() => {
            block.removeChild(tooltip)
         }, 1000)
   })
}