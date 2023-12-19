<div class="fixed-top">  
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
                            <!-- <li><a class="text-nav dropdown-item py-2" href="./?ctl=base&act=interfaceConvert&ai=1">Giao diện trang quản trị</a></li> -->
                            
                            <li><a class="text-nav dropdown-item py-2" href="Views/users/userinfo.php">Thông tin cá nhân</a></li>
                            <li><a class="text-nav dropdown-item py-2" href="Views/users/changepass.php">Đổi mật khẩu</a></li>
                            <li><a class="text-nav dropdown-item py-2" href="./logout.php">Đăng xuất</a></li>
                    </ul>
                    </div>
                <?php
                    }
                    else{
                    ?>
                        <a href="Views/users/login.php" class="btn btn-primary py-2 px-4 d-none d-inline-block">Đăng nhập</a>
                        <!-- <a href="Views/users/register.php" class="btn btn-success py-2 px-4 d-none d-inline-block">Đăng ký</a> -->
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>