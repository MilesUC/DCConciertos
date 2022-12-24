CREATE OR REPLACE FUNCTION get_tipo(usu varchar(100), pas varchar(30))

RETURNS varchar(10) AS $$

DECLARE

BEGIN
  -- Se buscan los tipos de usuarios

  SELECT tipo FROM usuarios WHERE username=usu AND contrasena=pas;

END 
$$ language plpgsql