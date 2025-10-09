const filterBtn = document.getElementById('filterBtn');
const filterPopup = document.getElementById('filterPopup');
const closePopup = document.getElementById('closePopup');

// Show popup on Filter button click
filterBtn.addEventListener('click', () => {
  filterPopup.style.display = 'flex';
});

// Close popup on X button click
closePopup.addEventListener('click', () => {
  filterPopup.style.display = 'none';
});

// Close popup if clicking outside the popup content
window.addEventListener('click', (e) => {
  if (e.target === filterPopup) {
    filterPopup.style.display = 'none';
  }
});