DROP TABLE IF EXISTS user;
CREATE TABLE user (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    hashed_password varchar(255) NOT NULL,    
    first_name varchar(255),
    email varchar(255) NOT NULL,
    PRIMARY KEY (id),
    KEY index_username (username)
);

INSERT INTO user VALUES(1, 'admin', 'qwerty123', 'John Smith', 'John@smith.com');

DROP TABLE IF EXISTS content_section;
CREATE TABLE content_section (
    section_id int(11) NOT NULL AUTO_INCREMENT,
    area_name varchar(255) NOT NULL,
    visible tinyint(1) DEFAULT 0,
    content text,
    PRIMARY KEY (section_id),
    UNIQUE (area_name)
);

INSERT INTO content_section VALUES(1, 'main', 1, '<h2>Vart fjärde år...</h2>
        <h1>... blir det Karneval!</h1>
        <h3>Och i år blir det <i>Kanalkarneval</i> !</h3>
        <p>Älskar du TV? Det gör vi i Lund. Därför vill vi fira årets karneval med en hyllning till världens bästa
            medium.</p>
        <p>Utan TV hade vi inte haft en identitet. Inga samtal om senaste Game of Thrones (vi vet, det är över)
            eller de senaste nyheterna</p>
        <p>Det blir spex, tåg, tält, sol, sommar... men framförallt: <b>KANAL-SURFNING!</b></p>');

DROP TABLE IF EXISTS student;
CREATE TABLE student (
    student_email varchar(255) NOT NULL,
    student_first_name varchar(255) NOT NULL,
    student_surname varchar(255) NOT NULL,
    student_phone_number bigint(10) NOT NULL,
    student_section varchar(255) NOT NULL,
    PRIMARY KEY (student_email)
);

DROP TABLE IF EXISTS event;
CREATE TABLE event (
    event_name varchar(255) NOT NULL,
    number_of_seats int NOT NULL,
    PRIMARY KEY (event_name)
);

ALTER TABLE reservation
DROP FOREIGN KEY event_name;
DROP TABLE IF EXISTS reservation;

CREATE TABLE reservation (
    reservation_id int(11) NOT NULL AUTO_INCREMENT,
    reservation_name varchar(255) NOT NULL,
    number_of_reserved_seats int NOT NULL,
    event_name varchar(255),
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (event_name) REFERENCES event(event_name)
);