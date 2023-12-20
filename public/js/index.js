var open = false;

function toggleNav() {
  open = !open;

  if (!open) {
    document.getElementById("mysidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  } else {
    document.getElementById("mysidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
}