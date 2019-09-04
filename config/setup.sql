/*

sudo -u postgres psql
create database camagru;
DROP DATABASE IF EXISTS `WEBY_TEST`;
CREATE DATABASE `WEBY_TEST
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
  USER_ID INTEGER NOT NULL,
  PICT VARCHAR(100) NOT NULL,
  CMT varchar(256)
);

DROP TABLE IF EXISTS memes;
CREATE TABLE memes (
  ID SERIAL PRIMARY KEY NOT NULL,
  PICT VARCHAR(100) NOT NULL,
  CMT varchar(256)
);

CREATE OR REPLACE FUNCTION user_id (a_login text) RETURNS integer AS $$
    SELECT id FROM users WHERE name=a_login;
$$ LANGUAGE sql IMMUTABLE STRICT;

/*
DROP TABLE IF EXISTS `WEBY_TEST`.`FILMS`;
CREATE TABLE `WEBY_TEST`.`FILMS` (
  ID        INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  NAME      VARCHAR(16) NOT NULL,
  DT_CREATE DATE NOT NULL,
  FORMAT    VARCHAR (20) NOT NULL
);

DROP TABLE IF EXISTS `WEBY_TEST`.`ACTORS`;
CREATE TABLE `WEBY_TEST`.`ACTORS` (
  ID    INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  NAME  VARCHAR (50)
);

DROP TABLE IF EXISTS `WEBY_TEST`.`FILMS_AND_ACTORS`;
CREATE TABLE `WEBY_TEST`.`FILMS_AND_ACTORS` (
  ID        INT NOT NULL AUTO_INCREMENT,
  FILM_ID   INT NOT NULL,
  ACTOR_ID  INT NOT NULL,

  PRIMARY KEY (ID),
  FOREIGN KEY (FILM_ID) REFERENCES `FILMS` (ID),
  FOREIGN KEY (ACTOR_ID) REFERENCES `ACTORS` (ID)
);

CREATE OR REPLACE VIEW zclient AS
    SELECT      c.*
    FROM        client      c
;

ALTER TABLE ONLY zorder             ADD CONSTRAINT zorder_obj_id_pkey                   PRIMARY KEY (obj_id);
ALTER TABLE ONLY coupon             ADD CONSTRAINT coupon_coupon_uniq                   UNIQUE (coupon);
ALTER TABLE ONLY coupon             ADD CONSTRAINT coupon_serie_id_fkey                 FOREIGN KEY (serie_id)      REFERENCES coupon_serie (obj_id)
                                                                                        ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY coupon             ADD CONSTRAINT coupon_client_id_fkey                FOREIGN KEY (client_id)     REFERENCES client (obj_id)
                                                                                        ON UPDATE CASCADE ON DELETE SET NULL;
CREATE INDEX                        coupon_serie_id_idx                                 ON coupon (serie_id);
 */

INSERT INTO users (PICT) VALUES
('mem1.jpg'),
('mem2.jpeg'),
('mem3.jpg'),
('mem4.jpg'),
('mem5.jpg'),
('mem6.jpg'),
('mem7.jpg'),
;

INSERT INTO memes (PICT) VALUES
('mem1.jpg'),
('mem2.jpeg'),
('mem3.jpg'),
('mem4.jpg'),
('mem5.jpg'),
('mem6.jpg'),
('mem7.jpg'),
;

INSERT INTO posts (USER, PICT) VALUES
(USER_ID('test'), '')
;

COMMIT;
