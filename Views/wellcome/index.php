<h1>Các khóa học</h1>
<div class="row d-flex justify-content-center">
    <?php 
        foreach($courses as $course) {
    ?>

    <div class="col-sm-2 m-2 p-4 bg-warning text-center">
        <h2 class="my-3">
            <?php echo $course['name']; ?>
        </h2>

        <h5 class="my-2">
            <?php echo $course['described']; ?>
        </h5>

        <a href="#" class="btn btn-dark px-3 mt-2 rounded-pill">Học <?php echo $course['name']; ?></a>
    </div>

    <?php
        }
    ?>
</div>