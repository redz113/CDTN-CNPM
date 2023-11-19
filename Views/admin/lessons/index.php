<div class="card">
    <div class="card-header boder-0">
        <div class="float-left">
            <h2>Quản lý Bài giảng khóa học</h2>
        </div>
        <div class="float-right">

            <!-- 
                Chưa xử lý phân quyền
             -->
            <a href="./?ctl=lessons&act=create&rl=1<?php echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-success">Tạo bài giảng</a>
        </div>
    </div>

    <!-- @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif -->

    <div class="card-body">
        <div class="table-responsive">
             <table class="table table-bordered table-hover">
                <tr class="badge-default">
                    <th class="text-center">#</th>
                    <th class="text-center" style="min-width: 150px;">Tên bài giảng</th>
                    <!-- <th class="text-center" style="min-width: 200px;">Mô tả</th> -->
                    <th class="text-center">Phân loại khóa học</th>
                    <!-- <th class="text-center">Độ khó</th> -->
                    <th class="text-center">Ngày tạo</th>
                    <th class="text-center" max-width="270px">Thao tác</th>
                </tr> 

                <?php
                    if(isset($lessons)){
                        $i = 1;
                        foreach($lessons as $value){
                ?>
                
                    <tr>
                        <td class="align-middle"> <?php echo $i++; ?> </td>
                        <td class="align-middle"> <?php echo $value['name']; ?> </td>  
						<!-- <td class="align-middle"> <?php echo $value['described']; ?> </td> -->
                        <td class="align-middle text-uppercase"> <?php echo $value['courseId']; ?> </td> 
                        <td class="align-middle"> <?php echo $value['created_at']; ?> </td> 
                        <td class="align-middle text-right">

                        <!-- 
                            chưa xử lý phân quyền
                         -->
                            <a href="./?ctl=lessons&act=show&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-info mr-2 mt-2">Xem</a>
                            <a href="./?ctl=lessons&act=edit&id=<?php echo $value['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-primary mr-2 mt-2">Sửa</a>
                            <form action="./?ctl=lessons&act=destroy&id=<?php echo $value['id'];?>" method="POST" 
                            onsubmit="return confirmDelete('<?php echo 'Bạn có chắc muốn xóa bài giảng `' .  $value['name'] . '` không?'; ?>')"
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