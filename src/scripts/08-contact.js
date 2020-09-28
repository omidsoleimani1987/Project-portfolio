const contactForm = document.querySelector('.contact__form');

const sendContactForm = (method, url, data) => {
  return fetch(url, {
    method: method,
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then((response) => {
      if (response.status >= 200 && response.status < 300) {
        return response.json();
      } else {
        return response.json().then((error) => {
          showResultModal(false, error);
          throw new Error('Server-side problem!');
        });
      }
    })
    .catch((error) => {
      showResultModal(false, error);
      throw new Error('Something went wrong!');
    });
};

contactForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const userName = document.getElementById('contact-name').value;
  const userEmail = document.getElementById('contact-email').value;
  const userMessage = document.getElementById('contact-message').value;

  const userInfo = {
    name: userName,
    email: userEmail,
    message: userMessage
  };

  const url = 'https://www.omid-soleimani.com/api/contact.php';
  try {
    sendContactForm('POST', url, userInfo)
      .then((response) => {
        if (response.status == 'success') {
          showResultModal(true, 'your message is sent.');
        } else {
          showResultModal(false, response.status);
        }
      })
      .catch((error) => {
        showResultModal(false, error);
      });
  } catch (error) {
    showResultModal(false, error.message);
  }
});
