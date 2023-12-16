<div class="row">
	<div class="col-xl-4 col-md-6 mb-3">
		<div class="card card-stats bg-primary">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-light mb-0">Chủ đề</h5>
						<span class="h3 font-weight-bold mb-0 text-white"><?php echo count($topics); ?></span>
					</div>
					<div class="col-auto">
						<div class="btn-icon bg-gradient-red text-white rounded-circle shadow">
							<i class="bx bx-book-bookmark display-4 text-light"></i>
						</div>
					</div>
				</div>
				<div class="row">
					<p class="mt-4 mb-0 text-sm">
						<span class="badge badge-light"><?php echo $topics[0]['name']; ?></span>
						<span class="badge badge-dark"><?php echo $topics[1]['name']; ?></span>
						<span class="badge badge-success"><?php echo $topics[2]['name']; ?></span>
						<span class="badge badge-danger"><?php echo $topics[3]['name']; ?></span>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-3">
		<div class="card card-stats bg-warning">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-light mb-0">Khóa học</h5>
						<span class="h3 font-weight-bold mb-0 text-white"><?php echo count($courses); ?></span>
					</div>
					<div class="col-auto">
						<div class="btn-icon bg-gradient-red text-white rounded-circle shadow">
							<i class="bx bx-buildings display-4 text-light"></i>
						</div>
					</div>
				</div>

				<?php
					$totalInteract = 0;
					$totalState = 0;
					foreach($courses as $value){
						$totalInteract += $value['interact'];
						if($value['state'] == 1) ++$totalState;
					}

					$totalInteract = round(($totalInteract/1000.00), 2);
				?>
				<div class="row">
					<div class="mb-0 text-sm">
						<span class="text-light">Lượt truy cập: </span>
						<span class="text-white mr-2" style="font-weight: bold;"><?php echo $totalInteract; ?>K</span>
						<br>
						<!-- <i class="bx bx-badge-check text-success"></i> -->
						<span class="text-light">Đã hoàn thiện: </span>
						<span class="text-white mr-2" style="font-weight: bold;"><?php echo $totalState; ?></span>
					</div>
					<p class="mt-3 mb-0 text-sm col text-right">
						<a href="./?ctl=courses" class="btn btn-sm btn-success">Xem chi tiết</a>
					</p>
					
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-3">
		<div class="card card-stats bg-danger">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-light mb-0">Học viên</h5>
						<span class="h3 font-weight-bold mb-0 text-white"><?php echo count($users); ?></span>
					</div>
					<div class="col-auto">
						<div class="btn-icon bg-gradient-red text-white rounded-circle shadow">
							<i class="bx bx-user display-4 text-light"></i>
						</div>
					</div>
				</div>
				<div class="row">
					<p class="mt-3 mb-0 text-sm">
						<!-- <span class="text-light">Truy cập: </span>
						<span class="text-white mr-2" style="font-weight: bold;">185.6K</span> -->
					</p>
					<p class="mt-3 mb-0 text-sm col text-right">
						<a href="./?us=1&act=index&role=Học+viên" class="btn btn-sm btn-success">Xem chi tiết</a>
					</p>
					
				</div>
			</div>
		</div>
	</div>
</div>

<h2 class="m-3 mt-5 text-center text-uppercase">Khóa học truy cập nhiều</h2>
<div class="container">
	<div class="row">
		<?php
			$i = 0;
			while($i < 3){
				if(isset($courses[$i])){
		?>
			<div class="col-xl-4 col-md-6 mb-3">
				<a href="./?ctl=courses&act=show&id=<?php echo $courses[$i]['id'] ?>" class="text-decoration-none text-dark">
					<div class="card bg-light">
						<img src="<?php echo $courses[$i]['fileUpload'] ?>" class="card-img-top" style="height: 200px;" alt="">
						<div class="card-body">
							<strong class="card-title text-uppercase"><?php echo $courses[$i]['name'] ?></strong>
							<div class="card-text"><?php echo $courses[$i]['described'] ?></div>
							<div class="card-text">Lượt truy cập: <?php echo $courses[$i]['interact'] ?></div>
						</div>
					</div>
				</a>
			</div>
		<?php
				}
			$i++;
			}
		?>
	</div>
</div>