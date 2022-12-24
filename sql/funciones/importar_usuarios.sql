CREATE OR REPLACE FUNCTION importar_usuarios()

RETURNS void AS $$

DECLARE
  artista RECORD;
  productora RECORD;
  tupla_artista RECORD;
  tupla_productora RECORD;
  nombre VARCHAR(100);
  valor_contrasena VARCHAR(25);

BEGIN
  -- Se buscan los tipos de usuarios
  artista := NULL;
  productora := NULL;

  IF EXISTS(SELECT * FROM pg_tables WHERE tablename='usuarios') THEN
    IF ((SELECT COUNT(*) FROM usuarios WHERE tipo = 'artista') > 0) THEN
      artista := TRUE;
    END IF;
    IF ((SELECT COUNT(*) FROM usuarios WHERE tipo = 'productora') > 0) THEN
      productora := TRUE;
    END IF;

  ELSE 
	create table usuarios(
	id SERIAL PRIMARY KEY,
	username varchar(100),
	contrasena varchar(25),
    tipo varchar(10));
					
  END IF;



  IF artista IS NULL THEN

    FOR tupla_artista IN (SELECT * FROM artistas)

    LOOP
      IF (SELECT COUNT(username) FROM usuarios WHERE username=LOWER(REPLACE(tupla_artista.nombre_artistico, ' ', '_'))) = 0 THEN
        -- Generar contrasena
        SELECT floor(random() * (999999999-100 + 1) + 100) INTO valor_contrasena;
        SELECT LOWER(REPLACE(tupla_artista.nombre_artistico, ' ', '_')) INTO nombre;
        INSERT INTO usuarios (username, tipo, contrasena) VALUES (nombre, 'artista', valor_contrasena);
      END IF;
    END LOOP;

  END IF;  

  IF productora IS NULL THEN

    FOR tupla_productora IN (SELECT * FROM 
                            public.dblink('dbname=grupo22e3
                            port=5432
                            password=grupo22
                            user=grupo22',
                            'SELECT * FROM productoras')
                            AS f(id_productora varchar, nombre varchar, pais varchar))

    LOOP
      IF (SELECT COUNT(username) FROM usuarios WHERE username=LOWER(REPLACE(tupla_productora.nombre, ' ', '_'))) = 0 THEN
          -- Generar contrasena
          SELECT floor(random() * (999999999-100 + 1) + 100) INTO valor_contrasena;
          SELECT LOWER(REPLACE(tupla_productora.nombre, ' ', '_')) INTO nombre;
          INSERT INTO usuarios (username, tipo, contrasena) VALUES (nombre, 'productora', valor_contrasena);
      END IF;
  END LOOP;
  END IF;

END 
$$ language plpgsql