<?php
    class RolesModel extends BaseModel{

        protected $table = "roles";

        protected $colums = [
            'id', 'name',
        ];
        
        /**
         * Thêm dữ liệu trong bảng chỉ định
         */
        public function add($table = '', $colums = []){
            $cols = implode(',', array_keys($colums));
            $values = '';
            foreach($colums as $col){
            $values .= "'" . $col . "',";
            }

            $values = trim($values,",");
            $sql = "INSERT INTO $table($cols) VALUES($values)";

            $this->_query($sql);
        }

        public function update(){ 
            if(isset($_POST["id"])){
                // Cập nhập table roles
                $sql = "UPDATE $this->table SET name = '" . $_POST['name'] ."' WHERE id = " . $_POST['id'];
                $this->_query($sql);

                //Xóa quyền cũ
                $this->delete("role_has_permission", ['roleId' => $_POST['id']]);
                
                //Thêm quyền mới vào table role_has_permission
                if(isset($_POST["permission"])){
                    foreach($_POST["permission"] as $permission){
                        $this->add('role_has_permission', [
                            'permissionId' => $permission,
                            'roleId'=> $_POST['id'],
                        ]);
                    }
                }                
            }
        }

        public function delete($table = '', $where = []){
            $sql = "DELETE FROM $table WHERE ";
            foreach($where as $key => $value){
                $sql .= $key ." = ". $value ." OR ";
            }

            $sql = trim($sql," OR ");

            $this->_query($sql);
            
        }
    }