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
    created_on DATETIME DEFAULT CURRENT_TIMESTAMP(),
    updated_on DATETIME ON UPDATE CURRENT_TIMESTAMP(),
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
        <p>Det blir spex, tåg, tält, sol, sommar... men framförallt: <b>KANAL-SURFNING!</b></p>', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

INSERT INTO content_section VALUES(2, 'side', 1, '<h2>Evenemang</h2>
    <h3>Fredag 18 mars</h3>
    <p>09:00 - 16:00<br>
        <b>Tidningsdagen</b>
    </p>
    <hr>
    <p>
        20:00 - 03:00<br>
        <b>Tidningsfesten</b>
    </p>
    <hr>
    <h3>Onsdag 18 maj</h3>
    <p>08:00 - 09:00<br>
        <b>Generalen hälsar folket välkomna</b></p>
    <hr>
    <div class="events">
        <img alt="Reklambild" src="assets/img/Karneval2010084.jpg">
        <p>09:15 - 10:00<br>
            <b>Kom och se Spexet!</b>
            <p>
    </div>', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

DROP TABLE IF EXISTS section;
CREATE TABLE section (
    section_id int(11) NOT NULL AUTO_INCREMENT,
    section_name varchar(255) NOT NULL,
    max_pos int(2) NOT NULL,
    section_desc text,
    PRIMARY KEY (section_id),
    UNIQUE (section_name)
);

INSERT INTO section VALUES(1, 'Administer IT', 2, 'IT och grejs.');
INSERT INTO section VALUES(2, 'Biljonsen', 40, 'Biljetter och grejs.');
INSERT INTO section VALUES(3, 'Blädderiet', 35, 'Bläddring och grejs.');
INSERT INTO section VALUES(4, 'Dansen', 60, 'Dans och grejs.');
INSERT INTO section VALUES(5, 'Nöjen', 100, 'Nöjen och grejs.');
INSERT INTO section VALUES(6, 'Tåget', 100, 'Tåget och grejs.');


DROP FOREIGN KEY student_section;
DROP TABLE IF EXISTS student;
CREATE TABLE student (
    student_id bigint(10) NOT NULL,
    student_email varchar(255) NOT NULL,
    student_first_name varchar(255) NOT NULL,
    student_surname varchar(255) NOT NULL,
    student_phone_number bigint(10) NOT NULL,
    student_section int(11) NOT NULL,
    PRIMARY KEY (student_id),
    UNIQUE (student_email),
    FOREIGN KEY (student_section) REFERENCES section(section_id)
);

DROP TABLE IF EXISTS faq;
CREATE TABLE faq (
    id int(11) NOT NULL AUTO_INCREMENT,
    created_on DATETIME DEFAULT CURRENT_TIMESTAMP(),
    question varchar(255) NOT NULL,
    answer text,
    PRIMARY KEY (id),
    UNIQUE (question)
);

INSERT INTO faq VALUES (1, CURRENT_TIMESTAMP(), 'Hur är man karnevalist?', '<p>Jo, man är karnevalist genom att vara en Lundastudent och är sugen på att kröka.</p>');
INSERT INTO faq VALUES (2, CURRENT_TIMESTAMP(), 'Hur hittar man till Karnevalen?', '<p>Gå till "Om Karnevalen" och sedan tryck på "Hitta hit". <a href="hitta-oss.html">Här är en länk ifall du inte
                hittar.</a></p>');
INSERT INTO faq VALUES (3, CURRENT_TIMESTAMP(), 'Varför måste man köa?', '<p>Sverige är uppbyggt med hjälp av kössystemet. Utan det hade vi fortfarande bott i grottor.</p>');
INSERT INTO faq VALUES (4, CURRENT_TIMESTAMP(), 'Hur köar man?', '<p>Släng på dig en vuxenblöja (likt man gör på nyårsafton vid Times Square). Gå till Lundagård, still dig i kö
            och håll ut! <br><small>Tips: Ta med dig en flaska Stroh för att hålla värmen.</small></p>');

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

ALTER TABLE reservation AUTO_INCREMENT = 20000;

SELECT count(*) FROM student s JOIN section c ON s.student_section = c.section_id WHERE s.student_section = '1';