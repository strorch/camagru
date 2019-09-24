/*

CREATE USER camagru_user WITH PASSWORD 'root';
alter role camagru_user with superuser; --etc roles
CREATE OR REPLACE VIEW client AS
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
  login text NOT NULL,
  password text NOT NULL,
  email text NOT NULL,
  salt text NOT NULL,
  notifications INT NOT NULL,
  log_stat INT DEFAULT 0
);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  id SERIAL PRIMARY KEY NOT NULL,
  user_id INTEGER NOT NULL,
  pict text NOT NULL
);

DROP TABLE IF EXISTS likes;
CREATE TABLE likes (
    id SERIAL PRIMARY KEY NOT NULL,
    user_id INTEGER NOT NULL,
    post_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
   id SERIAL PRIMARY KEY NOT NULL,
   user_id INTEGER NOT NULL,
   post_id INTEGER NOT NULL,
   comment TEXT NOT NULL
);

DROP TABLE IF EXISTS stickers;
CREATE TABLE stickers (
  id SERIAL PRIMARY KEY NOT NULL,
  pict text NOT NULL
);

CREATE OR REPLACE FUNCTION user_id (a_login text) RETURNS integer AS $$
    SELECT id FROM users WHERE login=a_login;
$$ LANGUAGE sql IMMUTABLE STRICT;

CREATE OR REPLACE FUNCTION create_post (a_user_id integer, a_pict_name text) RETURNS VOID AS $$
BEGIN
    INSERT INTO posts (user_id, pict) VALUES (a_user_id, a_pict_name);
END
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION set_like (a_post_id integer, a_user_id integer) RETURNS VOID AS $$
BEGIN
    INSERT INTO likes (user_id, post_id) VALUES (a_user_id, a_post_id);
END
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION set_comment (a_post_id integer, a_user_id integer, a_comment text) RETURNS VOID AS $$
BEGIN
    INSERT INTO comments (user_id, post_id, comment) VALUES (a_user_id, a_post_id, a_comment);
END
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION remove_comment (a_user_id integer, a_comment_id integer) RETURNS VOID AS $$
BEGIN
    DELETE
    FROM    likes
    WHERE   id=a_comment_id
    AND     user_id=a_user_id;
END
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION remove_like (a_post_id integer, a_user_id integer) RETURNS VOID AS $$
BEGIN
    DELETE
    FROM    likes
    WHERE   post_id=a_post_id
    AND     user_id=a_user_id;
END
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION create_user (a_login text, a_password text, a_email text, a_salt text, a_log_stat integer) RETURNS VOID AS $$
BEGIN
    INSERT INTO users (login, password, email, salt, notifications, log_stat) VALUES
    (a_login, a_password, a_email, a_salt, 1, a_log_stat);
END
$$ LANGUAGE 'plpgsql';

INSERT INTO stickers (pict) VALUES
('mem1.jpg'),
('mem2.png'),
('mem3.jpg'),
('mem4.jpg')
;

SELECT create_user('testuser', 'random', 'test@email.com', '1111', 1);
SELECT create_user('usrrrrrr', 'random', 'test@email.com', '1010', 1);


SELECT create_post(user_id('testuser'), 'picture1.jpg');
SELECT create_post(user_id('testuser'), 'picture2.jpeg');
SELECT create_post(user_id('usrrrrrr'), 'pict1.png');

COMMIT;
