<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Learn90minute</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

    <link href="./css/myStyle.css" rel="stylesheet">
</head>

<body>
    <?php
            session_start();
            require_once "./Controllers/BaseController.php";
            require_once "./Core/Database.php";
            require_once "./Models/BaseModel.php";

            // $_SESSION['role'] = 2;           //  user - Admin 
            // session_destroy();
            $role = [];
            if(isset($_SESSION['role'])) {
                $model = new BaseModel();
                $_SESSION['permissions'] = $model->getPermissionName();
            }

            if(isset($_SESSION['role']) && count($_SESSION['permissions']) > 0) {
                require_once("Views/admin/index.php"); 
            }else{
                include("Views/menu.php");
                include("Views/main.php");
                include("Views/footer.php");
            }
        ?>   
    

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Jquery -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- ckeditor JS-->
    <!-- <script src="./ckeditor/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
</body>

</html> 