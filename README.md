
# madocit

Install
-------

[Read the official "Getting Started" guide](https://api-platform.com/docs/distribution).

<ul>
  <li>
     Cloner ce répository en local
        
     $ git clone https://github.com/iracanyes/madocit.git madocit
  </li>
  <li>
   Installation de Docker pour Windows : 

   <a  href="https://docs.docker.com/docker-for-windows/">Docker for Windows</a>
  </li>
  <li>
     Configuration les paramètres d'environnement pour les différents interfaces de l'application (admin, api et client). <br>
     Vous pouvez vous aider des fichiers ".env.dist" correspondants.  
  </li>
  <li>
     Se déplacer dans le répertoire racine de l'application et lancer la construction de l'image

    $ docker-compose up -d
    
   En cas d'erreur lors de l'installation 
   <ul>
     <li>
        Erreur : composer install <br>
        Il faut mettre à jour les composants à jour 
        Se placer dans le répertoire "api" et lancer la commande 
        <pre>
            composer update
        </pre>    
    </li>
   </ul>
    
  </li>


    

</ul>