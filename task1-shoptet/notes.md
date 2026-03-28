# Zadanie 1 – Shoptet šablóna – úprava komponentu

Riešenie som pripravil ako izolovaný HTML/CSS/JS snippet, keďže zadanie výslovne uvádza, že nie je nutné mať celý Shoptet lokálne.

## Čo riešenie robí

1. Zobrazí badge „Novinka“ pre produkty pridané za posledných 30 dní
2. Pod cenou zobrazí text „🚚 Doprava zadarmo nad 50 €“, ale len ak je cena produktu nižšia ako 50 €
3. Tlačidlo „Pridať do košíka“ zobrazí až po hoveri na produktovej karte

## Kam by som kód umiestnil v Shoptete

V Shoptete by som riešenie nasadil cez:

**Admin → Vzhľad a Obsah → Editor → HTML kód**

- CSS by som vložil do sekcie hlavičky, prípadne načítal ako externý stylesheet
- JavaScript by som vložil ideálne do sekcie pätičky, aby sa spúšťal po načítaní obsahu
- HTML markup by som napojil na existujúcu štruktúru produktovej karty v kategórii, resp. upravil príslušný prvok cez vložený kód alebo šablónové rozšírenie podľa možností projektu

## Poznámka k praxi

V reálnom Shoptet projekte by som sa snažil napojiť na reálne dáta produktu dostupné v šablóne alebo DOM štruktúre produktovej karty, aby sa:
- dátum vytvorenia produktu nebral z testovacieho atribútu, ale z dostupných dát produktu
- cena načítala z reálnej ceny na karte
- riešenie fungovalo aj po dynamickom prekreslení listingu