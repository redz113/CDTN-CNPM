<div class="card">
    <div class="card-header boder-0">
        <div class="float-left">
            <h2>Quản lý khóa học</h2>
        </div>
        <div class="float-right">

            <!-- 
                Chưa xử lý phân quyền
             -->
            <a href="./?ctl=courses&act=create<?php echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-success">Tạo khóa học</a>
        </div>
    </div>

    <div class="card-body">
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

                <?php
                    if(isset($courses)){
                        $i = 1;
                        foreach($courses as $value){
                ?>
                
                    <tr>
                        <td class="align-middle"> <?php echo $i++; ?> </td>
                        <td class="align-middle"> <?php echo $value['name']; ?> </td>  
                        <td class="align-middle"> <?php echo trim($value['described']); ?> </td> 
                        <td class="align-middle"> <?php echo $value['name2']; ?> </td>         
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
                        <td class="align-middle">

                        <!-- 
                            chưa xử lý phân quyền
                         -->
                            <a href="./?ctl=courses&act=show&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-info mr-2 mt-2">Xem</a>
                            <a href="./?ctl=courses&act=edit&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-primary mr-2 mt-2">Sửa</a>
                            <form action="./?ctl=courses&act=destroy&id=<?php echo $value['id'];?>" method="POST" 
                            onsubmit="return confirmDelete('<?php echo 'Bạn có chắc muốn xóa khóa học `' .  $value['name'] . '` không?'; ?>')"
                            class="d-inline-block">
                                <input  type="submit" name="submit" value="Xóa" class="btn btn-danger mt-2">
                            </form>
                        </td> 
                    </tr>

                <?php }} ?>
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