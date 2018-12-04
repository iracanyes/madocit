

# MaDocIt

=======
# madocit


## 1.Installation



[Read the official "Getting Started" guide](https://api-platform.com/docs/distribution).

#### 1.1 GIT Repository


Clôner le repository du projet 

````
$ git clone https://github.com/iracanyes/madocit.git 
$ cd madocit
````

#### 1.1 Configuration de Doctrine pour l'API

[Voir la page Readme.md du client](https://github.com/iracanyes/madocit/client/README.md)

#### 1.2 Docker & Docker-Compose
 * Installation [Docker](https://docs.docker.com/install/#supported-platforms) pour la gestion des containers de l'application.
 
 * Installation de [Docker-Compose](https://docs.docker.com/compose/install/) pour la gestion de multiples containers d'applications.
 * Création des containers DB, PHP, API, CLIENT, ADMIN,   CACHE-PROXY, H2-PROXY
    ````
    # Pour les OS Linux
    $ sudo docker-compose up -d 
    ````
    
    <p class="alert-danger">
        Avant de lancer la commande d'installation des containers, vérifier qu'aucun serveur ne fonctionne sur les port 80 et 3306. <br>
        Sinon Modifier les paramètres des ports de sortie pour les containers CLIENT et DB
    </p>
  
 




Credits
-------

Created by [Iracanyes](https://iracanyes.com). 


=======


