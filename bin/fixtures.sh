#!/bin/bash

for i in `seq 1 30`;
do
    echo "Fixtures $i"
    docker-compose exec php bin/console doctrine:fixtures:load --append
done;