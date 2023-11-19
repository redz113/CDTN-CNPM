<div class="container-fluid pb-4">
    <div class="row">
        <h3 class="col float-left">Thông tin bài giảng</h3>
        <a href="./?ctl=lessons&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="d-inline-block btn btn-primary px-3 mr-2 float-right">Quản lý bài tập</a>
    </div>
    
    <!-- <div class="row"> -->
        <div class="row mb-2">
            <h5 class="pl-sm-3 font-weight-bold ">Bài giảng:
                <span class="text-uppercase text-success"><?php echo $lesson['name'];?></span>
            </h5>
        </div>

        <div class="row mb-2">
            <h5 class="pl-md-3 font-weight-bold ">Khóa học:
                <span class="text-uppercase text-danger"><?php echo $lesson['courseId'];?></span>
            </h5>
        </div>

        <div class="row mb-2">
            <h5 class="pl-md-3 font-weight-bold ">Ngày tạo:
                <span class="text-uppercase text-warning"> 
                    <?php 
                        $date = date_create($lesson['created_at']);
                        echo date_format($date, 'd/m/Y') 
                    ?>
                </span>
            </h5>     
        </div>

    
    <h5>Nội dung bài giảng</h5>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe id="selectedFile" class="embed-responsive-item" src="<?php echo $lesson['fileUpload']; ?>" allowfullscreen></iframe>
    </div>
</div>

