window.onscroll = function () {
    maFonction();
};

var navbar = document.getElementById("navbar-primary");

var sticky = navbar.offsetTop;

function maFonction(){
    if(window.pageYOffset >= sticky){
        navbar.classList.add("sticky");
    }else{
        navbar.classList.remove("sticky");
    }
}