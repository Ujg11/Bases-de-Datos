DROP SCHEMA if exists hospitals_sq;
CREATE SCHEMA if not exists hospitals_sq;

use hospitals_sq;

CREATE TABLE hospitals (
	id_hospital varchar(45),
    hospital_name varchar(100) not null,
    adress varchar(100) not null,
    city varchar(45),
    state varchar(10),
    zip_code varchar(45),
    county varchar(45),
    phone varchar(45),
    hosp_type varchar(45),
    ownership varchar(45),
    emergency_service enum('Yes', 'No'),
    primary key (id_hospital)
);

LOAD DATA INFILE 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/Hospital General Information.csv'
	INTO TABLE hospitals
    character set latin1
    FIELDS TERMINATED BY ',' 
    OPTIONALLY ENCLOSED BY '"'
    LINES TERMINATED BY '\r\n' 
    IGNORE 1 LINES
    (id_hospital, hospital_name, adress, city, state, zip_code, @county, phone, hosp_type, ownership,
		emergency_service, @v1, @v2, @v3, @v4, @v5, @v6, @v7, @v8, @v9, @v10, @v11, @v12, @v13, @v14, @v15, @v16, @v17)
	set county = nullif(@county, 'No especificat');

alter table hospitals modify id_hospital int not null;
alter table hospitals modify zip_code int;
alter table hospitals modify phone bigint;
alter table hospitals modify phone varchar(25);
alter table hospitals modify zip_code varchar(25);
alter table hospitals modify ownership varchar(25);



