<div class="mb-3">
    <div class="form-group">
        <lable class="form-lable">Tên khóa học:</lable>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên khóa học" value="<?php 
                if(isset($_POST['name']) && trim($_POST['name']) != ""){
                    echo $_POST['name'];
                }
                if(isset($courseEdit)){echo $courseEdit['name'];}
            ?>">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <lable class="form-lable">Mô tả:</lable>
        <input class="form-control" type="text" name="described" value=
        "<?php 
            if(isset($_POST['described']) && trim($_POST['described']) != ""){
                echo $_POST['described'];
            }
            if(isset($courseEdit)){echo $courseEdit['described'];}
        ?>"
        placeholder="Mô tả về khóa học">
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group required">
                <lable class="form-lable">Giá</lable>
                <input type="number" name="price" class="form-control" min=0 
                value="<?php 
                if(isset($_POST['price'])){
                    echo $_POST['price'];
                }elseif(isset($courseEdit)){
                    echo $courseEdit['price'];
                }
                else {echo '0';}
                ?>">
            </div>
        </div>


        <div class="col-sm-3">
            <div class="form-group required">
                <lable class="form-lable">Phân loại:</lable>
                <select name="topicId" id="topicId" aria-placeholder="Chọn chủ đề" class="form-control">
                    <?php
                            foreach($topics as $value){
                    ?>
                            <option 
                            <?php
                                if((isset($_POST['topicId']) && $_POST['topicId'] == $value['name']) 
                                    || (isset($courseEdit['topicId']) && $courseEdit['topicId'] == $value['name'])){
                                    echo " selected ";
                                }
                            ?>
                            value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?> </option>
                                                
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label class="form-label mb-0">Khóa học liên quan</label>
                <select name="relate" class="form-control text-uppercase">
                    <option value="null">--------</option>
                    <?php
                        foreach($courses as $value){
                    ?>
                        <option <?php if($courseEdit['id'] == $value['id']) echo "selected"; ?> value="<?php echo $value['relate']; ?>"><?php echo $value['name']; ?></option>
                    <?php   
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="row">
        <div class="col-sm-6">
            <label class="form-label">Yêu cầu</label>
            <textarea name="inputs" class="form-control" placeholder="Các kiến thức cần nắm được trước khi học khóa học..." rows="6"><?php 
                if(isset($_POST['inputs']) && trim($_POST['inputs']) != ""){
                    echo $_POST['inputs'];
                }
                if(isset($courseEdit)){echo $courseEdit['inputs'];}
                ?></textarea>
        </div>
        <!-- <div class="col-sm-6">
            <label class="form-label">Đầu ra</label>
            <textarea name="outputs" id="outputs" class="form-control" placeholder="Khững kiến thức thu được sau khóa học..." rows="6"><?php 
                if(isset($_POST['outputs']) && trim($_POST['outputs']) != ""){
                    echo $_POST['outputs'];
                }
                if(isset($courseEdit)){echo $courseEdit['outputs'];}
                ?></textarea>
        </div> -->
    </div>
</div>

<div class="mb-3">
    <div class="row">
        <!--Image-->
        <div class="col-sm-4">
        <label class="form-label">Image</label>
            <div class="mb-4 d-flex justify-content-center">
                <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                alt="example placeholder" style="width: 300px; height: 160px;" />
            </div>
            <div class="d-flex justify-content-center">
                <div class="btn btn-primary btn-rounded">
                    <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                    <input name="fileUpload" type="file" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
                </div>
            </div>
        </div>

        <div class="col-sm-8">
        <label class="tags">Tags name</label>
            <div class="row">
                <?php
                    foreach($tags as $value){
                ?>
                    <div class="col-sm-3 mb-2 text-uppercase">
                        <input 
                        <?php
                            if(isset($courseEdit)){
                                $tagsEdit = explode(" ", $courseEdit['tags']);
                                if(in_array($value['name'], $tagsEdit)){ echo "checked"; }
                            }
                        ?> 
                        type="checkbox" name="tag<?php echo $value['id']; ?>" value="<?php echo $value['name']; ?>"> <?php echo $value['name']; ?>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <input type="hidden" name="totalTag" value="<?php echo count($tags); ?>">
</div>

<script>
    fileUpload.onchange = evt => {
    const [file] = fileUpload.files
    if (file) {
        showImg.src = URL.createObjectURL(file)
    }
    }

    function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>


