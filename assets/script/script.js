// sidebar
const menu = document.getElementById ('menu-label');
const sidebar = document.getElementsByClassName('sidebar')[0];

menu.addEventListener('click',function() {
    sidebar.classList.toggle('hide');
})


function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}


