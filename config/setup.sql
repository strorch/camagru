/*

sudo apt install php7.*-pgsql
sudo -u postgres psql
create database camagru;
DROP DATABASE IF EXISTS `WEBY_TEST`;
CREATE DATABASE `WEBY_TEST
\c camagru
CREATE USER camagru_user WITH PASSWORD 'root';
alter role camagru_user with superuser; --etc roles
\q
psql -h localhost -d camagru -U camagru_user


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

BEGIN TRANSACTION;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id SERIAL PRIMARY KEY NOT NULL,
  login VARCHAR(16) NOT NULL,
  password VARCHAR(25) NOT NULL,
  email VARCHAR(25) NOT NULL,
  log_stat INT DEFAULT 0,
  cmt VARCHAR(256)
);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  id SERIAL PRIMARY KEY NOT NULL,
  user_id INTEGER NOT NULL,
  pict VARCHAR(100) NOT NULL,
  cmt VARCHAR(256)
);

DROP TABLE IF EXISTS memes;
CREATE TABLE memes (
  id SERIAL PRIMARY KEY NOT NULL,
  pict VARCHAR(100) NOT NULL,
  cmt varchar(256)
);

CREATE OR REPLACE FUNCTION user_id (a_login text) RETURNS integer AS $$
    SELECT id FROM users WHERE name=a_login;
$$ LANGUAGE sql IMMUTABLE STRICT;

-- CREATE OR REPLACE FUNCTION create_post (a_user_id integer, a_login text) RETURNS integer AS $$
--     INSERT INTO posts (user_id, pict) VALUES
--     (SELECT user_id('test_user'), 'picture1.jpg')
-- $$ LANGUAGE sql IMMUTABLE STRICT;

INSERT INTO memes (pict) VALUES
('mem1.jpg'),
('mem2.jpeg'),
('mem3.jpg'),
('mem4.jpg'),
('mem5.jpg'),
('mem6.jpg'),
('mem7.jpg')
;

INSERT INTO users (login, password, email, log_stat) VALUES
('test_user', 'random', 'test@test.ua', 1)
;

INSERT INTO posts (user_id, pict) VALUES
(user_id('test_user'), 'picture1.jpg'),
(user_id('test_user'), 'picture2.jpeg')
;

COMMIT;
