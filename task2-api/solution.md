# Zadanie 2 – API integrácia

## Navrhovaný postup

Riešenie by som postavil na tomto flowe:

**Shoptet Webhook → vlastný PHP endpoint → Google Sheets API**

1. V Shoptete by som nastavil webhook pre vytvorenie novej objednávky
2. Webhook by odoslal dáta objednávky na môj endpoint
3. Endpoint by payload prijal, validoval a spracoval
4. Zo spracovaných dát by sa vytvoril jeden riadok pre reporting
5. Tento riadok by sa zapísal do Google Sheets

## Aké dáta by som posielal do Google Sheets

Do tabuľky by som posielal najmä:

- ID objednávky
- dátum vytvorenia objednávky
- meno a priezvisko zákazníka
- e-mail
- telefón
- krajinu
- menu
- celkovú sumu
- stav objednávky
- spôsob dopravy
- spôsob platby
- produkty v objednávke
- počet kusov
- poznámku zákazníka alebo internú poznámku, ak je relevantná

Produkty by som zapísal v textovej forme, napríklad:

`Produkt A (2 ks), Produkt B (1 ks)`

## Zvolený prístup

Na toto riešenie by som použil **vlastný PHP endpoint**.

### Prečo:
- je jednoduchý a dobre kontrolovateľný
- viem v ňom spraviť validáciu, logovanie aj ošetrenie chýb
- riešenie je ľahko rozšíriteľné
- pri developerskej pozícii lepšie ukazuje technické myslenie než no-code workflow

## Alternatívy

### Make
Dobrá voľba pre rýchle MVP alebo jednoduché automatizácie bez veľkého vývoja.

### n8n
Dobrá voľba, ak klient chce viac workflowov, vetvenie logiky a väčšiu flexibilitu.

## Poznámka k praxi

V produkcii by som riešil aj:
- overenie, že request skutočne prišiel zo Shoptetu
- logovanie chýb
- ochranu pred duplicitným zápisom objednávky
- retry mechanizmus pri zlyhaní Google Sheets API