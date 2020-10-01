const menuIcon = document.querySelector('.navigation__icon');
const navigationList = document.querySelector('.navigation__items');

const toggleNavigation = () => {
  navigationList.classList.toggle('open-navigation-list');
};
menuIcon.addEventListener('click', toggleNavigation);

navigationList.addEventListener('click', (e) => {
  if (e.target.tagName == 'A') {
    toggleNavigation();
  }
});
