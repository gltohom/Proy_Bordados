<?php
    class LoginModel extends Mysql
    {
        private $intIdUsuario;
        private $strUsuario;
        private $strContraseña;

        public function __construct()
        {
            parent::__construct();
        }

        //consulta para login
        public function loginUsuario(string $usuario, string $contraseña)
		{
			$this->strUsuario = $usuario;
			$this->strContraseña = $contraseña;
			$sql = "SELECT idUsuario,estado FROM usuario 
            WHERE usuario = '$this->strUsuario' 
            AND contra = '$this->strContraseña'
            AND estado != 0 ";
			$request = $this->select($sql);
			return $request;
		}

        //obtencion de datos de usuario para mejjorar la experiencia del usuario
        public function sessionLogin(int $idUsuario)
        {
			$this->intIdUsuario = $idUsuario;
			$sql = "SELECT u.idUsuario, u.usuario, p.nombre, p.apellido, r.idRol, r.rol, u.estado
					FROM usuario AS u
					INNER JOIN personal AS p
					INNER JOIN rol AS r
					ON u.idRol = r.idRol AND u.idPersonal = p.idPersonal
					WHERE u.idUsuario = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}
    }
?>