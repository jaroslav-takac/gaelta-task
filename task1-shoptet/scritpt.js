document.addEventListener('DOMContentLoaded', function () {
  const productCards = document.querySelectorAll('.js-product-card');
  const now = new Date();
  const THIRTY_DAYS_IN_MS = 30 * 24 * 60 * 60 * 1000;

  productCards.forEach(function (card) {
    const createdAt = card.dataset.createdAt;
    const price = parseFloat(card.dataset.price);
    const newBadge = card.querySelector('.js-new-badge');
    const shippingNote = card.querySelector('.js-shipping-note');

    if (createdAt && newBadge) {
      const createdDate = new Date(createdAt);
      const isNew = now - createdDate <= THIRTY_DAYS_IN_MS;

      if (isNew) {
        newBadge.hidden = false;
      }
    }

    if (!Number.isNaN(price) && price < 50 && shippingNote) {
      shippingNote.hidden = false;
    }
  });
});