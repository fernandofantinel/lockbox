-- DROP TABLE users;

-- CREATE TABLE users (
--   id INTEGER PRIMARY KEY,
--   name,
--   email,
--   password
-- );

-- DROP TABLE notes;

-- CREATE TABLE notes (
--   id INTEGER PRIMARY KEY,
--   user_id INTEGER,
--   title VARCHAR,
--   note TEXT,
--   created_at DATETIME,
--   updated_at DATETIME,
--   FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
-- );