CREATE OR REPLACE FUNCTION rechazar_evento(id_evento integer)

RETURNS void AS $$

DECLARE
  rechazado integer;
  revisar integer;

BEGIN
    SELECT aprobado FROM nuevos_eventos WHERE id = id_evento INTO revisar;
    IF revisar = 0 THEN
      rechazado := -1;   
      UPDATE nuevos_eventos SET aprobado = rechazado WHERE id = id_evento;
    END IF;

END 
$$ language plpgsql