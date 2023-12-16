
    <?php 
        $controllerName = (ucfirst(strtolower($_REQUEST['ctl'] ?? 'Wellcome'))) . 'Controller';
        
        $actionName = $_REQUEST['act'] ?? 'index';
        

        // echo $controllerName;
        if(isset($_SESSION['role']) && 
            count($_SESSION['permissions']) > 0
            && !isset($_SESSION['ui'])){    // Admin | QTND
            $controllerName = 'Admin' . $controllerName;
            require_once "./Controllers/Admin/{$controllerName}.php";
        }else {
            require_once "./Controllers/{$controllerName}.php";
        }
        $controllerObj = new $controllerName;
        $controllerObj->$actionName();
    ?>  
