
<main class="pt-5">
<?php 
    if(isset($_GET['us'])){
        $link = "accounts/". $_GET['act'] . '.php';
        include_once($link);
    }
    else{
    //xử lý truy cập trái phép
    if(isset($_REQUEST['ctl'])){
        $ctl = substr($_REQUEST['ctl'],0,-1) ."-access";
        if(!in_array($ctl, $_SESSION['permissions'])){
            $_REQUEST['ctl'] = null;          //Quay về trang index
        }
    }

    $controllerName = (ucfirst(strtolower($_REQUEST['ctl'] ?? 'Wellcome'))) . 'Controller';
    
    $actionName = $_REQUEST['act'] ?? 'index';
    

    // echo $controllerName;
    if(isset($_SESSION['permissions']) && count($_SESSION['permissions']) > 0){    // Admin | QTND
        $controllerName = 'Admin' . $controllerName;
        require_once "./Controllers/Admin/${controllerName}.php";
    }else require_once "./Controllers/${controllerName}.php";
    $controllerObj = new $controllerName;
    $controllerObj->$actionName();
    }
?>  
</main>
