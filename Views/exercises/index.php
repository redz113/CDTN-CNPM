<div class="modal modal-courses pb-5">
    <span class="btn close-icon ti-close btn-close"><i></i></span>
    <div class="container">
        <div class="row pt-5">
            <h1 class="col-sm-6 text-white">Bài tập khóa học</h1>
            <div class="col-sm-6 search">
                <input type="text" class="form-control border-light py-4 pl-4 pr-5 rounded-pill" name="search" id="search" placeholder="Filter...">
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
                            if($course['price'] != 0) continue;
                            if($course['state'] == 0) continue;
                            if($course['topicId'] == $topic['id']){
                                $model = new BaseModel;
                                $exercises = $model->all('exercises', ['id'], ['courseId = ' . $course['id']]);
                                if(count($exercises) == 0) continue;
                ?>

                <div class="content-search">
                Bài tập <a href="./?ctl=exercises&act=list&courseId=<?php echo $course['id']; ?>" class="text-uppercase"> <?php echo $course['name']; ?> </a>
                </div>
                
                <?php }}} ?>
                
            </div>

        <?php }} ?>

    </div>
</div>

<script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".content-search").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

