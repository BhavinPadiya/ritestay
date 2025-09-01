document.addEventListener("DOMContentLoaded", function () {
  // Enable hover/click for submenu items
  document.querySelectorAll(".dropdown-submenu .dropdown-toggle").forEach(function (el) {
    el.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      // Close other open submenus
      el.closest(".dropdown-menu").querySelectorAll(".dropdown-menu.show").forEach(function (submenu) {
        submenu.classList.remove("show");
      });

      // Toggle this submenu
      let submenu = el.nextElementSibling;
      if (submenu) {
        submenu.classList.toggle("show");
      }
    });
  });

  // Close submenu when parent dropdown closes
  document.querySelectorAll(".dropdown").forEach(function (dropdown) {
    dropdown.addEventListener("hidden.bs.dropdown", function () {
      this.querySelectorAll(".dropdown-menu.show").forEach(function (submenu) {
        submenu.classList.remove("show");
      });
    });
  });
});
