# Camagru

## UNIT Factory web project

now is running on apache2 server

### Project setuping

- add `8100` port to apache ports
- create symlink in sites-aviable dir
#### ```camagru.com.conf -> /home/maksym/projects/camagru/config/camagru.com.conf```
- create dir `var/www/camagru.com` and symlink in it
#### ```public_html -> /home/maksym/projects/camagru```
- run `sudo a2ensite camagru.com.conf`
- run `sudo a2enmod rewrite`

## Docker

- systemctl start&enable docker 
- restart
- docker groupadd
- restart
- dc up


## With docker-machine

app will work on machine ip

- docker-machine create dev
 ###### docker-machine -s ${HOME}/goinfre/docker-machines/ create --driver virtualbox dev
 ###### docker-machine -s ${HOME}/goinfre/docker-machines/ create machine1
- docker-machine env dev
 ###### eval $(docker-machine -s ${HOME}/goinfre/docker-machines/ env machine1)
- eval $(docker-machine env dev)

## Databe image build (optional)

- init.sql
    
        CREATE USER docker;
        DROP DATABASE IF EXISTS camagru;
        CREATE DATABASE camagru;
        GRANT ALL PRIVILEGES ON DATABASE camagru TO docker;

- Dockerfile

        FROM postgres:11.0
        COPY init.sql /docker-entrypoint-initdb.d/
        ENV POSTGRES_USER docker
        ENV POSTGRES_PASSWORD docker
        ENV POSTGRES_DB docker

