# Biotech
## Projekt indítása
Húzzuk le a projectet github-ról
```bash
git clone https://github.com/AttilaSzendi/biotech.git
```
Cd-zzünk be a project gyökerébe, majd hozzuk létre a .env fájlt
```bash
cp .env.example .env
```
Következő lépésként húzzuk be a project függőségeit.
```bash
composer install
```
Hozzunk létre egy APP_KEY-t
```bash
php artisan key:generate
```
Állítsuk be az adatbázis adatokat a .env fájlban, majd hozzuk létre a táblákat.
```bash
php artisan migrate --seed
```
Feature teszteket írtam Tag és Product Crud-okra.
Sajnos nem értem a végére így hiányzik a többnyelvű szerkeszthetőség, illetve a tageket nem lehet még a product-okhoz menteni.

