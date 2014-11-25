CREATE TABLE notes (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    note VARCHAR NOT NULL
);

CREATE TABLE Sting (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    seq VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    title VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    time  VARCHAR NOT NULL,
    pred_status BOOLEAN,
    sanitize BOOLEAN,
    pred_weights VARCHAR,
    pred_seq  VARCHAR,
    pred_time  VARCHAR
);

insert into notes (note) values('one');
insert into notes (note) values('two');
insert into notes (note) values('three');
