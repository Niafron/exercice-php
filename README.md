# exercice-php

Test php REST api with sf & doctrine.

## Présentation

Ce projet est une **Api REST minimaliste en sf `6.1` et php `8.1`**.
Elle représente une quête de JDR et vous propose d'accéder à des ressources de type héros.
Vous serez amené à appréhender cet environnement et à le faire évoluer.

## Initialisation de votre environnement de travail

**Avec linux :** docker + git

**Avec mac :** docker + git

**Avec windows :** [docker desktop](https://docs.docker.com/desktop/install/windows-install/) ou [wsl2](https://docs.microsoft.com/fr-fr/windows/wsl/install) et [git pour windows](https://gitforwindows.org/)

- :warning: lors du premier lancement du projet, veuillez avant tout exécuter le script suivant : `./bin/init_env_outside_container.sh`, en dehors de tout container.
- lancer le docker-compose : `docker-compose up`
- connectez-vous au container fpm : `docker exec -it exercice-php_fpm_1 bash`
- exécutez le script d'initialisation : `./bin/init_env_inside_container.sh`

## Utilisation de votre environnement de travail

- accès au container fpm : `docker exec -it exercice-php_fpm_1 bash`
- accès à la route *[GET] /heroes* : [http://localhost:8081/heroes](http://localhost:8081/heroes)
- accès à la route *[GET] /hero/{id}* : [http://localhost:8081/hero/2](http://localhost:8081/hero/2) 
- accès au phpmyadmin : [http://localhost:3333/](http://localhost:3333/) avec login = `hercules` & password = `hades`
- lancement des tests unitaires : `./vendor/bin/phpunit`
- lancement du cs fixer : `./vendor/bin/php-cs-fixer fix --dry-run -v src/`

## Consignes 

Il n'y a **pas réellement de temps impartit**.
Celà dépend des disponibilités que vous pouvez y consacrer et du temps nécessaire pour atteindre un résultat qui vous semble être satisfaisant.

En dehors des tâches listées ci-dessous, **vous êtes libre de faire évoluer le projet** si vous en ressentez le besoin ou l'envie.

Vous pouvez bien évidement utiliser **l'ensemble des outils à votre disposition** pour répondre au besoin.

- [ ] Récupérer le projet et initialiser votre environnement de travail local.
- [ ] Exécuter les TU, constater qu'une erreur est présente puis corrigez-la.
- [ ] Créer une entité nommée `Potion` :
  - la potion représente un bonus que le héros va consommer pour obtenir un boost
  - chaque héro possède 0 ou X potion(s)
  - chaque potion est rattachée à 1 et 1 seul héro
  - la potion se compose des propriétés suivantes :
    - `id` : int - auto-increment
    - `name` : string - 150 not null
    - `bonus` : int - not null
- [ ] Créer un fichier de migration doctrine afin de suivre cette évolution du schéma.
- [ ] Mettre a jour le fichier de fixtures afin de donner 1 potion au héro nommé `Beowulf` et 2 potions au héro nommé `Diane`.
- [ ] Relancez le script `./bin/init_env_inside_container.sh` et s'assurer que tout est OK.
- [ ] Créer l'entrypoint *[GET] /hero/{id}/potions* qui permet de lister les potions que possède un héro.
- [ ] Mettre à jour l'entité `Hero` afin d'ajouter la méthode suivante :
  - `getBoostedPower(): int`
  - elle reprend le résultat de la méthode `getPower` auquel elle ajoute **tous les bonus** de **toutes les potions** que possède le héro
  - le fait d'utiliser cette méthode "consomme" toutes les potions
- [ ] Tester unitairement la méthode `getBoostedPower`. 
- [ ] Effectuer une MR ou un fork
