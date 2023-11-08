<main class="m-0 py-4 px-lg-5" style="background-color: #D9EEE1;">
    <?php 
            $controllerName = (ucfirst(strtolower($_REQUEST['ctl'] ?? 'Wellcome'))) . 'Controller';
            
            $actionName = $_REQUEST['act'] ?? 'index';
            

            // echo $controllerName;
            if(isset($_SESSION['role']) && 
                    ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) && 
                    $controllerName != "Wellcome"){    // Admin | QTND
                $controllerName = 'Admin' . $controllerName;
                require_once "./Controllers/Admin/${controllerName}.php";
            }else require_once "./Controllers/${controllerName}.php";
            $controllerObj = new $controllerName;
            $controllerObj->$actionName();
        ?>  
</main>