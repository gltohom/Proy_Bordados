<?php
    //para convertir la primera letra en mayuscula de las clases
    $controller = ucwords($controller);
    //load, validacion de archivos
    $controllerFile = "Controllers/".$controller.".php";
    if(file_exists($controllerFile))
    {
        require_once($controllerFile);
        $controller = new $controller();
        if(method_exists($controller, $method))
        {
            $controller->{$method}($params);
        }
        else
        {
            require_once("Controllers/Error.php");
        }
    }
    else
    {
        require_once("Controllers/Error.php");
    }
?>