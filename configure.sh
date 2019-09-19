#!/bin/bash

#install vim
docker-compose exec pgsql apt-get update
docker-compose exec pgsql apt-get install -y vim

# Migration
docker-compose exec web ./config/setup.php

