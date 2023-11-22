<div class="card">
    <div class="card-header boder-0">
        <div class="float-left">
            <h2>Quản lý quyền</h2>
        </div>
        <div class="float-right">

            <?php
                if(in_array('role-create', $_SESSION['permissions'])){
                ?>
                    <a href="./?ctl=roles&act=create<?php echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-success">Tạo quyền mới</a>
                <?php
                }
            ?>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
             <table class="table table-bordered table-hover">
                <tr class="badge-default">
                    <th class="text-center">#</th>
                    <th class="text-center" style="min-width: 150px;">Vai trò</th>
                    <th class="text-center" style="min-width: 300px;">Quyền truy cập</th>
                    <th class="text-center" style="min-width: 160px;">Thao tác</th>
                </tr> 

                <?php
                    if(isset($roles)){
                        $i = 1;
                        foreach($roles as $role){
                ?>
                
                    <tr>
                        <td class="align-middle"> <?php echo $i++; ?> </td>
                        <td class="align-middle"> <?php echo $role['name']; ?> </td>  
                        <td class="align-middle"> 
                            <?php 
                                foreach($role_has_permission as $value){
                                    if($role['id'] == $value['roleId']){
                                        foreach($permissions as $permission){
                                            if($permission['id'] == $value['permissionId']){
                                                echo $permission['name'] . ", ";
                                            } else continue;
                                        }
                                    } else continue;
                                }
                            ?>
                        </td>       
                        <td class="align-middle">

                        <?php
                            if(in_array('role-update', $_SESSION['permissions'])){
                            ?>
                                <a href="./?ctl=roles&act=edit&id=<?php echo $role['id']; echo isset($_GET['page']) ? "&page=".$_GET['page']:""; ?>" class="btn btn-primary mr-2 mt-2">Sửa</a>
                            <?php      
                            }

                            if(in_array('role-delete', $_SESSION['permissions'])){
                            ?>
                                <form action="./?ctl=roles&act=destroy&id=<?php echo $role['id'];?>" method="POST" 
                                onsubmit="return confirmDelete('<?php echo 'Bạn có chắc muốn xóa quyền `' .  $role['name'] . '` không?'; ?>')"
                                class="d-inline-block">
                                    <input  type="submit" name="submit" value="Xóa" class="btn btn-danger mt-2">
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