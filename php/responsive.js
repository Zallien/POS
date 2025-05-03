
let togglenav = false

const burgernav = document.querySelector(".burgernav")
const navbar = document.querySelector(".nav")


burgernav.addEventListener('click', ()=>{

    if(togglenav === false){
        navbar.classList.add("shownav")
        burgernav.classList.add("burgernavtoshow")
        togglenav = true

        document.body.style.overflow = "hidden"
    }
    else{
        togglenav = false
        navbar.classList.remove("shownav")
        burgernav.classList.remove("burgernavtoshow")

        document.body.style.overflow = "auto"
    }

    
})