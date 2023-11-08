<div class="mb-3">
    <div class="form-group">
        <lable class="form-lable">Tên bài tập:</lable>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên bài tập" value="<?php 
                if(isset($_POST['name']) && trim($_POST['name']) != ""){
                    echo $_POST['name'];
                }
                if(isset($exerciseEdit)){echo $exerciseEdit['name'];}
            ?>">
    </div>
</div>

<div class="mb-3">
    <div class="row">
        <div class="col-sm-6">
            <strong>Độ khó</strong>
            <select class="form-select" aria-label="Default select example" name="level" id="selected_level">
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 1) ? "selected" : ""; ?> value="1">Dễ</option>
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 2) ? "selected" : ""; ?> value="2">Trung bình</option>
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 3) ? "selected" : ""; ?> value="3">Khó</option>
            </select>
        </div>

        <div class="col-sm-6">
            <strong>Bài tập khóa học:</strong>
            <select name="courseId" id="selected_phanloai" aria-placeholder="Chọn chủ đề" class="Form-control">
                <?php
                    if(isset($courses)){
                        foreach($courses as $value){
                ?>
                            <option 
                            <?php
                                if((isset($_POST['courseId']) && $_POST['courseId'] == $value['id']) 
                                    || (isset($exerciseEdit['courseId']) && $exerciseEdit['courseId'] == $value['id'])){
                                    echo " selected ";
                                }
                            ?>
                            value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php }
            } ?>
            </select>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <label class="form-label">Nội dung bài tập</label>
        <textarea name="content" id="content" class="form-control" placeholder="Nhập nội dung bài tập..." rows="6"><?php 
            if(isset($_POST['content']) && trim($_POST['content']) != ""){
                echo $_POST['content'];
            }
            if(isset($exerciseEdit)){echo $exerciseEdit['content'];}
            ?>
        </textarea>
        <!-- <script>
            CKEDITOR.replace( 'content' );
        </script> -->
    </div>
</div>


