#!/bin/bash

# Migration
docker cp ./config/setup.sql camagru_pgsql_1:/setup.sql
docker exec -u postgres camagru_pgsql_1 psql -f /setup.sql

#install vim
docker exec camagru_pgsql_1 apt-get update
docker exec camagru_pgsql_1 apt-get install -y vim