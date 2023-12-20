var open = false;

function toggleNav() {
    open = !open;

    if (open) {
        document.getElementById("mysidebar").style.width = "250px";
        document.querySelectorAll(".menus").style.marginLeft = "0rem";
    } else {
        document.getElementById("mysidebar").style.width = "0";
        document.querySelectorAll(".menus").style.marginLeft = "4rem";
    }

}