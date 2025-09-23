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


document.addEventListener('DOMContentLoaded', function() {
    // Find all main menu items with a dropdown
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        // We only want to add this behavior to links that have a dropdown AND a valid URL
        const isParentLink = toggle.hasAttribute('href') && toggle.getAttribute('href') !== '#';

        if (isParentLink) {
            // On the first click, we want the dropdown to open
            // On the second click, we want to go to the page
            toggle.addEventListener('click', function(e) {
                // Check if the dropdown is currently open
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                // If the dropdown is already open (from a previous click),
                // allow the link to be followed
                if (isExpanded) {
                    return true; // Proceed with the default link action
                }

                // If the dropdown is not open, prevent the default link action
                // and let the dropdown open instead
                e.preventDefault();
            });
        }
    });
});