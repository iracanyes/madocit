# API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information.

## API - Installation

1. Télécharger le repository

   ```
   $ git clone https://github.com/iracanyes/madocit.git
   ```

    1.1 Modification du fichier de configuration doctrine

        api/config/packages/doctrine.yaml.dist

    Il faut ajouter le nom d'utilisateur et le mot de passe qui seront 
    utilisé à la création de l'instance docker mysql    
        env(MYSQL_DATABASE): 'dbname'
        env(MYSQL_HOST): 'db'
        env(MYSQL_USER): "username"
        env(MYSQL_PASSWORD): "password"
        env(MYSQL_PORT): '3306'  
        
     1.2 Placer sauvegarder le fichier sous le nom "doctrine.yaml"
2. Création de l'environnement de développement

   2.1 Installation de docker voir sur la documentation sur le site officielle :
      * [Docker pour Windows](https://docs.docker.com/docker-for-windows/install/ "Installation Docker dans un environnement Windows")
      * [Docker pour Mac](https://docs.docker.com/docker-for-mac/install/ "Installation Docker dans un environnement Mac")
      * [Docker pour les distributions Linux](https://docs.docker.com/v17.09/engine/installation/linux/docker-ce/ubuntu/ "Installation Docker dans un environnement Linux")
   
   2.2 Pour lancer la reconstruction de l'image avec Docker, on utilisera la commande suivante : 
   ```
   $ docker-compose up -d
   ```
   <p class='alert-danger'>
    REMARQUE: Si un environnement de développement est déjà présent sur la machine local. Il faudra modifier les paramètres des ports pour les container `db`(port:3306) et `client`(port:80) dans le fichier d'environnement `./.env` situé dans le répertoire racine du projet.
   </p>
   ```
   
   ```
   
