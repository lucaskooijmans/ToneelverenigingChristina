function toggleNavbar() {
  var x = document.querySelector(".links");
  if(x.getAttribute("data-visible") === "true") {
    x.setAttribute("data-visible", "false");
  } else {
    x.setAttribute("data-visible", "true");
  }
}