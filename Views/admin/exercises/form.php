<div class="mb-3">
    <div class="form-group">
        <strong class="form-lable">Tên bài tập:</strong>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên bài tập" value="<?php 
                if(isset($_POST['name']) && trim($_POST['name']) != ""){
                    echo $_POST['name'];
                }
                if(isset($exerciseEdit)){echo $exerciseEdit['name'];}
            ?>">
    </div>
</div>

<!-- <div class="mb-3">
    <div class="form-group">
        <strong class="form-lable">Mô tả:</strong>
        <input class="form-control" type="text" name="described" value=
        "<?php 
            if(isset($_POST['described']) && trim($_POST['described']) != ""){
                echo $_POST['described'];
            }
            if(isset($exerciseEdit)){echo $exerciseEdit['described'];}
        ?>"
        placeholder="Mô tả về bài tập">
    </div>
</div> -->

<div class="mb-3">
    <div class="row">
        <div class="col-sm-3 form-group">
            <strong class="form-lable">Độ khó</strong>
            <select class="form-control" aria-label="Default select example" name="level" id="selected_level">
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 1) ? "selected" : ""; ?> value="1">Dễ</option>
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 2) ? "selected" : ""; ?> value="2">Trung bình</option>
                <option <?php echo (isset($_POST['level']) && $_POST['level'] == 3) ? "selected" : ""; ?> value="3">Khó</option>
            </select>
        </div>

        <div class="col-sm-4 form-group">
            <strong class="form-lable">Bài tập khóa học:</strong>
            <select name="courseId" id="selected_phanloai" aria-placeholder="Chọn chủ đề" class="form-control text-uppercase">
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

        <div class="col-sm-4">
            <div class="form-group">
                <strong class="form-label mb-0">Bài tập liên quan</strong>
                <select name="relate" class="form-control text-uppercase">
                    <option value="null">--------</option>
                    <?php
                        foreach($courses as $val){
                            echo "<optgroup label='" . $val['name'] ."'>";
                            foreach($exercises as $value){
                                if(($value['courseId'] != $val['id'])){ continue;}
                    ?>
                                <option <?php if(isset($exerciseEdit['id']) && $exerciseEdit['id'] == $value['id']) echo "selected"; ?>  value="<?php echo $value['relate']; ?>"><?php echo $value['name']; ?></option>
                    <?php   
                        }
                        echo "</optgroup>";
                    } 
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <!--FILE-->
    <div class="col-sm-2">
        <label class="form-label">Upload file bài tập</label>
        <div class="d-flex justify-content-start">
            <div class="btn btn-primary btn-rounded">
                <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                <input name="fileUpload" type="file" class="form-control d-none" id="customFile1" onchange="displayselectedFile(event, 'selectedFile')" />
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <!-- <div class="mb-4 d-flex justify-content-center">
            <img id="selectedFile" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
            alt="example placeholder" style="width: 300px; height: 160px;" />
        </div> -->
        <div class="embed-responsive embed-responsive-16by9">
            <iframe id="selectedFile" class="embed-responsive-item" src="<?php echo (isset($exerciseEdit) ? $exerciseEdit['fileUpload'] : ""); ?>" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    fileUpload.onchange = evt => {
    const [file] = fileUpload.files
    if (file) {
        showImg.src = URL.createObjectURL(file)
    }
    }

    function displayselectedFile(event, elementId) {
    const selectedFile = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedFile.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>


