<div class="container">
    <div class="text-light h1 text-center mt-5 mb-0"><?php echo $exerciseShow['name']; ?></div>
    <strong class="text-light mt-5">Hà Nội, <?php echo date_format(date_create($exerciseShow['created_at']), 'd-m-Y H:s:i'); ?></strong>
    <!-- <div class="row mt-3">
        <div class="col-6">
            <a href="" class="btn btn-success rounded px-4 py-2 float-left"><i class="bx bx-left-arrow"></i></a>
        </div>
        <div class="col-6">
            <a href="" class="btn btn-success rounded px-4 py-2 float-right"><i class="bx bx-right-arrow"></i></a>
        </div>
    </div> -->
    <div class="embed-responsive embed-responsive-16by9 mt-4">
        <iframe class="embed-responsive-item" src="<?php echo $exerciseShow['fileUpload']; ?>" allowfullscreen></iframe>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>Bình luận</h3>
        </div>
        
        <div class="card-body">
            <!-- Bình luận -->
            <?php
                $model = new BaseModel();
                foreach($comments as $comment){
                    if($comment['id_exercise'] != $exerciseShow['id']) continue;
                    $user_cmt = $model->find_by_id($comment['id_user'], 'users', ['*'])['name'];
            ?>
                <div class="container px-4 pb-3">
                <!-- Bình luận lớn - comment  -->
                <div class="d-flex justify-content-start">
                    <div>
                        <img class="avt" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" alt="">
                    </div>
                    <div class="ml-4">
                        <h4 class="m-0 text-success"><?php echo $user_cmt; ?></h4>
                        <span class="pl-1"><?php echo $comment['create_at']; ?></span>
                        <div class="pl-3">
                            <strong class="bg-white-50"><?php echo $comment['content']; ?></strong>
                        </div>
                    </div>                
                </div>
            <?php
                foreach($subComments as $subCmt){
                    if($subCmt['id_comment'] != $comment['id']) continue;
                    $user_subCmt = $model->find_by_id($subCmt['id_user'], 'users', ['*'])['name'];
            ?>
                <!-- trả lời bình luận lớn - sub comment  -->
                <div>
                    <div class="d-flex justify-content-start ml-4 mt-2">
                        <div>
                            <img class="avt_subCmt" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" alt="">
                        </div>
                        <div class="ml-4">
                            <h5 class="m-0 text-primary"><?php echo $user_subCmt; ?></h5>
                            <span class="pl-1"><?php echo $subCmt['create_at']; ?></span>
                            <div class="pl-3">
                                <strong class=""><?php echo $subCmt['content']; ?></strong>
                            </div>
                        </div>                
                    </div>
                </div>
            <?php
                }
                if(isset($_SESSION['id'])){
            ?>
                <div class="mt-2">
                    <form action="./?ctl=exercises&act=subCmt&courseId=<?php echo $_GET['courseId'] . "&id=" . $exerciseShow['id']; ?>" method="post">
                        <!-- <label for="reply" class="form-lable">Trả lời</label> -->
                        <div class="row d-flex justify-content-center">
                            <input type="hidden" name="id_comment" value="<?php echo $comment['id']; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                            <input class="form-control col-10" type="text" name="subCmt" id="subCmt" placeholder="Trả lời bình luận...">
                            <button type="submit" class="btn btn-primary float-right col-auto">Trả lời</button>
                        </div>
                    </form>
                </div>
                <div></div>
            <?php
                }
                echo "</div>";
            }
            ?>            
        </div>

        <div class="card-footer bg-white">
            <div class="h5">Viết bình luận</div>
            <?php
                if(isset($_SESSION['id'])){
            ?>
            <form action="./?ctl=exercises&act=comment&courseId=<?php echo $_GET['courseId'] . "&id=" . $exerciseShow['id']; ?>" method="post">
                <input type="hidden" name="id_exercise" value="<?php echo $exerciseShow['id']; ?>">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                <textarea class="form-control" name="content" id="content" cols="30" rows="4">
                </textarea>
                <script>
                    CKEDITOR.replace( 'content' );
                </script>
                <button type="submit" class="btn btn-success float-right mt-2">Gửi đi</button>
            </form>
            <?php 
                }else{
                    echo '<h4 class="text-primary text-center">Bạn cần đăng nhập để bình luận!!!</h4>';
                }
            ?>
        </div>
    </div>
</div>

