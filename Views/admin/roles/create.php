<div class="container">
        <div class="card">
            <div class="card-header border-0">
                <div class="float-left">
                    <h2>Tạo quyền mới</h2>
                </div>
                <div class="float-right">
                    <a href="./?ctl=roles&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>

            
            <?php
                if(isset($error)){
                    echo "<div class='badge badge-danger py-2'> " .$error['0'] ."</div>";
                }
            ?>

            <div class="card-body">
                <form action="./?ctl=roles&act=store" name="myForm" method="POST" enctype="multipart/form-data">
                    
                    <div class="row mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Vai trò</strong>
                                <input type="text" name="name" class="form-control" placeholder="Tên vai trò: Quản trị viên, Quản trị nội dung, ...">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Quyền truy cập</strong>
                                <div class="row">
                                <?php
                                    foreach($permissions as $permission){
                                ?>
                                <!-- BEGIN -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="<?php echo $permission['id']; ?>"> <?php echo $permission['name']; ?>
                                        </label>
                                    </div>
                                <!-- END -->
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success px-5 mt-5 float-right" type="submit">Thêm mới</button>
                    
                </form>
            </div>
        </div>
    </div>