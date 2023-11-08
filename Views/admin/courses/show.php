<div class="container-fluid">
    <div class="row">
        <h3 class="col float-left">Thông tin khóa học</h3>
        <a href="./?ctl=courses&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="d-inline-block btn btn-primary px-3 mr-2 float-right">Quản lý khóa học</a>
    </div>
    
    <div class="row">
        <!--  -->
        <div class="col-sm-3 myImg mt-5">
            <img src="<?php echo $course['fileUpload']; ?>" width="100%" height="100%">
        </div>

        <!--  -->
        <div class="col-sm-9 mt-4">
            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold">Tên khóa học:</h6>
                <div class="col ml-2 pl-sm-4 text-wrap"> <?php echo $course['name']; ?> </div>
            </div>
            
            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Mô tả:</h6>
                <div class="col ml-2 pl-sm-4 text-wrap"> <?php echo $course['described']; ?> </div>
            </div>

            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Phân loại:</h6>
                <div class="col ml-2 pl-sm-4"> 
                    <?php 
                        foreach($topics as $value){
                            if($value['id'] == $course['topicId'])
                                echo $value['name'];
                        } 
                    ?> 
                </div>
            </div>

            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Giá bán:</h6>
                <div class="col ml-2 pl-sm-4"> 
                    <?php 
                        echo $course['price'] == 0 ? 
                        "<span class='text-success'>Free</span>" : 
                        $course['price'] . ' VNĐ'; 
                    ?> 
                </div>
            </div>

            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Yêu cầu đầu vào:</h6>
                <div class="col-auto ml-2 pl-sm-4"> <?php echo "<pre class='mb-0'>" . $course['inputs'] . "</pre>"; ?> </div>
            </div>

            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Yêu cầu đầu ra:</h6>
                <div class="col-auto ml-2 pl-sm-4"> <?php echo "<pre class='mb-0'>" . $course['outputs'] ."</pre>"; ?> </div>
            </div>

            <div class="row mb-2">
                <h6 class="col-auto col-xl-3 pl-sm-3 font-weight-bold ">Trạng thái:</h6>
                <div class="col ml-2 pl-sm-4"> 
                    <?php 
                        echo $course['state'] == 0  ? 
                        "<span class='text-danger'>Đang hoàn thiện</span>" : 
                        "<span class='text-success'>Đã hoàn thiện</span>"; 
                    ?> 
                </div>
            </div>
        </div>
    </div>

</div>

