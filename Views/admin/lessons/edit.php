<div class="container">
    <div class="card">
        <div class="card-header border-0">
            <div class="float-left">
                <h2>Sửa khóa học</h2>
            </div>
            <div class="float-right">
                <a href="./?ctl=lessons&rl=1&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary">Quản lý khóa học</a>
            </div>
        </div>

        
        <?php
            if(isset($error)){
                echo "<div class='badge badge-danger py-2'> $error </div>";
            }
        ?>

        <div class="card-body">
            <form action="./?ctl=lessons&act=update&rl=1" name="myForm" method="POST" enctype="multipart/form-data">
                <?php require './Views/admin/lessons/form.php'; ?>

                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : $_GET['id']; ?>">
                
                <a href="./?ctl=lessons&rl=1&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary px-4 mt-5 float-right">Hủy</a>
                <button class="btn btn-success px-5 mt-5 float-right" type="submit">Cập nhật</button>
                
            </form>
        </div>
    </div>
</div>
