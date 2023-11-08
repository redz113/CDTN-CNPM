<?php
    class AdminRolesController extends BaseController{
        protected $rolesModel;
        protected $data = [];

        public function __construct(){
            $this->loadModel("RolesModel");
            $this->rolesModel = new RolesModel;
            $this->data["roles"] = $this->rolesModel->all("roles", ['*']);
            $this->data['role_has_permission'] = $this->rolesModel->all('role_has_permission', ['*']);
            $this->data['permissions'] = $this->rolesModel->all('permissions', ['*']);
        }
        public function index(){
            $this->data["roles"] = $this->rolesModel->all("roles", ['*']);
            $this->data['role_has_permission'] = $this->rolesModel->all('role_has_permission', ['*']);
            $this->data['permissions'] = $this->rolesModel->all('permissions', ['*']);

            return $this->view('admin.roles.index', $this->data);
        }

        public function create(){
            return $this->view('admin.roles.create', $this->data);
        }

        public function store(){
            //check
            $nameInp = trim($_REQUEST['name']);
            if($nameInp == ""){
                $this->data['error'][] = "Tên vai trò không được để trống";
            }

            foreach($this->data['roles'] as $name){
                if($name['name'] == $nameInp){
                    $this->data['error'][] = "Tên vai trò đã tồn tại";
                    break;
                }
            }

            if(empty($this->data['error'])){
                // Them vai tro vao database
                $this->rolesModel->add('roles', ['name' => $_REQUEST['name']]);
                //Lay id
                $roleId = $this->rolesModel->lastRow('roles')['id'];
                
                foreach($_REQUEST['permission'] as $permission){
                    $this->rolesModel->add('role_has_permission', [
                        'roleId'=> $roleId,
                        'permissionId' => $permission,
                    ]);
                }
            }else{
                return $this->view('admin.roles.create', $this->data);
            }
            
            echo "<script>alert('Thêm quyền mới thành công');</script>";
            return $this->index();
        }

        public function edit(){
            foreach($this->data['roles'] as $role){
                if($_REQUEST['id'] == $role['id']){
                    $this->data['roleName'] = $role['name'];
                    break;
                }
            }

            foreach($this->data['role_has_permission'] as $rhp){
                if($_REQUEST['id'] == $rhp['roleId']){
                    $this->data['permissionEdit'][] = $rhp['permissionId'];
                }
            }             
            return $this->view('admin.roles.edit', $this->data);
        }

        public function update(){
            $this->data['id'] = $_POST['id'];
            $this->data['roleName'] = $_POST['name'];

            //check
            $nameInp = trim($_REQUEST['name']);
            if($nameInp == ""){
                $this->data['error'][] = "Tên vai trò không được để trống";
            }

            foreach($this->data['roles'] as $role){
                if($role['name'] == $nameInp && $role['id'] != $_POST['id']){
                    $this->data['error'][] = "Tên vai trò đã tồn tại";
                    break;
                }
            }

            if(empty($this->data["error"])){
                $this->rolesModel->update();
            }else {
                return $this->view("admin.roles.edit", $this->data);
            }

            echo "<script>alert('Sửa quyền thành công');</script>";
            return $this->index();
        }

        public function destroy(){
            $this->rolesModel->destroy(['role_has_permission']);
            echo "<script>alert('Xóa quyền thành công');</script>";
            return $this->index();
        }
    }