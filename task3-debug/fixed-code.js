document.addEventListener('DOMContentLoaded', function () {
  const addToCartBtns = document.querySelectorAll('.btn-add-to-cart');

  addToCartBtns.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      const productId = btn.getAttribute('data-product');
      const quantityInput = document.querySelector('#qty-' + productId);
      const quantity = quantityInput ? quantityInput.value : 1;

      fetch('/api/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          product_id: productId,
          qty: quantity
        })
      })
        .then(response => response.json())
        .then(data => {
          console.log('Pridané do košíka', data);
        })
        .catch(error => {
          console.error('Chyba pri pridávaní do košíka:', error);
        });
    });
  });
});