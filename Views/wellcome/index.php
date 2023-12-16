<?php include("Views/header.php"); ?>
<main class="m-0 py-4 px-lg-5" style="background-color: #D9EEE1;">

<h2 class="text-center text-uppercase mb-0 p-1">Khóa học miễn phí</h2>
<div class="bg-dark w-75 m-auto rounded-pill" style="height: 4px;"></div>
<div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
			<!-- begin khóa học -->
            <?php 
    if(count($courses) > 0){
        foreach($courses as $course) {
            if($course['price'] > 0) continue;
            if($course['state'] == 0) continue;
    ?>
			  <div class="col mt-3 pr-0">
			    <div class="card">
			      <img src="<?php echo $course['fileUpload']; ?>" class="card-img-top" height = "200vh" alt="Course Image">
			      <div class="card-body">
			        <h5 class="card-title text-capitalize mb-0"><?php echo $course['name']; ?></h5>
			        <strong class="font-italic"><?php echo $course['described']; ?></strong>
                    <div class="m-0 card-text">Ngày tạo: <?php echo date_format(date_create($course['created_at']), 'd/m/Y'); ?></div>
                    <div class="card-text">Lượt truy cập: <span class="text-primary"><?php echo $course['interact']; ?></span></div>
			        <a href="./?ctl=lessons&courseId=<?php echo $course['id']; ?>" class="d-block mt-2 btn btn-primary text-uppercase">Vào học</a>
			      </div>
			    </div>
			  </div>

	<?php 
		}}
	?>				
</div>


<h2 class="text-center text-uppercase mb-0 p-1">Khóa học trả phí</h2>
<div class="bg-dark w-50 m-auto rounded-pill" style="height: 4px;"></div>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
			<!-- begin khóa học -->
            <?php 
    if(count($courses) > 0){
        foreach($courses as $course) {
            if($course['price'] == 0) continue;
    ?>
			  <div class="col mt-3 pr-0">
			    <div class="card">
			      <img src="<?php echo $course['fileUpload']; ?>" class="card-img-top" height = "200vh" alt="Course Image">
			      <div class="card-body">
			        <h5 class="card-title text-capitalize mb-0"><?php echo $course['name']; ?></h5>
			        <strong class="font-weight-light font-italic"><?php echo $course['described']; ?></strong>
                    <h6 class="m-0">Ngày tạo: <?php echo date_format(date_create($course['created_at']), 'd/m/Y'); ?></h6>
                    <h6>Lượt truy cập: <span class="text-primary"><?php echo $course['interact']; ?></span></h6>
			        <div class="row mt-2 justify-content-center">
                        <a href="./?ctl=lessons&courseId=<?php echo $course['id']; ?>" class="col-auto btn btn-primary m-1 text-uppercase">Học thử</a>
                        <a href="#" class="col-auto btn btn-success m-1"><?php echo "BUY " . number_format($course['price'], 0, ',', '.'); ?> đ</a>
                    </div>
			      </div>
			    </div>
			  </div>

	<?php 
		}}
	?>				
</div>

</main>
