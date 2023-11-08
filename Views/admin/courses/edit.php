<div class="container">
    <div class="card">
        <div class="card-header border-0">
            <div class="float-left">
                <h2>Sửa khóa học</h2>
            </div>
            <div class="float-right">
                <a href="./?ctl=courses&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary">Quản lý khóa học</a>
            </div>
        </div>

        
        <?php
            if(isset($error)){
                echo "<div class='badge badge-danger py-2'> $error </div>";
            }
        ?>

        <div class="card-body">
            <form action="./?ctl=courses&act=update" name="myForm" method="POST" enctype="multipart/form-data">
                <?php require './Views/admin/courses/form.php'; ?>

                <div class="mb-3">
                    <div class="form-group">
                        <lable class="form-lable">Trạng thái:</lable>
                        <br>
                        <input class="ml-5" type="radio" 
                        <?php 
                            if(isset($_POST['state']) && $_POST['state'] == 0) echo "checked";
                            if(isset($courseEdit['state']) && $courseEdit['state'] == 0) echo "checked";
                        ?>
                        value="0" name="state"><span class="text-danger mr-5"> Đang hoàn thiện</span>
                        <input type="radio" 
                        <?php 
                            if(isset($_POST['state']) && $_POST['state'] == 1) echo "checked";
                            if(isset($courseEdit['state']) && $courseEdit['state'] == 1) echo "checked";
                        ?>
                        value="1" name="state"><span class="text-success"> Đã hoàn thiện</span>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : $_GET['id']; ?>">
                
                <a href="./?ctl=courses&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary px-4 mt-5 float-right">Hủy</a>
                <button class="btn btn-success px-5 mt-5 float-right" type="submit">Cập nhật</button>
                
            </form>
        </div>
    </div>
</div>
