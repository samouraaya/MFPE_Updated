# API MPFE 
##### version 1.0

## Installation 
```
$ git remote -v 
$ git remote remove origin 
$ git remote add origin http://10.1.1.70/MFPE/BackendMFPE.git
$ git config --system --unset credential.helper
```

### Clone project 
```
$ git clone http://10.1.1.70/MFPE/BackendMFPE.git ./

```
## Utilise Docker
```
$ docker-compose up --build

```

### Lancer une command dans le container
```
$ docker exec -it container_php_id php bin/console doctrine:schema:update --force
```
### Ouvrir terminal bash 
```
$ docker exec -it 06980f450c59 /bin/sh 
```


## Sans Docker 

### Install dependencies via composer
```
$ composer install
```
### Parameters Projet
```
/app/config/parameters_mfpe.yml
```

### Création des bases de données
```
$ php bin/console doctrine:database:create
```

### Génération du schéma de la base de données

```
$ php bin/console doctrine:schema:update –force
```

### Génération des assets

```
$ php bin/console assets:install web
```

### Création d’utilisateur super administrateur admin/admin

```
$ php bin/console create:firstUser
```

### Génération des permissions

```
$ php bin/console create:permissions
```
### Installation des migrations

```
$ php bin/console doctrine:fixtures:load
```

### Vide le cache Symfony

```
$ php bin/console cache:clear --env prod
$ php bin/console cache:clear
```

### Attribution des droits d’accès

```
$ chmod -R 755 ./var
```

### Run server
```
$ php bin/console server:run 8000
```
```
http://localhost:8000
```

### API Doc
```
http://localhost:8000/api/doc
```

### `Git branch naming`

```
feature/   Manage your feature branches.
bugfix/    Manage your bugfix branches.
release/   Manage your release branches.
hotfix/    Manage your hotfix branches.
support/   Manage your support branches.
```

#### `<name>`
Always use dashes to seperate words, and keep it short.

#### Examples
```
feature/satellite-module
hotfix/ftp-access
bugfix/login-ie
```

#### Les instruction pour faire un pull depuis le branch develop
```
git commit -m "commit 4 pull" / dans votre branch
git checkout develop
git pull origin develop
git checkout votre_branch
git rebase develop

// en cas de conflit correction du conflit puis
git add .
git rebase --continue
```