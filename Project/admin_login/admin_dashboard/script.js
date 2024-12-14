const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
function openDashboard() {
  
  document.getElementById("dashboard-cards").style.display = "block";
  document.getElementById("main-content-frame").src = "";
}

function loadPage(url) {
  
  document.getElementById("dashboard-cards").style.display = "none";
  document.getElementById("main-content-frame").src = url;
}


document.addEventListener("DOMContentLoaded", openDashboard);
