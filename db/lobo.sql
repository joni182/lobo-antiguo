------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS colores CASCADE;

CREATE TABLE colores
(
      id bigserial PRIMARY KEY
    , nombre varchar(255) NOT NULL UNIQUE
);

INSERT INTO colores (nombre)
VALUES ('blanco')
     , ('negro')
     , ('gris claro')
     , ('gris oscuro')
     , ('marrón claro')
     , ('marrón oscuro')
     , ('chocolate claro')
     , ('chocolate oscuro')
     , ('canela claro')
     , ('canela oscuro')
     , ('amarillo claro')
     , ('amarillo oscuro')
     , ('naranja claro')
     , ('naranja oscuro')
     , ('azul claro')
     , ('azul oscuro')
     , ('rojo claro')
     , ('rojo oscuro')
     , ('verde claro')
     , ('verde oscuro')
     , ('rosa claro')
     , ('rosa oscuro')
     , ('violeta claro')
     , ('violeta oscuro');

DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE especies
(
      id     bigserial    PRIMARY KEY
    , nombre varchar(255) UNIQUE NOT NULL
);

INSERT INTO especies (nombre)
     VALUES ('Perro')
          , ('Gato');

DROP TABLE IF EXISTS razas CASCADE;

CREATE TABLE razas
(
      id         bigserial    PRIMARY KEY
    , nombre     varchar(255) NOT NULL
    , especie_id bigint       NOT NULL REFERENCES especies(id)
                              ON DELETE NO ACTION ON UPDATE CASCADE
    , UNIQUE(nombre,especie_id)
);

INSERT INTO razas (nombre,especie_id)
     VALUES ('Mestizo', 1)
          , ('Yorkshire', 1)
          , ('Bodeguero', 1)
          , ('Labrador', 1)
          , ('Pitbull', 1)
          , ('Mastín', 1)
          , ('Podenco', 1)
          , ('Mestizo', 2)
          , ('Azul ruso', 2)
          , ('Siamés', 2)
          , ('Presa', 2)
          , ('Ragdoll', 2);


DROP TABLE IF EXISTS animales CASCADE;

CREATE TABLE animales
(
      id            bigserial    PRIMARY KEY
    , nombre        varchar(255) NOT NULL
    , peso          numeric(5,2)
    , ppp           boolean      DEFAULT false
    , chip          varchar(255) UNIQUE
    , sexo          varchar(6)   CONSTRAINT ck_sexo_valido
                                 CHECK (sexo = 'Hembra' OR sexo = 'Macho')
    , observaciones text
    , created_at timestamp DEFAULT localtimestamp
);

INSERT INTO animales (nombre, peso, ppp, chip, sexo, observaciones)
    VALUES ('Pelu', 3.8, false, '195487632541258896XDF', 'Hembra', 'Le apesta el aliento, tiene alitosis y una cresta muy molona.')
         , ('Siri', 30, true, '569854712642555781DRT', 'Hembra', 'Es la perra mas buena de toda Brigada, aunque no se lleva bien con los gatos, se los quiere comer.');

DROP TABLE IF EXISTS animales_razas CASCADE;

CREATE TABLE animales_razas
(
      animal_id bigint NOT NULL REFERENCES animales(id)
                                ON DELETE NO ACTION ON UPDATE CASCADE
    , raza_id   bigint NOT NULL REFERENCES razas(id)
                                ON DELETE NO ACTION ON UPDATE CASCADE
    , PRIMARY KEY(animal_id, raza_id)
);

INSERT INTO animales_razas (animal_id, raza_id)
     VALUES (1, 1)
          , (1, 2)
          , (2, 1)
          , (2, 5);

DROP TABLE IF EXISTS animales_colores CASCADE;

CREATE TABLE animales_colores
(
      animal_id bigint NOT NULL REFERENCES animales(id)
                                ON DELETE NO ACTION ON UPDATE CASCADE
    , color_id  bigint NOT NULL REFERENCES colores(id)
                                ON DELETE NO ACTION ON UPDATE CASCADE
    , PRIMARY KEY(animal_id, color_id)
);

INSERT INTO animales_colores (animal_id, color_id)
     VALUES (1, 2)
          , (1, 3)
          , (1, 5)
          , (2, 1)
          , (2, 5);

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
