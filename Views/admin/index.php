<?php

?>



<!-- Admin -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
<link rel="stylesheet" href="./css/adminStyle.css">
<div>
<header class="header pl-1" id="header">
    <div class="">
        <a href="." class="btn nav_logo text-uppercase"> <i class='text-white bx bx-layer h3'></i> <span class="text-white h3">Edu90minute</span> </a>
        <div class="btn"> <i id="menu-toggle" class="bx bx-menu"></i> </div>
    </div>
    <div class="dropdown">
            <a class="btn dropdown-toggle text-white fw-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php 
                        echo "<img class='p-1 nav-item' src='./img/user.png'> " . $_SESSION['name'];
                    ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="text-nav dropdown-item py-2" href="./?ctl=base&act=interfaceConvert&ui=1">Giao diện người dùng</a></li>
                    <li><a class="text-nav dropdown-item py-2" href="">Thông tin cá nhân</a></li>
                    <li><a class="text-nav dropdown-item py-2" href="./?act=resetpassword&us=1">Đổi mật khẩu</a></li>
                    <li><a class="text-nav dropdown-item py-2" href="./logout.php">Đăng xuất</a></li>
            </ul>
            </div>
</header>
<div id="wrapper" class="menuDisplayed">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
            <!-- <li>
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Dropdown</a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">1</li>
                    <li class="dropdown-item">2</li>
                    <li class="dropdown-item">3</li>
                </ul>
            </li> -->
      <?php
            if(in_array("user-access", $_SESSION['permissions'])){
                echo "
                    <li class='pl-4'><a href='./?us=" .rand(1, 100) . "&act=index'>Tài khoản</a></li>";
                }
            ?>


            <?php
                if(in_array("course-access", $_SESSION['permissions'])){
                    echo "<li class='pl-4'><a href='./?ctl=courses'>Khóa học</a></li>";
                }
            ?>


            <?php
                if(in_array("lesson-access", $_SESSION['permissions'])){
                    echo "<li class='pl-4'><a href='./?ctl=lessons' >Bài giảng</a></li>";
                }
            ?>


            <?php
                if(in_array("exercise-access", $_SESSION['permissions'])){
                    echo "<li class='pl-4'><a href='./?ctl=exercises'>Bài tập</a></li>";
                }
            ?>
            
            
            <?php
                if(in_array("role-access", $_SESSION['permissions'])){
                    echo "<li class='pl-4'><a href='./?ctl=roles'>Phân quyền</a></li>";
                }
            ?>
      </ul>
    </div>
    
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php
                include("Views/admin/mainAdmin.php");
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script>
    $(document).ready(function(){
    $("#menu-toggle").click(function(e){
        e.preventDefault();
        $("#wrapper").toggleClass("menuDisplayed");
    });
    });
</script>