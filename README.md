

MaDocIt
=======



## 1.Installation



[Read the official "Getting Started" guide](https://api-platform.com/docs/distribution).

#### 1.1 GIT Repository


Clôner le repository du projet 

````
$ git clone https://github.com/iracanyes/madocit.git 
$ cd madocit
````

#### 1.1 Configuration de Doctrine pour l'API

 * Modification du fichier de configuration doctrine
    ````
    api/config/packages/doctrine.yaml.dist

    Il faut ajouter le nom d'utilisateur et le mot de passe qui seront 
    utilisé à la création de l'instance docker mysql    
        env(MYSQL_DATABASE): 'dbname'
        env(MYSQL_HOST): 'db'
        env(MYSQL_USER): "username"
        env(MYSQL_PASSWORD): "password"
        env(MYSQL_PORT): '3306'  
    ````    
 * Enregistrer le fichier doctrine.yaml.dist sous le nom de doctrine.yaml

[Voir la page Readme.md du client](https://github.com/iracanyes/madocit/client/README.md)

#### 1.2 Docker & Docker-Compose
 * Installation [Docker](https://docs.docker.com/install/#supported-platforms) pour la gestion des containers de l'application.
    * [Docker pour Windows](https://docs.docker.com/docker-for-windows/install/ "Installation Docker dans un environnement Windows")
    * [Docker pour Mac](https://docs.docker.com/docker-for-mac/install/ "Installation Docker dans un environnement Mac")
    * [Docker pour les distributions Linux](https://docs.docker.com/v17.09/engine/installation/linux/docker-ce/ubuntu/ "Installation Docker dans un environnement Linux")
 
 * Installation de [Docker-Compose](https://docs.docker.com/compose/install/) pour la gestion de multiples containers d'applications.
 
 * Avant l'installation des containers Docker, il faut vérifier que les ports d'accès aux containers Dockers sont disponible DB(3306), PHP(8080), API(8080), CLIENT(80), ADMIN(81), CACHE-PROXY(8081), H2-PROXY(443, 444, 8443, 8444).
   Si un de ces ports est utilisé par une instance sur la machine locale.
   Il faudra modifier le fichier "./docker-compose.yml" pour permettre aux containers d'être accessible via des ports libres sur la marchine locale.
   ````
   ports:
    - portExterne:portInterne 
   ````
 
 * Création des containers DB, PHP, API, CLIENT, ADMIN,   CACHE-PROXY, H2-PROXY
    ````
    # Pour les OS Linux
    # Se placer dans le répertoire racine du projet
    $ cd path/to/projet
    
    # Lancer la construction des containers (téléchargement, création et lancement)
    # Cette commande doit être utilisé qu'une seule fois pour télécharger et créer les containers 
    $ sudo docker-compose up -d 
    ````
    Les autres commandes de base de docker-compose: 
   
    ````
    # Les commandes suivantes permettent de lancer et arrêter l'ensemble des containers Docker de l'application (tjrs se placer à la racine du projet qui contient le fichier docker-compose.yml)
    $ sudo docker-compose start
    $ sudo docker-compose stop
    
    # Pour effacer les containers créés
    $ sudo docker-compose down 
    
    # Voir les fichiers de logs d'un container spécifique. Ex: PHP
    $ sudo docker-compose logs php
    
    ````
    
    <p class="alert-danger">
        Avant de lancer la commande d'installation des containers, vérifier qu'aucun serveur ne fonctionne sur les port 80 et 3306. <br>
        Sinon Modifier les paramètres des ports de sortie pour les containers CLIENT, DB, et autres.
    </p>
  
 * Pour tester l'application avec une base de données fictives, il faut la remplir avec des fixtures en lançant la commande suivante à plusieurs reprises par exemple 5x:
    ````
    $ docker-compose exec php bin/console doctrine:fixtures:load --append
    ```` 




Credits
-------

Created by [Iracanyes](https://iracanyes.com). 





