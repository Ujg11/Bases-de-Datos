use hospitals_sq;

/* Creem la taula Tipus */
CREATE TABLE tipus
select distinct null as id_type, hosp_type as type_info
from hospitals;

alter table tipus 
modify id_type int auto_increment primary key;

/* Posem la columna id_type a hospitals com a foreign i borrem la columna type_info */
alter table hospitals
add column id_type int,
add foreign key (id_type) references tipus (id_type);

update hospitals
join tipus on hospitals.hosp_type = tipus.type_info
set hospitals.id_type = tipus.id_type;

alter table hospitals
drop column hosp_type;

alter table hospitals
modify id_type int after phone;


/* Creem la taula Propietaris */
CREATE TABLE propietaris
select distinct null as id_owner, ownership as owner_info
from hospitals;

alter table propietaris
modify id_owner int auto_increment primary key;

/* Posem la columna id_owner a hospitals com a foreign i borrem la columna ownership */
alter table hospitals
add column owner_code int,
add foreign key (owner_code) references propietaris (id_owner);

update hospitals
join propietaris on hospitals.ownership = propietaris.owner_info
set hospitals.owner_code = propietaris.id_owner;

alter table hospitals
drop column ownership;

alter table hospitals
modify owner_code int after id_type;

/* Creem la taula comtat amb tot el que hi necessitem */
CREATE TABLE comtat
select distinct null as id_county, county as county_name
from hospitals
order by county_name;

delete from comtat where county_name = "";

alter table comtat
modify id_county int auto_increment primary key first;

/* Esborrem la columna couty d'hospitals i hi afegim la columna id_county que sera una clau foranea de condat */
alter table hospitals
add column id_county int,
add foreign key (id_county) references comtat (id_county);

update hospitals
join comtat on hospitals.county = comtat.county_name
set hospitals.id_county = comtat.id_county;

alter table hospitals
drop column county;

alter table hospitals
modify id_county int after adress;

/* Creem la taula Ciutat */
CREATE TABLE ciutat (
	id_city int auto_increment,
    city_name varchar(45),
    id_county int,
    primary key (id_city)
);

insert into ciutat
select distinct null as id_city, city, id_county
from hospitals;

ALTER TABLE ciutat
ADD FOREIGN KEY (id_county) REFERENCES comtat(id_county);

alter table hospitals
drop column city;