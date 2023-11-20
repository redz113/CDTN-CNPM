<div class="container">
    <div class="text-light h1 text-center mt-5 mb-0"><?php echo $lessonShow['name']; ?></div>
    <strong class="text-light mt-5">Hà Nội, <?php echo date_format(date_create($lessonShow['created_at']), 'd-m-Y H:s:i'); ?></strong>
    <div class="row mt-3">
        <div class="col-6">
            <a href="" class="btn btn-success rounded px-4 py-2 float-left"><i class="bx bx-left-arrow"></i></a>
        </div>
        <div class="col-6">
            <a href="" class="btn btn-success rounded px-4 py-2 float-right"><i class="bx bx-right-arrow"></i></a>
        </div>
    </div>
    <div class="embed-responsive embed-responsive-16by9 mt-4">
        <iframe class="embed-responsive-item" src="<?php echo $lessonShow['fileUpload']; ?>" allowfullscreen></iframe>
    </div>
</div>

