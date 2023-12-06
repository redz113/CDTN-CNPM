
    <?php 
        // if(isset($_GET['ai'])){
        //     if(isset($_SESSION['ui'])) 
        //         unset($_SESSION['ui']);
        // }

        $controllerName = (ucfirst(strtolower($_REQUEST['ctl'] ?? 'Wellcome'))) . 'Controller';
        
        $actionName = $_REQUEST['act'] ?? 'index';
        

        // echo $controllerName;
        if(isset($_SESSION['role']) && 
                ($_SESSION['role'] == 1 || $_SESSION['role'] == 2)){    // Admin | QTND
            $controllerName = 'Admin' . $controllerName;
            require_once "./Controllers/Admin/${controllerName}.php";
        }else require_once "./Controllers/${controllerName}.php";
        $controllerObj = new $controllerName;
        $controllerObj->$actionName();
    ?>  
