#!/bin/bash

for i in `seq 1 20`;
do
    echo "Fixtures $i"
    docker-compose exec php bin/console doctrine:fixtures:load --append
done;