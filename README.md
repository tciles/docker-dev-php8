# Docker Apache 2.4 + PhpFPM 8.0 + MariaDB

``` 
cd .docker
docker-compose up [-d] [--build]
docker-compose down
```

```
docker container ls

CONTAINER ID        IMAGE               COMMAND                  CREATED              STATUS              PORTS                    NAMES
13270c55db83        docker_apache       "httpd-foreground"       About a minute ago   Up About a minute   0.0.0.0:8080->80/tcp     docker_apache_1
ed7e7275b1e2        docker_php          "/bin/sh -c /usr/loc…"   About a minute ago   Up About a minute   0.0.0.0:9000->9000/tcp   docker_php_1
740dd13cadae        mariadb             "docker-entrypoint.s…"   2 days ago           Up About a minute   0.0.0.0:3306->3306/tcp   docker_db_1
```

```
docker exec docker_php_1 composer 
docker exec docker_php_1 symfony 
``` 

## Apache
Configuration: .docker/apache<br>
Virtual hosts: .docker/apache/conf/extra/httpd-vhosts.conf

### Hosts
``` 
127.0.0.1       docker.lan
127.0.0.1       dev-docker.lan
``` 

## PHP
.docker/php
