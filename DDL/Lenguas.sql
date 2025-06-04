CREATE DATABASE lenguas_oaxaca; --Creamos la base de datos

USE lenguas_oaxaca; --Empezamos a usar la base de datos

--Tabla 1 (familias lingüisticas)
CREATE TABLE familias_linguisticas (
    id_familia INT AUTO_INCREMENT PRIMARY KEY,
    nombre_familia VARCHAR(100) NOT NULL
);

--Tabla 2 (Regiones de oaxaca)
CREATE TABLE regiones (
    id_region INT AUTO_INCREMENT PRIMARY KEY,
    nombre_region VARCHAR(100) NOT NULL
);

--Tabla 3  (Comunidades) (1:M con regiones)
CREATE TABLE comunidades (
    id_comunidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre_comunidad VARCHAR(100) NOT NULL,
    id_region INT NOT NULL,
    FOREIGN KEY (id_region) REFERENCES regiones(id_region)
);

--Tabla 4 (Lenguas indigenas) (1:M con familias linguisticas) (1:M con regiones)
CREATE TABLE lenguas (
    id_lengua INT AUTO_INCREMENT PRIMARY KEY,
    nombre_lengua VARCHAR(100) NOT NULL,
    id_familia INT NOT NULL,
    id_region INT NOT NULL,
    numero_hablantes INT NOT NULL,
    FOREIGN KEY (id_familia) REFERENCES familias_linguisticas(id_familia),
    FOREIGN KEY (id_region) REFERENCES regiones(id_region)
);


