document.documentElement.classList.add("js-enabled");

// Dropdown toggle
document.addEventListener("DOMContentLoaded", function () {
  const dropdownBtn = document.getElementById("productsDropdown");
  const dropdownMenu = document.querySelector(".dropdown-menu");

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener("click", function (e) {
      e.preventDefault();
      dropdownMenu.classList.toggle("hidden");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
      if (!e.target.closest(".dropdown-container")) {
        dropdownMenu.classList.add("hidden");
      }
    });
  }

  // Contact form handler
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerHTML;
      const formData = new FormData(contactForm);

      // Disable button and show loading state
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'SENDING...';

      // Send form data via fetch
      fetch('send-email.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Show success message
          showMessage(data.message, 'success');
          contactForm.reset();
        } else {
          // Show error message
          showMessage(data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showMessage('Sorry, there was an error sending your message. Please try again later.', 'error');
      })
      .finally(() => {
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
      });
    });
  }

  // Helper function to show messages
  function showMessage(message, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `fixed top-8 right-8 z-50 px-6 py-4 text-sm border backdrop-blur-xl animate-fade-in ${
      type === 'success' 
        ? 'bg-green-900/80 border-green-500/50 text-green-100' 
        : 'bg-red-900/80 border-red-500/50 text-red-100'
    }`;
    messageDiv.textContent = message;
    
    document.body.appendChild(messageDiv);

    // Auto remove after 5 seconds
    setTimeout(() => {
      messageDiv.style.opacity = '0';
      messageDiv.style.transition = 'opacity 0.3s ease';
      setTimeout(() => messageDiv.remove(), 300);
    }, 5000);
  }
});
