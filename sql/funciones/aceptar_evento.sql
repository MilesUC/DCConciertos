CREATE OR REPLACE FUNCTION aceptar_evento(id_evento integer)

RETURNS void AS $$

DECLARE
  aceptado integer;
  revisar integer;

BEGIN
    SELECT aprobado FROM nuevos_eventos WHERE id = id_evento INTO revisar;
    IF revisar = 0 THEN
      aceptado := 1;   
      UPDATE nuevos_eventos SET aprobado = aceptado WHERE id = id_evento;
    END IF;

END 
$$ language plpgsql