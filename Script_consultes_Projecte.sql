-- Sentencia: Quin comtat és el que te més hospitals?
select c.*, count(*) as total_hospitals
from condat c join hospitals h on c.id_county = h.id_county
group by id_county
having count(*) >= all (select count(*)
						from hospitals
                        group by id_county);

-- Sentencia: mostra quants hospitals té cada propietari
select owner_code, owner_info, count(*) total_hospitals
from hospitals h
join propietaris on owner_code = id_owner
group by owner_code;


-- select id_hospital from hospitals where id_hospital = 1;
