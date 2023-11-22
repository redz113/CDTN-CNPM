<div class="card">
    <div class="card-header boder-0">
        <div class="row">
            <div class="col-6">
                <h2>Quản lý khóa học</h2>
            </div>
            <div class="col-6">
            <?php
                if(in_array('course-create', $_SESSION['permissions'])){
                ?>
                    <a href="./?ctl=courses&act=create<?php echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-success float-right">Tạo khóa học</a>
                <?php
                }
            ?>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-3">
            <label for="phan_loai">Phân loại: </label>
            <select name="phan_loai" id="phan_loai">
                <option value="1">ALL</option>
                <option value="1">HTML</option>
                <option value="1">CSS</option>
            </select>
            </div>
        </div> -->
    </div>

    <div class="card-body">
        <form action="./?ctl=courses" method="GET" class="d-flex justify-content-end mb-3">
            <input type="hidden" name="ctl" id="" value="courses">
            <!-- Phan loai -->
            <select class="badge text-uppercase mr-1" name="topic">
                <option value="0" selected>Phân loại</option>
                <?php
                    foreach($topics as $value){
                        echo "<option value='" . $value['name'] . "'";
                        if(isset($_REQUEST['topic']) && $_REQUEST['topic'] == $value['name']) echo "selected"; 
                        echo ">" . $value['name'] . "</option>";
                    }
                ?>
            </select>

            <!-- Tags -->
            <select class="badge text-uppercase mr-1" name="tags">
                <option value="0" selected>Tags</option>
                <?php
                    foreach($tags as $value){
                        echo "<option value='" . $value['name'] . "'";
                        if(isset($_REQUEST['tags']) && $_REQUEST['tags'] == $value['name']) echo "selected"; 
                        echo ">" . $value['name'] . "</option>";
                    }
                ?>
            </select>

            <button class="btn btn-dark">Search</button>
        </form>


        <div class="table-responsive">
             <table class="table table-bordered table-hover">
                <tr class="badge-default">
                    <th class="text-center">#</th>
                    <th class="text-center" style="min-width: 150px;">Tên khóa học</th>
                    <th class="text-center" style="min-width: 200px;">Mô tả</th>
                    <th class="text-center">Phân loại</th>
                    <th class="text-center">Giá Bán</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center" max-width="270px">Thao tác</th>
                </tr> 
            <tbody id="myTable">
                <?php
                    if(isset($courses)){
                        $i = 1;
                        foreach($courses as $value){
                ?>
                
                    <tr>
                        <td class="align-middle"> <?php echo $i++; ?> </td>
                        <td class="align-middle text-uppercase"> <?php echo $value['name']; ?> </td>  
                        <td class="align-middle"> <?php echo trim($value['described']); ?> </td> 
                        <td class="align-middle text-uppercase"> <?php echo $value['topicId']; ?> </td>         
                        <td class="align-middle">
                            <?php 
                                echo $value['price'] == 0 ? 
                                "<span class='text-success'>Free</span>" : 
                                $value['price'] . ' VNĐ'; 
                            ?> 
                        </td>
                        <td class="align-middle">
                            <?php 
                                echo $value['state'] == 0 ? 
                                "<span class='text-danger'>Đang hoàn thiện</span>" : 
                                "<span class='text-success'>Đã hoàn thiện</span>"; 
                            ?> 
                        </td>
                        <td class="align-middle text-right">
                            <a href="./?ctl=courses&act=show&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-info mr-2 mt-2">Xem</a>
                            
                        <?php
                            if(in_array('exercise-update', $_SESSION['permissions'])){
                            ?>
                                <a href="./?ctl=courses&act=edit&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-primary mr-2 mt-2">Sửa</a>
                            <?php      
                            }

                            if(in_array('exercise-delete', $_SESSION['permissions'])){
                            ?>                           
                                <form action="./?ctl=courses&act=destroy&id=<?php echo $value['id'];?>" method="POST" 
                                onsubmit="return confirmDelete('<?php echo 'Bạn có chắc muốn xóa khóa học `' .  $value['name'] . '` không?'; ?>')"
                                class="d-inline-block">
                                    <input  type="submit" name="submit" value="Xóa" class="btn btn-danger mr-2 mt-2">
                                </form>
                            <?php
                            }
                        ?>
                            
                        </td> 
                    </tr>

                <?php }} ?>
            </tbody>
            </div>     
        </table>
    </div>

    <?php if(isset($paging)) echo $paging; ?>
</div>

<script>
    function confirmDelete(messenger){
        if(confirm(messenger)){
            return true;
        }
        return false;
    }
</script>