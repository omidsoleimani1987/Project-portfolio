const copyrightElement = document.getElementById('copyright');
const year = new Date().getFullYear();
if (year > 2019) {
  const currentYear = new Date().getFullYear().toString();
  copyrightElement.textContent = currentYear;
}
