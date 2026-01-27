(function () {
  // AOS init (safe)
  try {
    if (window.AOS) {
      AOS.init({ duration: 500, easing: "ease-out", once: true });
    }
  } catch (e) {}

  const sidebar = document.getElementById("adminSidebar");
  const toggleBtn = document.getElementById("sidebarToggle");

  // Create overlay for mobile
  let overlay = document.querySelector(".admin-overlay");
  if (!overlay) {
    overlay = document.createElement("div");
    overlay.className = "admin-overlay";
    document.body.appendChild(overlay);
  }

  function openSidebar() {
    sidebar?.classList.add("is-open");
    overlay?.classList.add("is-open");
  }

  function closeSidebar() {
    sidebar?.classList.remove("is-open");
    overlay?.classList.remove("is-open");
  }

  toggleBtn?.addEventListener("click", function () {
    if (!sidebar) return;
    sidebar.classList.contains("is-open") ? closeSidebar() : openSidebar();
  });

  overlay?.addEventListener("click", closeSidebar);

  // Close sidebar on nav click (mobile only)
  document.querySelectorAll("#adminSidebar .nav-link").forEach((a) => {
    a.addEventListener("click", () => {
      if (window.innerWidth < 992) closeSidebar();
    });
  });
})();
