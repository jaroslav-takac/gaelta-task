# Zadanie 5 – Platformové znalosti

## 1. WordPress / WooCommerce

Vo WooCommerce by som to riešil najjednoduchšie priamo na serverovej strane pri renderovaní košíka. Každá položka v košíku má väzbu na `WC_Product`, kde viem získať bežnú cenu cez `get_regular_price()`, akciovú cenu cez `get_sale_price()` a aktuálnu cenu cez `get_price()`. Najpraktickejšie by bolo vypísať si pri každej položke do HTML vlastné `data-` atribúty, napríklad `data-regular-price` a `data-sale-price`, a potom ich v custom skripte porovnať. Ak je produkt v akcii, zobrazím pri ňom upozornenie v košíku.

## 2. Shoptet

Na Shoptete by som najprv využil to, čo je dostupné natívne v JavaScripte. Shoptet má `getShoptetDataLayer()` helper a zároveň event `ShoptetDataLayerUpdated`, ktorý sa spúšťa po aktualizácii dataLayer; pri zmenách košíka sa v dataLayer aktualizujú atribúty produktu vrátane `price` a `quantity`. Keďže oficiálny dataLayer podľa dokumentácie poskytuje pri položkách košíka aktuálnu cenu, ale nie výslovne bežnú preškrtnutú cenu, najjednoduchší postup by bol zobrazenú akciovú cenu zobrať z dataLayer a bežnú cenu načítať z DOM, ak ju šablóna na košíku zobrazuje. Ak by šablóna bežnú cenu v košíku vôbec nevypisovala, doplnil by som si ju do markup-u vlastným HTML/CSS/JS zásahom v Shoptete a potom by ju custom skript porovnával.

## 3. Upgates

V Upgates by som to riešil cez natívne JavaScript eventy a dáta košíka. Dokumentácia uvádza, že viem reagovať na udalosti ako `cart.add` a zároveň sú k dispozícii dynamickí zástupcovia `upgates.cart.products[]`, kde má každá položka cenu vo forme `price.withVat` a `price.withoutVat`. Na samotnej stránke košíka viem navyše cieliť logiku len pre cart krok, keďže dokumentácia ukazuje použitie `upgates.on('page.view', ...)` s kontrolou `upgates.pageType === 'order.cart'`. Ak by som potreboval aj bežnú cenu a nebola by dostupná priamo v cart dátach, najjednoduchšie by bolo doplniť ju do šablóny košíka ako `data-regular-price`, pretože Upgates má samostatnú cart šablónu `/Order/cart.phtml`; potom by custom skript len porovnal bežnú a aktuálnu cenu a zobrazil upozornenie pri zlacnených položkách.