<div class="modal modal-courses pb-5">
    <span class="btn close-icon ti-close btn-close"><i></i></span>
    <div class="container">
        <div class="row pt-5">
            <h1 class="col-sm-6 text-white">Các khóa học</h1>
            <div class="col-sm-6 search">
                <input type="text" class="form-control border-light py-4 pl-4 pr-5 rounded-pill" name="sr-courses" id="sr-courses" placeholder="Filter...">
            </div>
        </div>
        <?php
            if(isset($topics)){
                foreach($topics as $topic){
        ?>
            <div class="col-sm-4 px-5 py-3 float-left">
                <h3 class="text-white"> <?php echo $topic['name']; ?> </h3>
                <?php
                    if(isset($courses)){
                        foreach($courses as $course){
                            if($course['topicId'] == $topic['id']){
                ?>

                <div>
                    Học lập trình <a href="#"> <?php echo $course['name']; ?> </a>
                </div>
                
                <?php }}} ?>
                
            </div>

        <?php }} ?>

    </div>
</div>


