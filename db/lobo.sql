------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS colores CASCADE;

CREATE TABLE colores
(
      id bigserial PRIMARY KEY
    , nombre varchar(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE especies
(
      id     bigserial    PRIMARY KEY
    , nombre varchar(255) UNIQUE NOT NULL
);

DROP TABLE IF EXISTS razas CASCADE;

CREATE TABLE razas
(
      id         bigserial    PRIMARY KEY
    , nombre     varchar(255) NOT NULL,
    , especie_id bigint       NOT NULL REFERENCES especies(id)
                              ON DELETE NO ACTION ON UPDATE CASCADE
    , UNIQUE(nombre,especie_id)
);

DROP TABLE IF EXISTS animales CASCADE;

CREATE TABLE animales
(
      id            bigserial    PRIMARY KEY
    , nombre        varchar(255) NOT NULL
    , raza_id       bigint       NOT NULL REFERENCES razas(id)
                                 ON DELETE NO ACTION ON UPDATE CASCADE
    , especie_id    bigint       NOT NULL REFERENCES especies(id)
                                 ON DELETE NO ACTION ON UPDATE CASCADE
    , chip          varchar(255) UNIQUE
    , observaciones text
);
