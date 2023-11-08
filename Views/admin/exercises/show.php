<div class="container-fluid">
    <div class="row">
        <h3 class="col float-left">Thông tin bài tập</h3>
        <a href="./?ctl=exercises&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="d-inline-block btn btn-primary px-3 mr-2 float-right">Quản lý bài tập</a>
    </div>
    
    <div class="row mb-2">
        <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Tên bài tập:</h6>
        <div class="col-auto ml-2 pl-sm-4"> <?php echo $exercise['name']; ?> </div>
    </div>
    
    <div class="row mb-2">
        <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Độ khó:</h6>
        <div class="col-auto ml-2 pl-sm-4"> <?php echo $exercise['level']; ?> </div>
    </div>

    
    <div class="row mb-2">
        <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Bài tập khóa học:</h6>
            <div class="col-auto ml-2 pl-sm-4"> 
                <?php
                    foreach($courses as $course) {
                        if($course['id'] == $exercise['courseId']){
                            echo $course['name'];
                        }
                    }
                ?> 
            </div>
    </div>

    
    <h5>Nội dung bài tập</h5>
    <div class="mb-2 px-5 py-3 bg-dark mx-5" >
        <?php echo $exercise['content'] ?>
    </div>
</div>

