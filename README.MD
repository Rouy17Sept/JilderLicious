
# Projectidee 

Een food order website waarbij je een bestelling kan plaatsen bij een restaurant.
Als eigenaar of medewerker van het restaurant heb je een eigen omgeving waar je de bestellingen en contactformulieren kan beheren.

# Projectbeschrijving
De website is gemaakt met de volgende technieken:

- HTML
- CSS
- JavaScript
- PHP
- MySQL
- Bootstrap

# Projectstructuur

## Klantomgeving

- De klant kan categorieen bekijken en gewenste producten bestellen.
- De klant kan een bestelling plaatsen en een contactformulier invullen.
- Na het plaatsen van een bestelling krijgt de klant een bevestiging toegestuurd per mail.
- Wanneer klant meer dan 3 contactformulieren heeft ingevuld binnen 24 uur krijgt de klant een melding dat hij niet meer formulieren kan invullen.

## Restaurantomgeving

- Admin kan categorieen en producten beheren.
- Admin kan bestellingen en contactformulieren bekijken.
- Admin heeft op het dashboard een overzicht van de bestellingen en contactformulieren. In één oogopslag kan de admin zien welke statussen de orders hebben en waar actie nodig is.
- Admin kan nieuwe users aanmaken en de juiste rol toekennen.

# Verbeterpunten

- SQL normalization
- Admin omgeving meer mobile friendly maken
- Bevestigingsmail beter vormgeven. Nu is het een standaard mail waar tekst in staat, maar misschien met plaatjes erbij.


# Installatie

Om de website te installeren moet je de volgende stappen doorlopen:

1. Download de zip van de repository
2. Pak de zip uit
3. Voer de SQL queries uit in je PHPMyAdmin
4. Pas je localhost gegevens aan in file 'partials/constants.php' en 'admin/partials/constants.php'
5. Open de website in je browser
6. Comment file 'admin/partials/login_check.php' helemaal uit
7. Ga naar SITEURL/admin/manage-user.php
8. Voeg een User toe en wijs de rol van admin toe
9. Comment file 'admin/partials/login_check.php' weer in
10. Ga naar SITEURL/admin/login.php en log in met het account dat je hebt aangemaakt
11. Maak een categorie aan op admin/manage-category.php
12. Maak een product aan op admin/manage-product.php
13. Voeg je eigen email adres toe in file 'process_order.php' op regel 70
14. Speel verder het met project

## LIVE VERSIE
- [JilderLicious](https://jilderlicious.yjilderda.nl)

## Youri Jilderda Portfolio
- [Youri Jilderda](https://yjilderda.nl/)
