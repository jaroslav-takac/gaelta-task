# Zadanie 4 – Krátke otázky

## 1. Klient chce migrovať e-shop zo Shoptetu na Shopify. Aké sú 3 hlavné veci, ktoré musíš vyriešiť technicky ako prvé?

Ako prvé by som riešil migráciu dát, teda produkty, zákazníkov a podľa potreby aj históriu objednávok. Shopify pri migrácii odporúča najprv import obsahu a dát, potom kontrolu produktov po importe a následne nastavenie dopravy, daní, platieb a testovacích objednávok. Tretia kritická vec sú doména a SEO kontinuita, najmä presmerovania starých URL, aby sa nestratila organická návštevnosť.

## 2. Core Web Vitals (LCP) sú na červeno. Čo skontroluješ ako prvé na Shoptet e-shope?

Najprv by som skontroloval hlavný obsah nad zlomom, teda najmä hero banner, veľké obrázky, slider a to, čo je reálne kandidát na Largest Contentful Paint. Potom by som pozrel, či stránku nespomaľujú externé skripty ako GTM, chat widgety, analytika, popupy alebo ťažké doplnky, pretože Shoptet umožňuje vkladať vlastný kód do hlavičky a pätičky. Zároveň by som overil, či sa nenačítava zbytočne veľký CSS/JS balík alebo viacero marketingových skriptov naraz. 

## 3. Kedy by si povedal klientovi „toto na Shoptete natívne nevieš, treba doplnok/custom riešenie“? Daj konkrétny príklad.

Povedal by som to vtedy, keď požiadavka presahuje bežné možnosti administrácie, šablóny alebo jednoduchého vloženia HTML/CSS/JS. Typický príklad je špecifická integrácia na externý systém, vlastná logistická logika alebo nová platobná/dopravná funkcionalita, kde už Shoptet ráta s doplnkom alebo API riešením. Aj dokumentácia pre vývojárov ráta pri platobných a dopravných rozšíreniach s vlastným addon prístupom, nie s natívnym nastavením v bežnej administrácii.

## 4. Klient chce skryť ceny produktov na všetkých stránkach kategórií, ale nie na stránke konkrétneho produktu. Ako by si postupoval/a?

Najprv by som si overil, či to klient potrebuje globálne a dlhodobo, alebo len ako vizuálnu úpravu pre konkrétnu šablónu. Ak ide o zobrazenie len na kategóriách, najjednoduchší postup by bol cez úpravu šablóny / vlastný CSS + prípadne JS zacieliť iba listing produktov na kategórii a skryť tam cenový element, pričom detail produktu by zostal bez zásahu. Takéto úpravy by som nasadzoval cez Admin → Vzhľad a Obsah → Editor → HTML kód, kde sa vkladajú vlastné CSS a JavaScriptové zásahy.

## 5. Potrebuješ spustiť vlastný kód v momente, keď zákazník klikne na tlačidlo „Pridať do košíka“ na Shoptet e-shope. Aký postup by si zvoli/la? Popíš možné spôsoby, ktoré ti napadajú.

Prvá možnosť je naviazať sa na klik udalosti priamo v DOM cez JavaScript listener na tlačidlo „Pridať do košíka“. Druhá, spoľahlivejšia možnosť je sledovať ShoptetDataLayerUpdated a reagovať na zmenu košíka alebo `addToCart` udalosť, pretože dokumentácia priamo uvádza, že dataLayer sa aktualizuje pri zmenách v košíku. Tretia možnosť je použiť oficiálnu funkciu pre pridanie produktu do košíka, ak by som riešil vlastné tlačidlo alebo vlastný prvok mimo štandardného flow.

## 6. Potrebuješ cez Shoptet API získať informácie o stavoch objednávok, platobných metódach a krajinách, ktoré e-shop podporuje. Aký API endpoint by si použil/a a prečo?

Na stavy objednávok by som použil endpoint `/api/eshop?include=orderStatuses`, pretože dokumentácia ho uvádza priamo ako zdroj zoznamu stavov objednávok. Pri platobných metódach by som podľa potreby pracoval s endpointmi pre payment methods / payment gateways, keďže Shoptet ich rieši samostatne v API dokumentácii. Pri krajinách a ďalších základných informáciách o e-shope by som sa pozeral na E-shop info endpoint, lebo práve ten slúži na získanie konfiguračných údajov o obchode.

## 7. Klient predáva v SK, CZ a HU — chce jeden admin, tri frontendy s rôznymi cenami a jazykmi. Ako to riešiš na platforme (WordPress, Upgates, Shoptet, Shopify) a kde sú limity?

Na Shopify by som sa pozeral primárne na Markets, pretože umožňujú spravovať viac trhov z jedného adminu, nastavovať jazyky a lokálne meny a pri aktívnych marketoch aj fixné ceny pre jednotlivé krajiny. Na Shoptete vieme v jednej administrácii riešiť jazykové mutácie, ale je potrebné myslieť na doplnky a limity platformy pri pokročilejšom medzinárodnom nastavení. Na WooCommerce/WordPress sa to dá postaviť, ale typicky cez kombináciu pluginov pre multilingual a multicurrency, napríklad WPML + WooCommerce Multilingual, čo je flexibilné, ale zároveň viac závislé od ekosystému pluginov. Pri všetkých platformách by som klientovi vopred povedal, že treba odlíšiť „viac jazykov a mien“ od skutočne odlišnej obchodnej logiky, cien, feedov, skladov a SEO štruktúry pre každý trh.