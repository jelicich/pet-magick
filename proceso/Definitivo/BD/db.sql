USE idomy_11076335_pet;

/*COMENTARIOS:
Protocolo(?)
-Tablas en plural, minuscula
-Columnas en singular, mayuscula (salvo news pq es asi de movida)
-IDs de tablas ID_ + "nombre de tabla en sigunlar" (ej. ID_CITY)
-FK "nombre de tabla" + _ID (ej. CITY_ID)
-Guion bajo para cuando son dos palabras (ej. animal_categories)
-Picture siempre lo abrevie como pic pq me gusta no se
=====


Chequear bien los largos de los varchar evaluar si se necesita cambiar alguno a text
Chequear los not null
Chequear los char (son las url)

Estaba pensando en agregar un campo DATE en todas las tablas. cosa q si despues necesitamos filtrar algo este la opcion de la fecha. total es una gilada agregarlo, no sé q pensas
*/

/* ---------------- */
CREATE TABLE countries(
	ID_COUNTRY INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	COUNTRY VARCHAR(45) NOT NULL
);

/* ---------------- */
CREATE TABLE cities(
	ID_CITY INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	CITY VARCHAR(45) NOT NULL,
	COUNTRY_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(COUNTRY_ID) REFERENCES countries(ID_COUNTRY)
);

/* ---------------- */
CREATE TABLE users(
	ID_USER INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	NAME VARCHAR(45) NOT NULL,
	LASTNAME VARCHAR(45) NOT NULL,
	NICKNAME VARCHAR(45) NOT NULL UNIQUE,
	EMAIL VARCHAR(100) NOT NULL UNIQUE,
	PASSWORD CHAR(40) NOT NULL,
	ABOUT VARCHAR(300),
	PROFILEPIC CHAR(30), /* Esta foto yo la puse aca porque es una sola foto q se puede subir, igual se puede subir a la tabla de las fotos y este campo seria el ID */
	RANGE TINYINT(1) UNSIGNED NOT NULL,
	CITY_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(CITY_ID) REFERENCES cities(ID_CITY)
);


/* ---------------- */
CREATE TABLE animal_categories(
	ID_ANIMAL_CATEGORY INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	NAME VARCHAR(45) NOT NULL
);

/* ---------------- */
CREATE TABLE pets(
	ID_PET INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	NAME VARCHAR(45) NOT NULL,
	BREED VARCHAR(45),
	TRAITS VARCHAR(100),
	STORY VARCHAR(300),
	PROFILEPIC CHAR(30), /* Esta foto yo la puse aca porque es una sola foto q se puede subir, igual se puede subir a la tabla de las fotos y este campo seria el ID */
	USER_ID INT UNSIGNED NOT NULL,
	ANIMAL_CATEGORY_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER),
	FOREIGN KEY(ANIMAL_CATEGORY_ID) REFERENCES animal_categories(ID_ANIMAL_CATEGORY)
);

/* ---------------- */
CREATE TABLE tributes(
	ID_TRIBUTE INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	TITLE VARCHAR(100) NOT NULL,
	CONTENT TEXT NOT NULL,
	NAME VARCHAR(45) NOT NULL,
	BREED VARCHAR(45),
	SINCE DATE NOT NULL,
	TO DATE NOT NULL,
	PIC CHAR(30), /* Esta foto yo la puse aca porque es una sola foto q se puede subir, igual se puede subir a la tabla de las fotos y este campo seria el ID */
	USER_ID INT UNSIGNED NOT NULL,
	PET_ID INT UNSIGNED, /*sin NOT NULL, no necesariamente esta creado el perfil */
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER),
	FOREIGN KEY(PET_ID) REFERENCES pets(ID_PET)
);

/* ---------------- */
CREATE TABLE vet_talk(
	ID_VET_TALK INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	TITLE VARCHAR(100) NOT NULL,
	CONTENT TEXT NOT NULL,
	DATE DATE NOT NULL,
	USER_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER)
);

/* ---------------- */ /* Esta tabla la cree pensando en el hipotetico caso de que el tipo quiera mantener un historial de las news, sino de la otra forma es un campo q se va actualizando el contenido tenemos q evaluar si complica dsps el tema del backend y si lo hace complejo*/
CREATE TABLE news(
	ID_NEWS INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	NEWS VARCHAR(300) NOT NULL,
	DATE DATE NOT NULL,
	USER_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER)
);

