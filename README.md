Pensez à configurer la base de donnée.

j'ai mis les sessions en BDD.

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` varchar(255) NOT NULL,
  `session_value` text NOT NULL,
  `session_time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


pour l'installation pensez à créer le schéma :

php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console clear:cache



Au niveau des entités, j'en ai crée 3.

1 - Basket (Le Panier) représentater avec un ID et une SessionID unique.
2 - Product (Les produits) définissant les produits.

On peu ajouter des produits via le crud généré dans /product

3 - ProductInBasket (Les produits dans le panier)

Il y a du soft delete, c'est à dire que je ne supprime pas les entrées vraiment dans Product et ProductInBasket, cela
avoir l'utiliter ensuite de faire des workflow d'ajout au panier et de détecter éventuellement des anomalies.

Voila :)
Amusez vous bien :).
David DJIAN