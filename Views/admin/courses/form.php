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
        <textarea class="form-control" name="described" id="" rows="4"><?php 
                if(isset($_POST['described']) && trim($_POST['described']) != ""){
                    echo $_POST['described'];
                }
                if(isset($courseEdit)){echo $courseEdit['described'];}
            ?></textarea>
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
                <select name="topicId" id="topicId" aria-placeholder="Chọn chủ đề" class="Form-control w-100">
                    <?php
                            foreach($topics as $value){
                    ?>
                            <option 
                            <?php
                                if((isset($_POST['topicId']) && $_POST['topicId'] == $value['id']) 
                                    || (isset($courseEdit['topicId']) && $courseEdit['topicId'] == $value['id'])){
                                    echo " selected ";
                                }
                            ?>
                            value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> </option>
                                                
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="row">
        <div class="col-sm-6">
            <label class="form-label">Yêu cầu khóa học</label>
            <textarea name="inputs" class="form-control" placeholder="Các kiến thức cần nắm được trước khi học khóa học..." rows="6"><?php 
                if(isset($_POST['inputs']) && trim($_POST['inputs']) != ""){
                    echo $_POST['inputs'];
                }
                if(isset($courseEdit)){echo $courseEdit['inputs'];}
                ?></textarea>
        </div>
        <div class="col-sm-6">
            <label class="form-label">Đầu ra</label>
            <textarea name="outputs" id="outputs" class="form-control" placeholder="Khững kiến thức thu được sau khóa học..." rows="6"><?php 
                if(isset($_POST['outputs']) && trim($_POST['outputs']) != ""){
                    echo $_POST['outputs'];
                }
                if(isset($courseEdit)){echo $courseEdit['outputs'];}
                ?></textarea>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="row">
        <div class="col-sm-5">
            <label class="form-label">Image</label>
            <div>
                <div class="d-inline-block myImg">
                    <img id='showImg' alt="your image" class="myImg" width="100%" height="100%">
                </div>
                <input type="file" name="fileUpload" id="fileUpload" >
            </div>
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
</script>


