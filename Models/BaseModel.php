<?php
    class BaseModel extends Database
    {
        protected $connect;

        protected $table;

        protected $primaryKey = 'id';

        protected $colums = ['*'];

        // Upload File
        protected $tagFileInput;
        protected $fileType = [];
        protected $target_dir = './uploads/';
        public $checkError = null;



        public function  __construct() {
            $this->connect = $this->connect(); 
        }

        public function getDataJoin($selectTb2 = [], $tableJoin = '', $on = "", $where = [], $start=0, $limit = null, $orderBy = ['relate' => 'asc']) {
            foreach ($this->colums as $value) {
                $colums[] = $this->table .'.'. $value;
            }

            if(!empty($selectTb2)){
                foreach($selectTb2 as $value){
                    $colums[] = "$tableJoin.$value as $tableJoin" . ucfirst($value); 
                }
            }
            
            $select = implode(', ', $colums);

            $sql = "SELECT $select FROM $this->table
                    INNER JOIN $tableJoin
                    ON $on
                    ";

            if(!empty($where) ){
                $sql .= " WHERE ";
                foreach ($where as  $value){
                    $sql .= " $value OR ";
                }
            }

            $sql = trim($sql ,'OR ');

            $sql .= " ORDER BY $this->table" ."." . array_keys($orderBy)[0] . " " . array_values($orderBy)[0];

            if(!empty($limit)){
                $sql .= " LIMIT $start, $limit";
            }
            
            $query = $this->_query($sql);

            $data = [];
            while($row = mysqli_fetch_assoc($query)){
                $data[] = $row;
            }
            return $data;
        }

        /**
         * Lấy  tất cả dữ liệu trong bảng có phân trang
         */
        public function all($table = '', $colums = [], $where = [], $start=0, $limit = null, $orderBy = []){
            if(!empty($colums)){
                $select = implode(',', $colums);
            }else $select = implode(',', $this->colums);

            $table = empty($table) ? $this->table : $table;
            $sql = "SELECT {$select} FROM $table";


            if(!empty($where) ){
                $sql .= " WHERE ";
                foreach ($where as  $value){
                    $sql .= " $value OR ";
                }
            }
            
            // $this->pageSize = empty($limit) ? $this->pageSize : $limit;
            $sql = trim($sql ,'OR ');

            if(!empty($orderBy)){
                $sql .= " ORDER BY " .array_keys($orderBy)[0] . " " . array_values($orderBy)[0];
            }

            if(!empty($limit)){
                $sql .= " LIMIT $start, $limit";
            }

            $query = $this->_query($sql);
            $data = [];
            while($row = mysqli_fetch_assoc($query)){
                $data[] = $row;
            }
            return $data;
        }

        /**
         * Lấy ra 1 bản ghi
         */
        public function find_by_id($id, $table = '', $colums = []){
            if(!empty($table)){
                $this->table = $table;
            }
        
            $select = !isset($colums[0]) ? implode(',', $this->colums) : implode(',', $colums);
    
            $sql = "SELECT {$select} FROM $this->table WHERE id = $id"; 
            return mysqli_fetch_assoc($this->_query($sql));
        }

        public function find($table, $select = '*', $where = []){
            $sql = "SELECT $select FROM $table WHERE ";
            foreach($where as $key => $val){
                $sql .= "$key = '$val' OR ";
            }

            $sql = rtrim($sql ,"OR ");

            $data = [];
            $query = $this->_query($sql);
            while($row = mysqli_fetch_assoc($query)){
                $data[] = $row;
            }
            return $data;
        }

        public function _query($sql){
            return mysqli_query($this->connect, $sql);
        }

        public function setRelete(){
            $lastCourse = $this->lastRow($this->table, 'relate');
            if($_POST['relate'] == "null" || $_POST['relate'] == $lastCourse['relate']){
                $relate = $lastCourse['id'] + 1;
            }else{
                $where[] = "relate >= " . $_POST['relate'];
                $data = $this->all($this->table, ['relate'], $where, 0, 2, ['relate' => 'asc']);
                $relate =  ($data[0]['relate'] + $data[1]['relate']) / 2.0;
            };
            return $relate;
        }

        /**
         * Thêm dữ liệu vào bảng
         */
        public function create_cmt($table = ''){
           
            $cols = implode(',', array_keys($_POST));
            $values = '\'' . implode('\',\'', array_values($_POST)) . '\'';

            $sql = "INSERT INTO $table($cols) VALUES($values)";
            $this->_query($sql);
        }

        /**
         * Sửa dữ liệu trong bảng
         */
        // public function update($table = ''){
        //     if(empty($this->table)){ $this->table = $table; };
        //     if(isset($_POST['id'])){  
        //         $editId = $_POST['id'];
        //     }

        //     $set = '';
        //     foreach($_POST as $key => $value){
        //         $set .= $key. ' = \'' . $value . '\',';  
        //     }

        //     if(isset($_FILES[$this->tagFileInput]) && $_FILES[$this->tagFileInput]['error'] == 0){
            
        //         //upload file
        //         $path = $this->_uploadFile();
        //         if($path != false){
        //             $set .= 'fileUpload = \'' . $path . "' ";

        //             //Xóa file cũ 
        //             $pathOdd = $this->find($editId)['fileUpload']; 
        //             if(file_exists("$pathOdd")){
        //                 unlink($pathOdd);
        //             }
        //         }
        //     }

        //     $set = trim($set, ',');
        //     $sql = "
        //         UPDATE $this->table
        //         SET $set
        //         WHERE id = $editId; 
        //         ";
        //     if(empty($this->checkError)){
        //         $this->_query($sql);
        //     }
        // }

        /**
         * Xóa dữ liệu trong bảng
         * $connection - các table có liên quan
         */
        public function destroy($connection = []){
            $id = $_GET['id'];

            //Xóa file cũ 
            $data = $this->find_by_id($id); 
            if(isset($data['fileUpload']) && file_exists($data['fileUpload'])){
                unlink($data['fileUpload']);
            }

            // Xóa các table liên quan
            if(!empty($connection)){
                foreach($connection as $table){
                    $where = rtrim($this->table,'s') . 'Id';

                    //Xóa file
                    $data2 = $this->find($table, '*' , [$where => $data['name']]);
                    foreach($data2 as $value){
                        if(isset($value['fileUpload']) && file_exists($value['fileUpload'])){
                            unlink($value['fileUpload']);
                        }
                    }

                    $sql = "DELETE FROM $table WHERE $where = " . $data['id'];
                    $this->_query($sql);
                }
            }

            $sql = "DELETE FROM $this->table WHERE id = $id";
            $this->_query($sql);
        }


        // public function _uploadFile($fileUpload, $targetDir, $fileTypeCheck){
        //     $fileType = strtolower(pathinfo($fileUpload['name'], PATHINFO_EXTENSION));
            
        //     $fileName =$targetDir .  md5(uniqid()) .".$fileType";
        //     // $target_file = $this->target_dir . $fileName . '.' . $uploadFileType;           //Đường dẫn lưu file

        //     // Kiểm tra đuôi file hợp lệ
        //     if(count($fileTypeCheck) > 0){
        //         if(!in_array($fileType, $fileTypeCheck)){
        //             $type = strtoupper(implode(', ', $this->fileType));
        //             $this->checkError = "Chỉ cho phép các tệp $type";
        //             return false;
        //         }
        //     }

            
        //     if(!move_uploaded_file($fileUpload['tmp_name'], $fileName)){
        //         $this->checkError = "Đã xảy ra lỗi khi tải xuống tệp tin";
        //         return false;
        //     }
            
        //     return $fileName;
        // }


        // Paging

        public function paging($limit, $totalRecord = 0 , $param=[]){
            $paramStr = '';
            if(isset($param)){
                $paramStr = implode("&", $param);
            }
            if($totalRecord == 0){
                $totalRecord = mysqli_fetch_array($this->_query("SELECT COUNT(id) FROM $this->table"))['0'];
            }
            $totalPages = ceil($totalRecord / $limit);

            if($totalPages < 2){
                return "";
            }

            $pagePresent = isset($_GET['page']) ? $_GET['page'] : 1;
            $pagePresent = $pagePresent < 1? 1 : ($pagePresent > $totalPages ? $totalPages : $pagePresent);

            $html = '
            <nav aria-label="Page navigation example">
            <ul class="pagination">
            ';

            // Previous page

            $prePage = $pagePresent > 1 ? $pagePresent -1 : $pagePresent;
            $nextPage = $pagePresent < $totalPages ? $pagePresent + 1 : $pagePresent;
    
            $html .= "
            <li class='page-item'>
            <a class='page-link' href='./?ctl=$this->table&rl=1&page=$prePage&$paramStr' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
                <span class='sr-only'>Previous</span>
            </a>
            </li>
            ";

            for($i=1; $i<=$totalPages; $i++){
                $html .= "<li class='page-item'><a class='page-link";
                $html .= $pagePresent == $i ? ' bg-primary text-dark ' : '';
                $html.= "' href='./?ctl=$this->table&page=$i&$paramStr'>" . $i ."</a></li>";
            }

            // Next page
            $html .= "
                <li class='page-item'>
                <a class='page-link' href='./?ctl=$this->table&page=$nextPage&$paramStr' aria-label='Next'>
                    <span aria-hidden='true'>&raquo;</span>
                    <span class='sr-only'>Next</span>
                </a>
                </li>
            </ul>
            </nav>
            ";
            return $html;
        }


        //Lấy tên vai trò
        public function getPermissionName(){
            $data = [];
            $permissions = [];
            
            $sql = "SELECT rl.id, rl.name, p.name as permission FROM roles as rl
                    INNER JOIN role_has_permission as rp ON rl.id = rp.roleId
                    INNER JOIN permissions as p ON rp.permissionId = p.id
                    ";
            $query = $this->_query($sql);
            while($row = mysqli_fetch_assoc($query)){
                $data[] = $row;
            }

            if(isset($_SESSION['role'])){
                foreach($data as $value){
                    if($_SESSION['role'] == $value['id']){
                        $permissions[] = trim($value['permission']);
                    }
                }
            }

            return $permissions;
        }

        // Lấy bản ghi cuối cùng
        public function lastRow($table = '', $orderBy = 'id'){
            $table = empty($table) ? $this->table : $table;
            $sql = "SELECT * FROM $table ORDER BY $orderBy DESC LIMIT 1";
            $query = $this->_query($sql);
            return mysqli_fetch_assoc($query);
        }

        public function search($table, $col_search ,$key){
            // $key = strtolower();
            $search = "";
            foreach($col_search as $value){
                $search .= $value . " LIKE '%$key%' OR ";
            }

            $search = rtrim($search,"OR ");
            $sql = "SELECT * FROM $table WHERE $search";

            $query = $this->_query($sql);
            $data = [];
            while($row = mysqli_fetch_assoc($query)){
                $data[] = $row;
            }

            return $data;
        }
    }