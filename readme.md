## PHP Challenge


### Requirements
 - Docker

### How to install

run the following commands

1. copy _.env.example_ -> _.env_
2. set a password for the **DB connection**
3. docker-compose build
4. docker-compose up -d
5. ./composer install
6. create variable APP_END={VALUE}
7. ./phinx migrate
8. ./phinx seed:run


NOTE: the password of the **mysql** docker image will be the same as the one you set up on the .env on **DB_PASSWORD**, and the port that docker expose for MYSQL is **5306**


NOTE: the default password for the user created by the seeder is **password**
