#!/bin/bash

docker cp ./config/setup.sql camagru_pgsql_1:/setup.sql
docker exec -u postgres camagru_pgsql_1 psql -f /setup.sql