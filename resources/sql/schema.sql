CREATE TABLE notes (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    note VARCHAR NOT NULL
);

CREATE TABLE Sting (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    seq VARCHAR NOT NULL,
    name VARCHAR NOT NULL
);

insert into notes (note) values('one');
insert into notes (note) values('two');
insert into notes (note) values('three');
