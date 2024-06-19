function toggleNavbar() {
  var x = document.querySelector(".links");
  if(x.getAttribute("data-visible") === "true") {
    x.setAttribute("data-visible", "false");
  } else {
    x.setAttribute("data-visible", "true");
  }
}

// If user clicks outside of the navbar, close it
document.addEventListener("click", function(event) {
  if(event.target.closest("nav") === null) {
    var x = document.querySelector(".links");
    x.setAttribute("data-visible", "false");
  }
});