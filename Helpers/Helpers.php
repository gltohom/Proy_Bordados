<?php
    function base_url()
    {
        return BASE_URL;
    }

    //retorna la url de Assets
    function media()
    {
        return BASE_URL."/Assets";
    }

    //para trabajar de forma divida el archivo de vista
    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    }
    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);
    }

    //para limiar array
    function dep($data)
    {
        $format     = print_r('<pre>');
        $format    .= print_r($data);
        $format    .= print_r('</pre>');
        return $format;
    }
    //funcion para llamar al modal
    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //para la extracción de permisos de los usuarios segun el rol que tengan
    function getPermisos(int $idmodulo)
    {
        require_once ("Models/PermisosModel.php");
        $objPermisos = new PermisosModel();
        $idrol = $_SESSION['userData']['idRol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        //validación de permisos
        $permisos = '';
        $permisosMod = '';
        if(count($arrPermisos) > 0 )
        {
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;
    }
    
    //funcion para limpiar los excesos de espacions en cadenas
    function strClean($strCadena)
    {
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ', ''], $strCadena);
        $string = trim($string); //elimina espacios en blanco
        $string = stripslashes($string); // elimina diagonale invertidas \
        $string = str_ireplace("<script>","", $string);
        $string = str_ireplace("</script>","", $string);
        $string = str_ireplace("<script src>","", $string);
        $string = str_ireplace("<script type=>","", $string);
        $string = str_ireplace("SELECT * FROM","", $string);
        $string = str_ireplace("DELETE FROM","", $string);
        $string = str_ireplace("INSERT INTO","", $string);
        $string = str_ireplace("SELECT COUNT(*) FROM","", $string);
        $string = str_ireplace("DROP TABLE","", $string);
        $string = str_ireplace("OR '1'='1","", $string);
        $string = str_ireplace('OR "1"="1"', "", $string);
        $string = str_ireplace('OR ´1´=´1´',"", $string);
        $string = str_ireplace("is NULL; --","", $string);
        $string = str_ireplace("is NULL; --","", $string);
        $string = str_ireplace("LIKE '","", $string);
        $string = str_ireplace('LIKE "',"", $string);
        $string = str_ireplace("LIKE ´","", $string);
        $string = str_ireplace("OR 'a'='a","", $string);
        $string = str_ireplace('OR "a"="a',"", $string);
        $string = str_ireplace("OR ´a´=´a","", $string);
        $string = str_ireplace("OR ´a´=´a","", $string);
        $string = str_ireplace("--","", $string);
        $string = str_ireplace("^","", $string);
        $string = str_ireplace("[","", $string);
        $string = str_ireplace("]","", $string);
        $string = str_ireplace("==","", $string);
        
        return $string;
    }

    //para recuperar contraseña
    function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .=substr($cadena,$pos,1);
        }
        return $pass;
    }

    //para generar token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    //formato para valores monetarios
    function formatMoney($cantidad)
    {
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }
?>