CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT, artist varchar(100) NOT NULL, title varchar(100) NOT NULL);
INSERT INTO album (artist, title) VALUES ('The Military Wives', 'In My Dreams');
INSERT INTO album (artist, title) VALUES ('Adele', '21');
INSERT INTO album (artist, title) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)');
INSERT INTO album (artist, title) VALUES ('Lana Del Rey', 'Born To Die');
INSERT INTO album (artist, title) VALUES ('Gotye', 'Making Mirrors');

CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT, f_name varchar(100) NOT NULL, l_name varchar(100) NOT NULL, address varchar(100) NOT NULL);
INSERT INTO member (f_name, l_name, address) VALUES ('Jon', 'Snow', 'Winterfell');
INSERT INTO member (f_name, l_name, address) VALUES ('Arya', 'Stark', 'Winterfell');
INSERT INTO member (f_name, l_name, address) VALUES ('Daenerys', 'Targaryen', 'Great House of Westeros');
INSERT INTO member (f_name, l_name, address) VALUES ('Tyrion', 'Lannister', 'Westerlands');
INSERT INTO member (f_name, l_name, address) VALUES ('Sansa', 'Stark', 'Winterfell');
INSERT INTO member (f_name, l_name, address) VALUES ('Jaime', 'Lannister', 'Westerlands');