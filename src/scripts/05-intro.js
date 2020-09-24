const introElement = document.querySelector('.landing__intro');

introElement.addEventListener('mouseover', (e) => {
  if (e.target.tagName == 'P') {
    e.target.classList.add('beat-animation');

    setTimeout(() => {
      e.target.classList.remove('beat-animation');
    }, 800);
  }
});
