# Gestion tournois ALOAS

## Ports used
- 80 : website
- 8081 : phpmyadmin

## Docker
The project is dockerized. To start the project, run the following command:
```bash
docker-compose up --build
```
You may need to run the following command if the vendor folder is not created:
```bash
docker-compose exec web composer install
```

The JS is build and a watcher is available in the container. To run the watcher if he is not already launch, run the following command:
```bash
docker-compose exec web npm run watch
```

## Database
The database is managed by phpmyadmin. You can access it at the following address:
```bash
http://127.0.0.1:8081
```

## Website
The website is available at the following address:
```bash
http://127.0.0.1:80
```

## Technologies used
- Symfony 7.*
- VueJS 3.*
- TailwindCSS 2.*
- Docker
- PHPMyAdmin
- MySQL
- Apache2
- PHP 8.*

## Old project

This project is a new version of the old project. The old project is available at the following address:
```bash
https://test-tournoi-sae.fr/
```

The gitlab repository is available at the following address:
```bash
https://iutbg-gitlab.iutbourg.univ-lyon1.fr/sae-but3/2024-25-web/gestiontournois-aloas
```

## OVH + deployment 

The project is also host on GitHub and deployed on OVH. The website is available at the following address:
```bash
https://aloas-tournois.fr/
```

To deploy it, Quentin need to do the following command for send the file in github :
```bash
git push github main
```

