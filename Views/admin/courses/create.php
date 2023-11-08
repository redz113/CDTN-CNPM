<div class="container">
        <div class="card">
            <div class="card-header border-0">
                <div class="float-left">
                    <h2>Tạo khóa học</h2>
                </div>
                <div class="float-right">
                    <a href="./?ctl=courses&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary">Quản lý khóa học</a>
                </div>
            </div>

            
            <?php
                if(isset($error)){
                    echo "<div class='badge badge-danger py-2'> " .$error['0'] ."</div>";
                }
            ?>

            <div class="card-body">
                <form action="./?ctl=courses&act=store" name="myForm" method="POST" enctype="multipart/form-data">
                    <?php require './Views/admin/courses/form.php'; ?>
                    
                    <button class="btn btn-success px-5 mt-5 float-right" type="submit">Thêm mới</button>
                    
                </form>
            </div>
        </div>
    </div>


