/*-------------------------------
------- separate button to scroll to top
-------------------------------*/

// just for desktop screen size
const separateButton = document.querySelector('.scroll-to-top');

document.addEventListener('scroll', () => {
  const htmlScrollHeight = document.documentElement.scrollTop;
  if (htmlScrollHeight > 1200) {
    separateButton.style.opacity = 1;
  } else {
    separateButton.style.display = 'flex';
    separateButton.style.opacity = 0;
  }
});

separateButton.addEventListener('click', () => {
  window.scrollTo(0, 0);
});

/*-------------------------------
------- result modal
-------------------------------*/
const resultModal = document.querySelector('.result');
const successIcon = document.getElementById('success');
const failureIcon = document.getElementById('failure');
const resultMessage = document.getElementById('result-message');

const showResultModal = (status, message) => {
  if (status == true) {
    successIcon.style.display = 'block';
    failureIcon.style.display = 'none';
  } else if (status == false) {
    successIcon.style.display = 'none';
    failureIcon.style.display = 'block';
  }

  resultMessage.textContent = message;
  resultModal.classList.add('show-result');

  setTimeout(() => {
    resultModal.classList.remove('show-result');
    successIcon.style.display = 'none';
    failureIcon.style.display = 'none';
    resultMessage.textContent = '';
  }, 2000);
};
