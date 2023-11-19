<div class="container">
        <div class="card">
            <div class="card-header border-0">
                <div class="float-left">
                    <h2>Tạo bài giảng</h2>
                </div>
                <div class="float-right">
                    <a href="./?ctl=lessons&rl=1&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary">Quản lý bài giảng</a>
                </div>
            </div>

            
            <?php
                if(isset($error)){
                    echo "<div class='badge badge-danger py-2'> " .$error['0'] ."</div>";
                }
            ?>

            <div class="card-body">
                <form action="./?ctl=lessons&act=store&rl=1" name="myForm" method="POST" enctype="multipart/form-data">
                    <?php require './Views/admin/lessons/form.php'; ?>
                    
                    <button class="btn btn-success px-5 mt-5 float-right" type="submit">Thêm mới</button>
                    
                </form>
            </div>
        </div>
    </div>


