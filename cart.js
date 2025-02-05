let inputs = document.querySelectorAll('[data-input]');
let selects = document.querySelectorAll('[data-select]');

inputs.forEach(input => {
  input.addEventListener('input', () => {
    let value = input.value;
    let id = input.getAttribute('data-cart-id');
    fetch('update.php?id=' + id + '&value=' + value + '&type=quantity', {
      method: 'POST'
    }).then(response => {
      return response.json();
    }).then(data => {
      if (data.success) {
        window.location.reload();
      } else {
        console.error("Something went wrong!");
      }
    });
  });
});

selects.forEach(select => {
  select.addEventListener('change', () => {
    let value = select.value;
    let id = select.getAttribute('data-cart-id');
    fetch('update.php?id=' + id + '&value=' + value + '&type=size', {
      method: 'POST'
    }).then(response => {
      return response.json();
    }).then(data => {
      if (data.success) {
        window.location.reload();
      } else {
        console.error("Something went wrong!");
      }
    });
  });
});