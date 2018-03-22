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
    , nombre     varchar(255) NOT NULL
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
    , created_at timestamp DEFAULT localtimestamp
);


DROP TABLE IF EXISTS clinicas CASCADE;

CREATE TABLE clinicas
(
    id          bigserial    PRIMARY KEY
    , nombre    varchar(255) NOT NULL
    , direccion varchar(255)
    -- Aqui vá un punto geolocalizado
);

DROP TABLE IF EXISTS veterinarios CASCADE;

CREATE TABLE veterinarios
(
    id           bigserial    PRIMARY KEY
    , nombre     varchar(255) NOT NULL
    , apellido   varchar(255)
    , clinica_id bigint       REFERENCES clinicas(id)
                              ON DELETE NO ACTION ON UPDATE CASCADE
    , created_at timestamp    DEFAULT localtimestamp
    , UNIQUE(nombre,apellido)
);

DROP TABLE IF EXISTS medicamentos CASCADE;

CREATE TABLE medicamentos
(
      id            bigserial    PRIMARY KEY
    , nombre        varchar(255) NOT NULL UNIQUE
    , observaciones text
    , created_at    timestamp    DEFAULT localtimestamp
    , updated_at    timestamp
);

DROP TABLE IF EXISTS tratamientos CASCADE;

CREATE TABLE tratamientos
(
      id             bigserial PRIMARY KEY
    , animal_id      bigint    NOT NULL REFERENCES animales(id)
                               ON DELETE NO ACTION ON UPDATe CASCADE
    , medicamento_id bigint    NOT NULL REFERENCES medicamentos(id)
                               ON DELETE NO ACTION ON UPDATe CASCADE
    , veterinario_id bigint    REFERENCES veterinarios(id)
                               ON DELETE NO ACTION ON UPDATE CASCADE
    , fecha_inicio   date      NOT NULL
    , duracion       interval  NOT NULL
    , observaciones  text
    , created_at     timestamp DEFAULT localtimestamp
    , updated_at     timestamp
);
