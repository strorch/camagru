#!/bin/bash

#install vim
docker-compose exec pgsql apt-get update
docker-compose exec pgsql apt-get install -y vim

# Migration
docker-compose exec web ./config/setup.php

# Run up in localhost:8000
# VBoxManage controlvm ddd natpf1 rule1,tcp,,8000,,80
