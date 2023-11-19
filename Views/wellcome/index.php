<?php include("Views/header.php"); ?>
<main class="m-0 py-4 px-lg-5" style="background-color: #D9EEE1;">
<h2 class="bg-info text-center text-uppercase mb-0 p-2">Khóa học Free</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
			<!-- begin khóa học -->
            <?php 
    if(count($courses) > 0){
        foreach($courses as $course) {
            if($course['price'] > 0) continue;
    ?>
			  <div class="col mt-3">
			    <div class="card">
			      <img src="<?php echo $course['fileUpload']; ?>" class="card-img-top" height = "200vh" alt="Course Image">
			      <div class="card-body">
			        <h5 class="card-title text-capitalize mb-0"><?php echo $course['name']; ?></h5>
			        <strong class="font-weight-light font-italic"><?php echo $course['described']; ?></strong>
                    <h6 class="m-0">Ngày tạo: <?php echo date_format(date_create($course['created_at']), 'd/m/Y'); ?></h6>
                    <h6>Lượt truy cập: <?php echo $course['interact']; ?></h6>
			        <a href="./?ctl=lessons" class="d-block mt-2 btn btn-primary text-uppercase">Vào học</a>
			      </div>
			    </div>
			  </div>

	<?php 
		}}else{
            echo "<h3 class='text-danger'>Không tìm thấy!!!</h3>";
        }
	?>				
</div>

<h2 class="bg-warning text-center text-uppercase mb-0 p-2">Khóa học trả phí</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
			<!-- begin khóa học -->
            <?php 
    if(count($courses) > 0){
        foreach($courses as $course) {
            if($course['price'] == 0) continue;
    ?>
			  <div class="col mt-3">
			    <div class="card">
			      <img src="<?php echo $course['fileUpload']; ?>" class="card-img-top" height = "200vh" alt="Course Image">
			      <div class="card-body">
			        <h5 class="card-title text-capitalize mb-0"><?php echo $course['name']; ?></h5>
			        <strong class="font-weight-light font-italic"><?php echo $course['described']; ?></strong>
                    <h6 class="m-0">Ngày tạo: <?php echo date_format(date_create($course['created_at']), 'd/m/Y'); ?></h6>
                    <h6>Lượt truy cập: <?php echo $course['interact']; ?></h6>
			        <div class="row mt-2 justify-content-center">
                        <a href="#" class="col-auto btn btn-primary m-1 text-uppercase">Học thử</a>
                        <a href="#" class="col-auto btn btn-success m-1 text-uppercase">Mua <?php echo $course['price']; ?> VND</a>
                    </div>
			      </div>
			    </div>
			  </div>

	<?php 
		}}else{
            echo "<h3 class='text-danger'>Không tìm thấy!!!</h3>";
        }
	?>				
</div>