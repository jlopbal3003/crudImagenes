drop table if exists departamentos;
drop table if exists profesores;

-- Tabla departamentos
create table departamentos(
    id int AUTO_INCREMENT primary key,
    nombre varchar(80) not null,
    img varchar(120) not null
);

-- Tabla profesores
create table profesores(
    id int AUTO_INCREMENT primary key,
    nombre varchar(100) not null,
    apellidos varchar(100) not null,
    departamento_id int,
    constraint fk_profesor_departamento foreign key(departamento_id) references departamentos(id)
     on delete cascade on update cascade

);
