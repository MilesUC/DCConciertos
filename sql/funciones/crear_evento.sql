CREATE OR REPLACE FUNCTION crear_evento(nombre text, artista text, recinto text, productora text, 
                                        fecha_inicio date, fecha_termino date)

RETURNS void AS $$

DECLARE
  nuevo_evento_id integer;
  max_id integer;

BEGIN

    SELECT MAX(id) INTO max_id FROM nuevos_eventos;
    nuevo_evento_id := max_id + 1;

    IF max_id is NULL THEN
      max_id := 0;
    END IF;

    INSERT INTO nuevos_eventos VALUES (nuevo_evento_id, 
                                      nombre, 
                                      artista, 
                                      recinto, 
                                      productora, 
                                      fecha_inicio,
                                      fecha_termino,
                                      0);

END 
$$ language plpgsql