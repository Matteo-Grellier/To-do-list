# To-do-list

## Setup

Afin de faire fonctionner le projet, il faut :

- utiliser un serveur Apache (LAMP, MAMP, WAMP, XAMPP).
- autoriser le module de rewrite (mod_rewrite) : tutoriel pour WAMP et XAMPP [ici](https://waytolearnx.com/2019/07/comment-activer-lurl-rewriting-sous-wamp-et-xampp.html).
- en fonction du système choisi, il faudra configurer le projet (le placer au bon endroit dans les fichiers, etc...)

Dans notre cas, on a utilisé XAMPP, donc il faut :
- Suivre l'installation de XAMPP
- Placer le projet dans le dossier `xampp/htdocs` (Vous pouvez le mettre dans un sous-dossier de ``htdocs``, mais il faudra donc adapter l'adresse de l'URL qui est mise ci-dessous).
- autoriser le module de rewrite (mod_rewrite) : tutoriel pour XAMPP [ici](https://waytolearnx.com/2019/07/comment-activer-lurl-rewriting-sous-wamp-et-xampp.html).
- Lancer le serveur Apache, en appuyant sur *Start*.
- Le projet devrait se lancer sur [http://localhost/Projets/To-do-list/login](http://localhost/Projets/To-do-list/login) (Sauf si vous avez changé le dossier du projet : nom, emplacement, etc...).