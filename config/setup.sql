/*

sudo -u postgres psql
create database camagru;
\c camagru
CREATE USER camagru_user WITH PASSWORD 'root';
alter role camagru_user with superuser; --etc roles
\q
psql -h localhost -d camagru -U camagru_user
 */

BEGIN TRANSACTION;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  ID SERIAL PRIMARY KEY NOT NULL,
  NAME VARCHAR(16) NOT NULL,
  PASSWD VARCHAR(25) NOT NULL,
  EMAIL VARCHAR(25) NOT NULL,
  LOG_STAT INT DEFAULT 0,
  CMT VARCHAR(256)
);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  ID SERIAL PRIMARY KEY NOT NULL,
  "USER" VARCHAR(16) NOT NULL,
  PICT VARCHAR(100) NOT NULL,
  CMT varchar(256)
);

COMMIT;