(function () {
  // AOS animations
  if (window.AOS) {
    AOS.init({
      duration: 700,
      easing: "ease-out-cubic",
      once: true,
      offset: 14,
    });
  }

  // Sidebar toggle for mobile
  const sidebar = document.getElementById("adminSidebar");
  const toggleBtn = document.getElementById("sidebarToggle");
  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });
  }

  // Confirm delete (any form with data-confirm)
  document.addEventListener("submit", function (e) {
    const form = e.target;
    const msg = form.getAttribute("data-confirm");
    if (msg) {
      const ok = confirm(msg);
      if (!ok) e.preventDefault();
    }
  });

  // Animate counters (elements with data-counter)
  const counters = document.querySelectorAll("[data-counter]");
  const animateCounter = (el) => {
    const target = parseFloat(el.getAttribute("data-counter")) || 0;
    const prefix = el.getAttribute("data-prefix") || "";
    const suffix = el.getAttribute("data-suffix") || "";
    const duration = 850;
    const start = performance.now();

    const step = (now) => {
      const p = Math.min((now - start) / duration, 1);
      const val = target * (0.15 + 0.85 * p);
      const shown = Number.isInteger(target) ? Math.round(val) : val.toFixed(2);
      el.textContent = `${prefix}${shown}${suffix}`;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = `${prefix}${Number.isInteger(target) ? target : target.toFixed(2)}${suffix}`;
    };

    requestAnimationFrame(step);
  };

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          io.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.4 }
  );

  counters.forEach((c) => io.observe(c));
})();
