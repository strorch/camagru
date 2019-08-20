#Camagru

## UNIT Factory web project

now is running on apache2 server

###Project setuping

- add `8100` port to apache ports
- create symlink in sites-aviable dir
####```camagru.com.conf -> /home/maksym/projects/camagru/config/camagru.com.conf```
- create dir `var/www/camagru.com` and symlink in it
####```public_html -> /home/maksym/projects/camagru```
- run `sudo a2ensite camagru.com.conf`
- run `sudo a2enmod rewrite`

## Docker

- systemctl start&enable docker 
- restart
- docker groupadd
- restart
- dc up
