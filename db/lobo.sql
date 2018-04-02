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
    , sexo          varchar(1)   CONSTRAINT ck_sexo_valido
                                 CHECK (sexo = 'h' OR sexo = 'm')
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
    , pauta          varchar(255)
    , fecha_inicio   date      NOT NULL
    , duracion       interval  NOT NULL
    , observaciones  text
    , created_at     timestamp DEFAULT localtimestamp
    , updated_at     timestamp
);

DROP TABLE IF EXISTS enfermedades CASCADE;

CREATE TABLE enfermedades
(
      id          bigserial    PRIMARY KEY
    , nombre      varchar(255) NOT NULL UNIQUE
    , descripcion text
);

DROP TABLE IF EXISTS vacunas CASCADE;

CREATE TABLE vacunas
(
      id            bigserial    PRIMARY KEY
    , nombre        varchar(255) NOT NULL UNIQUE
    , observaciones text
);

DROP TABLE IF EXISTS vacunas_enfermedades CASCADE;

CREATE TABLE vacunas_enfermedades
(
      vacuna_id     bigint REFERENCES vacunas(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , enfermedad_id bigint REFERENCES enfermedades(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , PRIMARY KEY(vacuna_id,enfermedad_id)
);

DROP TABLE IF EXISTS vacunas_animales CASCADE;

CREATE TABLE vacunas_animales
(
      animal_id bigint REFERENCES animales(id)
                       ON DELETE NO ACTION ON UPDATE CASCADE
    , vacuna_id bigint REFERENCES vacunas(id)
                       ON DELETE NO ACTION ON UPDATE CASCADE
    , fecha     date
    , PRIMARY KEY(vacuna_id,animal_id)
);

DROP TABLE IF EXISTS vacunaciones CASCADE;

CREATE TABLE vacunaciones
(
      id         bigserial PRIMARY KEY
    , animal_id  bigint    REFERENCES animales(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , vacuna_id  bigint    REFERENCES vacunas(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , clinica_id bigint    REFERENCES clinicas(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , fecha_hora timestamp
);

DROP TABLE IF EXISTS enfermedades_animales CASCADE;

CREATE TABLE enfermedades_animales
(
      animal_id bigint REFERENCES animales(id)
    , enfermedad_id bigint REFERENCES enfermedades(id)
                           ON DELETE NO ACTION ON UPDATE CASCADE
    , fecha_inicio   date      NOT NULL
    , duracion       interval  NOT NULL
    , PRIMARY KEY(animal_id,enfermedad_id)
);

-- TODO pensar en