/* ---------------- */
CREATE TABLE organizations(
	ID_ORGANIZATION INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	NAME VARCHAR(100) NOT NULL, /* UNIQUE? */
	DESCRIPTION TEXT NOT NULL,
	PIC CHAR(30), /* Esta foto yo la puse aca porque es una sola foto q se puede subir, igual se puede subir a la tabla de las fotos y este campo seria el ID */
	USER_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER)
	/* Agregar mas campos??? Cual es la gracia de crear esta tabla si no va a tener datos de contacto como telefono direccion website o algo */
);

/* ---------------- */
CREATE TABLE blogs(
	ID_BLOG INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	TITLE VARCHAR(100) NOT NULL,
	CONTENT TEXT NOT NULL,
	DATE DATE NOT NULL,
	USER_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER)
);

/* ---------------- */
CREATE TABLE projects(
	ID_PROJECT INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	TITLE VARCHAR(100) NOT NULL,
	DESCRIPTION TEXT NOT NULL,
	/*DATE DATE NOT NULL, DATE?*/
	USER_ID INT UNSIGNED NOT NULL,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER)
);

/* ---------------- */
CREATE TABLE pics(
	ID_PIC INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	PIC VARCHAR(100) NOT NULL,
	DATE DATE NOT NULL,
	CAPTION VARCHAR(100), /* EL tipo no lo pidio, por ahi se complica si agregamos la opcion de agregar varias fotos de una lo cual es bastante practico */ 
	USER_ID INT UNSIGNED,
	PET_ID INT UNSIGNED,
	PROJECT_ID INT UNSIGNED,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER),
	FOREIGN KEY(PET_ID) REFERENCES pets(ID_PET),
	FOREIGN KEY(PROJECT_ID) REFERENCES projects(ID_PROJECT)
	/* Aca irian todos los FK de las tablas q tienen un campo para pic si es que queremos manejar TODAS las fotos desde aca, los FK NO llevan not null */
);


/* ---------------- */
CREATE TABLE videos(
	ID_VIDEO INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	VIDEO CHAR(30) NOT NULL,
	TITLE VARCHAR(100) NOT NULL,
	CAPTION VARCHAR(300) NOT NULL,
	DATE DATE NOT NULL,
	PET_ID INT UNSIGNED,
	FOREIGN KEY(PET_ID) REFERENCES pets(ID_PET)
	/* Aca irian todos los FK de las tablas q tienen un campo para pic si es que queremos manejar TODAS las fotos desde aca, los FK NO llevan not null */
);

/* ---------------- */ /*INBOX*/
CREATE TABLE messages(
	ID_MESSAGE INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	FROM_USER_ID INT UNSIGNED NOT NULL,
	TO_USER_ID INT UNSIGNED NOT NULL,
	SUBJECT VARCHAR(100) NOT NULL,
	MESSAGE TEXT,
	STATUS TINYINT(1) NOT NULL,
	DATE DATE NOT NULL,
	FOREIGN KEY(FROM_USER_ID) REFERENCES users(ID_USER),
	FOREIGN KEY(TO_USER_ID) REFERENCES users(ID_USER)
);


/* ---------------- */ 
CREATE TABLE ads(
	ID_AD INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	AD CHAR(30) NOT NULL,
	LINK INT UNSIGNED NOT NULL,
	DATE DATE NOT NULL,
	DATE_FROM DATE,
	DATE_TO DATE,
	STATUS TINYINT(1) NOT NULL /*Activo no activo*/
);

/* ---------------- */ 
CREATE TABLE comments(
	ID_COMMENT INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	COMMENT VARCHAR(300) UNSIGNED NOT NULL,
	DATE DATE NOT NULL,
	USER_ID INT UNSIGNED NOT NULL,
	/*Aca van todas las secciones q se pueden comentar sin NOT NULL*/
	TRIBUTE_ID INT UNSIGNED,
	FOREIGN KEY(USER_ID) REFERENCES users(ID_USER),
	FOREIGN KEY(TRIBUTE_ID) REFERENCES tributes(ID_TRIBUTE)
);
