let isMenuOpen = false;

function toggleMenu() {
  isMenuOpen = !isMenuOpen;
  const navbar = document.getElementById('navbarNav');
  if (isMenuOpen) {
    navbar.classList.add('show');
  } else {
    navbar.classList.remove('show');
  }
}
