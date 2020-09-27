const copyrightElement = document.getElementById('copyright');
const year = new Date().getFullYear();
if (year > 2020) {
  const currentYear = new Date().getFullYear().toString();
  copyrightElement.textContent = ' - ' + currentYear;
}
