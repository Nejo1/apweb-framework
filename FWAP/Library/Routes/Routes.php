<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 01/01/16
 * Time: 05:07
 */

namespace FWAP\Library\Routes;


class Routes
{
    private $routes;

    public function __construct()
    {
        /** @var  $routerPath */

        $routerPath = 'Config/routes.php';
        ;

        $this->routes = include($routerPath);


    }

    /**
     * @return string
     */
    private function getURI()
    {


        /** @var TYPE_NAME $_SERVER */
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     *
     */
    public function run()
    {



        $uri = $this->getURI();


//
        foreach ($this->routes as $uripattern => $path) {
//
//            echo $uripattern . '<br/>';
//            echo $path. '<br/>';
//            echo $uri;
//
            if (preg_match("~$uripattern~", $uri)) {
//
//                $internaroute = preg_replace(" ~$uripattern~ ", $path,  $uri);
//
//
                $segmento = explode('/', $path);
//
                $controllerName = array_shift($segmento) . 'Controller';

//                echo $controllerName;
                $controllerName = ucfirst($controllerName);
//
//
//
//
                $actionName = 'action' . ucfirst(array_shift($segmento));

                $parameters = $segmento;


                $controllerPath = DIR_FILE . '/Controllers/' . $controllerName . '.php';

                if(file_exists($controllerPath))
                {
                    include_once $controllerPath;

                }

                $objec = new $controllerName;


                $result = call_user_func_array(array($objec, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }
}
