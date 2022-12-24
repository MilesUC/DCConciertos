CREATE OR REPLACE FUNCTION validar_login(usu varchar(100), pas varchar(30))

RETURNS BOOLEAN AS $$

DECLARE

BEGIN
  -- Se buscan los tipos de usuarios

  IF ((SELECT COUNT(*) FROM usuarios WHERE username like usu AND contrasena like pas) > 0) THEN
    RETURN TRUE;

  ELSE 
	RETURN FALSE;
					
  END IF;


END 
$$ language plpgsql