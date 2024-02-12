function toggleMenu() {
  var menu = document.querySelector('.menu');
  var menuToggle = document.querySelector('.menu-toggle');

  if (menu.style.left === '-250px' || menu.style.left === '') {
      menu.style.left = '0';
  } else {
      menu.style.left = '-250px';
  }
}

    