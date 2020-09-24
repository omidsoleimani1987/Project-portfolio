const menuIcon = document.querySelector('.navigation__icon');

const toggleNavigation = () => {
  const navigationList = document.querySelector('.navigation__items');

  navigationList.classList.toggle('open-navigation-list');
};
menuIcon.addEventListener('click', toggleNavigation);
