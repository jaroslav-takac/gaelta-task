# Zadanie 3 – Debug + optimalizácia

## Nájdné chyby

1. Chýbajúce zátvorky pri `e.preventDefault`

Pôvodný kód:
```js
e.preventDefault;

Problém:
preventDefault je funkcia, ale nebola zavolaná.

Oprava:
e.preventDefault();


2. Použitie .val() v čistom JavaScripte

Pôvodný kód:
const quantity = document.querySelector('#qty-' + productId).val();

Problém:
.val() je metóda z jQuery, nie z čistého JavaScriptu.

Oprava:
const quantity = document.querySelector('#qty-' + productId).value;


Zároveň som doplnil kontrolu, či element existuje:
const quantityInput = document.querySelector('#qty-' + productId);
const quantity = quantityInput ? quantityInput.value : 1;

problém:
ak element neexistuje → crash (Cannot read property 'value' of null)


3. Chýbajúce zátvorky pri response.json

Pôvodný kód:
.then(response => response.json)

Problém:
response.json je funkcia, ale nebola zavolaná.

Oprava:
.then(response => response.json())

