<!-- Admin -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="css/adminStyle.css">

<body id="body-pd" class="body-pd">
    <header class="header body-pd" id="header">
        <div class="header_toggle"> <i class='bx bx-menu-alt-left bx-menu-alt-right' id="header-toggle"></i> </div>
        <div class="row">
            <div class="header_img"> <img src="https://cdn-icons-png.flaticon.com/512/1053/1053244.png" alt=""></div>
            <h5 class="ml-2 mb-0 align-self-center"> <?php echo isset($_SESSION['name']) ? $_SESSION['name'] :'Admin-No-Name' ?> </h5>
        </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div> <a href="./" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Edu90minute</span> </a>
                <div class="nav_list"> 

                    <?php
                        if(in_array("user-access", $_SESSION['permissions'])){
                    ?>
                    <!-- BEGIN HTML -->
                        <a href="./?us=<?php echo rand(1, 100) ?>&act=index" class="nav_link"> 
                            <i class='bx bx-user nav_icon'></i> 
                            <span class="nav_name">Tài khoản</span> 
                        </a> 
                    <!-- END HTML -->
                    <?php
                        }
                    ?>


                    <?php
                        if(in_array("course-access", $_SESSION['permissions'])){
                    ?>
                    <!-- BEGIN HTML -->
                        <a href="./?ctl=courses" class="nav_link"> 
                            <i class='bx bx-bookmark nav_icon'></i> 
                            <!-- <i class='bx bx-grid-alt nav_icon'></i>  -->
                            <span class="nav_name">Khóa học</span> 
                        </a> 
                    <!-- END HTML -->
                    <?php
                        }
                    ?>


                    <?php
                        if(in_array("lesson-access", $_SESSION['permissions'])){
                    ?>
                    <!-- BEGIN HTML -->
                        <a href="./?ctl=lessons" class="nav_link"> 
                            <i class='bx bx-folder nav_icon'></i> 
                            <!-- <i class='bx bx-user nav_icon'></i>  -->
                            <span class="nav_name">Bài giảng</span> 
                        </a>
                    <!-- END HTML -->
                    <?php
                        }
                    ?>


                    <?php
                        if(in_array("exercise-access", $_SESSION['permissions'])){
                    ?>
                    <!-- BEGIN HTML -->
                        <a href="./?ctl=exercises" class="nav_link"> 
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                            <!-- <i class='bx bx-message-square-detail nav_icon'></i>  -->
                            <span class="nav_name">Bài tập</span> 
                        </a> 
                    <!-- END HTML -->
                    <?php
                        }
                    ?>
                   
                    
                   <?php
                        if(in_array("role-access", $_SESSION['permissions'])){
                    ?>
                    <!-- BEGIN HTML -->
                        <a href="./?ctl=roles" class="nav_link"> 
                            <i class='bx bx-bookmark nav_icon'></i> 
                            <span class="nav_name">Phân quyền</span> 
                        </a> 
                    <!-- END HTML -->
                    <?php
                        }
                    ?>
                </div>
                
            </div> <a href="./logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        
        <?php 
            include("Views/admin/mainAdmin.php");
        ?>

    </div>
    <!--Container Main end-->
</body>





<script>
    document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-menu-alt-right')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });
</script>