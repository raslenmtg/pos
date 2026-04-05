###Fonctionnalité Inventaire
🎯 Objectif

Mettre en place une fonctionnalité d’inventaire complète permettant aux grossistes, distributeurs et PME tunisiennes de :

-Contrôler leurs stocks réels
-Identifier les écarts (théorique vs réel)
-Ajuster automatiquement les quantités

liste of functions:
0.Create me a submenu called inventaire under product menu
1.Création d’un inventaire
Sélection du dépôt / magasin


2.Saisie des quantités réelles
*Interface rapide (mobile + desktop)
*Recherche par:
-Nom produit
-Code-barres
*recherche par categories ou sous categorie (when i choose a category i want all product of it to be added to list like quick add bulk of products)
*set quantity
*add me button to export the list of selected products in pdf and excel without real quantity so employee can count without bias.





3. Calcul des écarts
Comparaison:
Stock théorique
Stock réel
Calcul automatique:
Écart quantité


4. submit
Génération automatique de mouvements de stock:
create transaction type='stock_adjustment' and adjustment_type='Ajustement' and 
for each changes of quantity create a row in stock_adjustment_lines where quantity equal to diffrence detected (if diffrence is negative set quantity and if positive set negative quantity)




5. Historique des inventaires
Liste des inventaires passés
Filtres:
Date
Dépôt
product

important: no draft no scope. don't add any features respect my word.

very important:Respect design of app. don't make it look diffrent style


