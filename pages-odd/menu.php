  <!-- Navbar Start -->
  <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edu90minute</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="./" class="nav-item nav-link active">Trang chủ</a>
                    <a href="" class="nav-item nav-link">Khóa học</a>
                    <a href="" class="nav-item nav-link">Bài tập</a>
                    <a href="" class="nav-item nav-link">Blog</a>
                    <a href="" class="nav-item nav-link">Liên hệ</a>
                </div>
                <a href="" class="btn btn-primary py-2 px-4 d-none d-lg-block">Join Us</a>
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