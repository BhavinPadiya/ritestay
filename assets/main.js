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

document.addEventListener('DOMContentLoaded', function() {
    
    // The main container that holds our booking form.
    const bookingFormWrapper = document.querySelector('.booking-form-wrapper');

    // Safely exit if this page doesn't have the booking form.
    if (!bookingFormWrapper) {
        return;
    }
    
    // Get the site title from the localized data (defaults to a safe string if not found)
    const siteName = (typeof ritestayData !== 'undefined' && ritestayData.siteTitle) ? ritestayData.siteTitle : 'The Accommodation';

    // --- Dynamically Find the Booking Form ID (Same logic as before) ---
    const cf7FormElement = bookingFormWrapper.querySelector('div.wpcf7');
    let bookingFormId = null;

    if (cf7FormElement) {
        const formIdAttribute = cf7FormElement.id;
        const match = formIdAttribute.match(/wpcf7-f(\d+)/);
        if (match && match[1]) {
            bookingFormId = parseInt(match[1], 10);
        }
    }
    
    if (!bookingFormId) {
        console.error('Could not find Contact Form 7 ID. The booking confirmation will not work.');
        return;
    }

    // Listen for the custom event fired by Contact Form 7 after a successful submission.
    document.addEventListener('wpcf7mailsent', function(event) {
        
        // Check if the successful submission came from the correct Booking Form.
        if (event.detail.contactFormId === bookingFormId) {
            
            console.log('Booking form submitted successfully! Displaying custom confirmation...');

            // --- Custom Confirmation Content (uses Bootstrap classes and dynamic siteName) ---
            const confirmationHTML = `
                <div class="alert alert-success p-5 text-center" role="alert">
                    <h4 class="alert-heading display-4 fw-bold">✅ Booking Request Sent!</h4>
                    <p class="lead">Thank you for choosing ${siteName}. Your reservation request has been successfully received.</p>
                    <hr>
                    <p class="mb-0 text-muted">
                        <strong>What happens next?</strong><br>
                        Our team will verify the availability of your chosen room and dates. You will receive a personal confirmation email or phone call within 24 hours.
                    </p>
                    <p class="mt-3">
                        <strong>Your room will be held for you, and payment will be settled upon check-in.</strong>
                    </p>
                </div>
            `;

            // Replace the entire form wrapper's content with the new HTML.
            bookingFormWrapper.innerHTML = confirmationHTML;
        }
    }, false);
});

// --- Start Date Picker Dependency Logic ---
jQuery(document).ready(function($) {
    
    // 1. Get the date input fields using their CF7 names (from your form code)
    const $checkInDate = $('input[name="check-in-date"]');
    const $checkOutDate = $('input[name="check-out-date"]');

    // Ensure both fields exist on the page before attaching events
    if ($checkInDate.length && $checkOutDate.length) {

        // Function to update the minimum date for the Check-out picker
        function updateCheckOutMinDate() {
            const checkInValue = $checkInDate.val();
            
            // Check if a valid date has been selected
            if (checkInValue) {
                // Set the 'min' attribute of the Check-out field to the Check-in date
                $checkOutDate.attr('min', checkInValue);

                // Optional: If the current Check-out date is before the new Check-in date, clear it.
                if ($checkOutDate.val() && $checkOutDate.val() < checkInValue) {
                    $checkOutDate.val('');
                }
            }
        }

        // 2. Attach the update function to the 'change' event of the Check-in field
        $checkInDate.on('change', updateCheckOutMinDate);

        // 3. Run the function once on load, in case the user reloads the page with dates pre-filled
        updateCheckOutMinDate();
    }

});
// --- End Date Picker Dependency Logic ---