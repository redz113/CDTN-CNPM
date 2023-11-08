<div class="fixed-top">
        <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+098 999 9999</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>edu90minute@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
  
  
  <!-- Navbar Start -->
  <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-2 px-xl-5">
            <a href="./" class="navbar-brand ml-lg-3">
                <h3 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edu90minute</h3>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between text-uppercase" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="./" class="nav-item nav-link active">Trang chủ</a>
                    <a href="./?ctl=courses" class="nav-item nav-link">Khóa học</a>
                    <a href="./?ctl=exercises" class="nav-item nav-link">Bài tập</a>
                    <a href="" class="nav-item nav-link">Blog</a>
                    <a href="" class="nav-item nav-link">Liên hệ</a>
                </div>
               
                <?php 
                    if(isset($_SESSION['role'])){
                ?>
                    <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle text-white fw-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php 
                                echo "<img class='p-1 nav-item' src='./img/user.png'> " . $_SESSION['name'];
                            ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="text-nav dropdown-item py-2" href="">Thông tin cá nhân</a></li>
                            <li><a class="text-nav dropdown-item py-2" href="">Đổi mật khẩu</a></li>
                            <li><a class="text-nav dropdown-item py-2" href="./logout.php">Đăng xuất</a></li>
                    </ul>
                    </div>
                <?php
                    }
                    else{
                    ?>
                        <a href="Views/users/login.php" class="btn btn-primary py-2 px-4 d-none d-inline-block">Đăng nhập</a>
                        <a href="Views/users/register.php" class="btn btn-success py-2 px-4 d-none d-inline-block">Đăng ký</a>
                    <?php
                    }
                ?>
            </div>
        </nav>
    </div>
</div>
    <!-- Navbar End -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var menuItem = $(".navbar-collapse a");
            var currentIndex = null;

            function updateMenuByIndex(index) {
                menuItem.removeClass('active');

                if (index !== null) {
                    currentIndex = index;
                    menuItem.eq(index).addClass('active');
                }
            }

            menuItem.each(function (index, item) {
                $(item).on('click', function (e) {
                    updateMenuByIndex(index);
                    localStorage.setItem('currentIndex', index);
                });
            });

            var savedIndex = localStorage.getItem('currentIndex');

            if (savedIndex !== null && !isNaN(savedIndex)) {
                currentIndex = parseInt(savedIndex);
            }

            updateMenuByIndex(currentIndex);
        });
    </script>