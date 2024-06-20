function toggleNavbar() {
  var x = document.querySelector(".links");
  if (x.getAttribute("data-visible") === "true") {
    x.setAttribute("data-visible", "false");
  } else {
    x.setAttribute("data-visible", "true");
  }
}

// If user clicks outside of the navbar, close it
document.addEventListener("click", function (event) {
  if (event.target.closest("nav") === null) {
    var x = document.querySelector(".links");
    x.setAttribute("data-visible", "false");
  }
});

const linkCategories = document.querySelectorAll(".link-category");
var delay = 200;
linkCategories.forEach(linkCategory => {
  linkCategory.style.transitionDelay = `${delay}ms`;
  delay += 100;
});

function acceptCookies() {
  document.cookie = "cookies_accepted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
  document.querySelector(".cookies").style.display = "none";
}

if (document.cookie.includes("cookies_accepted=true")) {
  document.querySelector(".cookies").style.display = "none";
}