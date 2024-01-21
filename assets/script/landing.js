var navbar = document.getElementById("nav");
window.addEventListener("scroll", function () {
    scrollposition = window.scrollY;
  
    if (scrollposition >= 60) {
        navbar.classList.add("sticky")
    } 
    else if (navbar.className === "topnav responsive") {
        navbar.classList.add("sticky");
    }
    else {
        navbar.classList.remove("sticky");
    }
});