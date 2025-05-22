const navLinks = document.querySelectorAll(".nav-link");
const sections = Array.from(document.querySelectorAll("section"));

// Highlight nav link on scroll
function onScroll() {
  const scrollPos = window.scrollY + 150;

  sections.forEach((section) => {
    if (
      scrollPos >= section.offsetTop &&
      scrollPos < section.offsetTop + section.offsetHeight
    ) {
      navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href").substring(1) === section.id) {
          link.classList.add("active");
        }
      });
    }
  });
}

window.addEventListener("scroll", onScroll);

navLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    const targetId = link.getAttribute("href");
    if (targetId.startsWith("#")) {
      e.preventDefault();
      document.querySelector(targetId).scrollIntoView({ behavior: "smooth" });
    }
  });
});
