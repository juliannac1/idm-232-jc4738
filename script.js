document.addEventListener('DOMContentLoaded', () => {
  const filterBtn = document.getElementById('filterBtn');
  const filterPopup = document.getElementById('filterPopup');
  const closePopup = document.getElementById('closePopup');

  if (!filterBtn || !filterPopup || !closePopup) return;

  filterBtn.addEventListener('click', () => {
      filterPopup.classList.add('show');
  });

  closePopup.addEventListener('click', () => {
      filterPopup.classList.remove('show');
  });

  window.addEventListener('click', (e) => {
      if (e.target === filterPopup) {
          filterPopup.classList.remove('show');
      }
  });
});
