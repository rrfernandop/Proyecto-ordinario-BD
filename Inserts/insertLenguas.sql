--Familias lingüisticas
INSERT INTO familias_linguisticas (nombre_familia) VALUES
    ('Otomangue'),
    ('Mixe-Zoque');

--Regiones
INSERT INTO regiones (nombre_region) VALUES
    ('Sierra Norte'),
    ('Valles Centrales'),
   ('Sierra Mazateca'),
    ('Sierra Sur'),
    ('Costa Chica'),
    ('Cañada'),
    ('Mixteca'),
   ('Istmo');

--Comunidades 
INSERT INTO comunidades (nombre_comunidad, id_region) VALUES
    ('Totontepec Villa de Morelos', 1),
    ('San Lucas Quiaviní', 2),
    ('Huautla de Jiménez', 3),
    ('San Martín Itunyoso', 4),
    ('Panixtlahuaca', 5);

--Lenguas
INSERT INTO lenguas (nombre_lengua, id_familia, id_region, numero_hablantes) VALUES
    ('Zapoteco de la Sierra Norte',       1, 1, 60000),
     ('Mixteco del Valle de Oaxaca',       1, 2, 300000),
    ('Mazateco de Huautla',               1, 3, 175000),
    ('Chatino de Yutanduchi',             1, 5, 5000),
    ('Triqui de San Martín Itunyoso',     1, 4, 70000),
    ('Mixe de Totontepec',                2, 1, 10000);