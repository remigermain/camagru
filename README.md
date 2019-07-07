# Camagru  WIP

<img src="/readme_img/img.png" />
<img src="/readme_img/img1.png" />

## [1]  Partie commune

Vous devez donc réaliser une application web. Bien que ce n’est pas obligatoire, nousvous conseillons de structurer votre application (en MVC, par exemple).Votre site devra avoir une mise en page décente (c’est à dire au moins un header, unesection principale et un footer), être présentable sur mobile, et avoir un comportementet un layout adaptés sur de petites résolutions (votre navigateur peut simuler ce mode,oui oui...).Tous vos formulaires doivent avoir des validations correctes, et l’ensemble de votre sitedevra être sécurisé. Ce point est OBLIGATOIRE et sera vérifié longuement en soute-nance. Pour vous faire une petite idée, voici quelques éléments qui ne sont pas considéréscomme sécurisés :


`•Avoir des mots de passe “en clair” dans une base de données.`

`•Pouvoir injecter du code HTML ou JavaScript “utilisateur” dans des variables malprotégées.`

`•Pouvoir uploader du contenu indésirable.`

`•Pouvoir modifier une requête SQL.`

`•Utiliser un formulaire externe au site pour modifier du contenu dit-protégé.`



## [2]  Partie utilisateur

•L’application doit permettre à un utilisateur de s’inscrire, en demandant au mini-mum une adresse email, un nom d’utilisateur et un mot de passe un tant soit peusécurisé.

•L’utilisateur doit confirmer son compte via un lien unique envoyé par mail, àl’adresse renseigné dans le formulaire d’inscription.

•L’utilisateur doit ensuite être capable de se connecter avec son nom d’utilisateuret son mot de passe. Il doit également pouvoir recevoir un mail de réinitialisationde son mot de passe en cas d’oubli.

•L’utilisateur doit pouvoir se déconnecter en un seul clic depuis n’importe quellepage du site.

•Une fois connecté, l’utilisateur aura possibilité de modifier son nom d’utilisateur,son adresse mail et son mot de passe.



## [3]  Partie galerie

•La galerie devra être publique, donc accessible sans authentification. Elle doit af-ficher l’intégralité des images prises par les membres du site, triées par date decréation. Elle doit pouvoir permettre à l’utilisateur de les commenter et de lesliker si celui-ci est authentifié.

•Lorsque une image reçoit un nouveau commentaire, l’auteur de cette image doiten être informé par mail. Cette préférence est activée par défaut, mais peut êtredésactivée dans les préférences de l’utilisateur.

•La liste des images doit être paginée, avec au moins 5 éléments par page


## [4]  Partie montage

Cette partie ne doit être accessible qu’aux utilisateurs connectés, et rejeter polimentl’internaute1dans le cas contraire.Cette page devra etre composée de deux sections :

•Une section principale, contenant l’apercu de votre webcam, la liste des imagessuperposables disponibles et un bouton permettant de prendre la photo.

•Une section latérale, affichant les miniatures de toutes les photos prises précedem-ment.Votre mise en page doit donc normalement ressembler à la Figure V.1.

•Les images superposables doivent être sélectionnables, et le bouton permettant deprendre la photo ne doit pas être cliquable tant qu’aucune image n’est sélectionnée.

•Le traitement de l’image finale (donc entre autres la superposition des deux images)doit être fait coté serveur, en PHP.

•Parce que tout le monde n’a pas de webcam, vous devez laisser la possibilitéd’uploader une image au lieu de la prendre depuis la caméra.

•L’utilisateur doit pouvoir supprimer ses montages, et uniquement les siens.


## [5] Contraintes et Obligations

Pour résumer, votre super application devra respecter les choix technologiques sui-vants :

•Langages autorisés :

> ◦[Serveur]PHP

> ◦[Client]HTML - CSS - JavaScript (restreints aux API natives des navigateurs) 

•Framework autorisés :

> ◦[Serveur]Aucun

> ◦[Client]Frameworks CSS tolérés, tant que ca rajoute pas du JavaScript.

En plus de cela, votre projet doit comporter impérativement :
•Un fichierindex.php, contenant le point d’entrée de votre site, et situé à la racinede votre arborescence.

•Un fichierconfig/setup.php, capable de créer ou recréer le schéma de la base dedonnées, en utilisant les infos contenues dans le fichierconfig/database.php.

•Un fichierconfig/database.php, contenant la configuration de votre base dedonnées qui sera instanciée viaPDOau format suivant :
```
$> cat config/database.php
<?php
        $DB_DSN = ...;
        $DB_USER = ...;
        $DB_PASSWORD = ...
```

LeDSN(Data Source Name) contient les informations requises pour se connecter à labase, par exemple’mysql:dbname=testdb;host=127.0.0.1’. En général, un DSN estconstitué du nom du pilote PDO, suivi d’une syntaxe spécifique au pilote. Plus de détailssont disponibles dans la documentation PDO de chaque pilote2.



•Un fichierconfig/database.php, contenant la configuration de votre base dedonnées qui sera instanciée viaPDOau format suivant :
