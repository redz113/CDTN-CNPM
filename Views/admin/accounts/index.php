<?php 
	include "function.php";
?>
<div class="card">
    <div class="card-header boder-0">
        <div class="float-left">
            <h2>Quản lý tài khoản</h2>
        </div>
        <div class="float-right">
        <?php
            if(in_array('user-create', $_SESSION['permissions'])){
            ?>
                <a href="./?act=create&us=1" class="btn btn-success">Tạo tài khoản</a>
            <?php
            }
        ?>
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
                    <th class="text-center">ID</th>
                    <th class="text-center" >Name</th>
                    <th class="text-center" >Username</th>
                    <th class="text-center" >Email</th>
                    <th class="text-center" >Role</th>
                    <th class="text-center" >Thao tác</th>
                </tr> 

                <?php
					$users = getlistuser(0);
                    if(isset($users)){
                        $i = 1;
                        foreach($users as $value){
                ?>
                    <tr>
						<input type="hidden" id="custId" name="custId" value="<?php echo $value['id']; ?>">
                        <td class="align-middle" > <?php echo $i++; ?> </td>
                        <td class="align-middle"> <?php echo $value['name']; ?> </td>  
                        <td class="align-middle"> <?php echo $value['username']; ?> </td> 
                        <td class="align-middle"> <?php echo $value['email']; ?> </td>         
						<td class="align-middle"> <?php echo $value['role']; ?> </td>         
                        <td class="align-middle">

                        <!-- 
                            chưa xử lý phân quyền
                         -->
                            <a href="<?php echo "./?act=getdetail&us=1&id=".$value['id'];?>" class="btn btn-info mr-2 mt-2">Xem</a>
                            <?php
                            if(in_array('exercise-update', $_SESSION['permissions'])){
                                ?>
                                    <a href="<?php echo "./?act=update&us=1&id=".$value['id'];?>" class="btn btn-primary mr-2 mt-2">Sửa</a>
                                    <?php      
                            }
                            
                            if(in_array('exercise-delete', $_SESSION['permissions'])){
                                ?>                           
                                <form action="./?act=delete&us=1&id=<?php echo $value['id'];?>" method="POST" 
                                onsubmit="return confirmDelete('<?php echo 'Bạn có chắc muốn xóa tài khoản `' .  $value['name'] . '` không?'; ?>')"
                                class="d-inline-block">
                                    <input  type="submit" name="submit" value="Xóa" class="btn btn-danger mr-2 mt-2">
                                </form>
                            <?php
                            }
                        ?>
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