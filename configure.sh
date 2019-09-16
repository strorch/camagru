#!/bin/bash

#install vim
docker exec camagru_pgsql_1 apt-get update
docker exec camagru_pgsql_1 apt-get install -y vim

# Migration
docker-compose exec web ./config/setup.php

