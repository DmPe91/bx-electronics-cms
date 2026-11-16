document.addEventListener("DOMContentLoaded", function () {
  // Мобильное меню
  var burger = document.getElementById("burgerBtn");
  var mobileNav = document.getElementById("mobileNav");

  if (burger && mobileNav) {
    burger.addEventListener("click", function () {
      burger.classList.toggle("active");
      mobileNav.classList.toggle("open");
    });
  }
});
