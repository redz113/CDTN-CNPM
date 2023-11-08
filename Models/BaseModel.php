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

        public function getDataJoin($tableName, $on = "", $start=0, $limit = null) {
            $colums = $this->colums; 
            foreach ($colums as $key => $value) {
                $colums[$key] = $this->table .'.'. $value;
            }
            // $colums[0] = $this->table . '.id';
            // $colums[1] = $this->table . '.name';
            $colums[] = $tableName . '.name as name2';
            $select = implode(', ', $colums);

            $sql = "SELECT $select FROM $this->table
                    INNER JOIN $tableName
                    ON $on
            ";

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
        public function all($table = '', $colums = [], $where = [], $start=0, $limit = null){
            if(!empty($colums)){
                $select = implode(',', $colums);
            }else $select = implode(',', $this->colums);

            $table = empty($table) ? $this->table : $table;
            $sql = "SELECT ${select} FROM $table";


            if(!empty($where) ){
                $sql .= " WHERE ";
                foreach ($where as $key => $value){
                    $sql .= "$key = $value OR ";
                }
            }
            
            // $this->pageSize = empty($limit) ? $this->pageSize : $limit;
            $sql = trim($sql ,'OR ');

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
        public function find($id){
            $select = implode(',', $this->colums);

            $sql = "SELECT ${select} FROM $this->table WHERE $this->primaryKey = $id"; 
            return mysqli_fetch_assoc($this->_query($sql));
        }

        /**
         * Thêm dữ liệu vào bảng
         */
        public function create(){
            $cols = implode(',', array_keys($_POST));
            $values = '\'' . implode('\',\'', array_values($_POST)) . '\'';

            ////
            if(isset($_FILES[$this->tagFileInput]) && $_FILES[$this->tagFileInput]['error'] == 0){
                $path = $this->_uploadFile();
                if($path != false){
                    $cols .= ',' . $this->tagFileInput;
                    $values .= ',\'' . $path . '\'';
                }
            }

            $sql = "INSERT INTO $this->table($cols) VALUES($values)";
            
            if(empty($this->checkError)){
                $this->_query($sql);
            }
        }

        /**
         * Sửa dữ liệu trong bảng
         */
        public function update(){
            if(isset($_POST['id'])){  
                $editId = $_POST['id'];
            }

            $set = '';
            foreach($_POST as $key => $value){
                $set .= $key. ' = \'' . $value . '\',';  
            }

            if(isset($_FILES[$this->tagFileInput]) && $_FILES[$this->tagFileInput]['error'] == 0){
            
                //upload file
                $path = $this->_uploadFile();
                if($path != false){
                    $set .= 'fileUpload = \'' . $path . "' ";

                    //Xóa file cũ 
                    $pathOdd = $this->find($editId)['fileUpload']; 
                    if(file_exists("$pathOdd")){
                        unlink($pathOdd);
                    }
                }
            }

            $set = trim($set, ',');
            $sql = "
                UPDATE $this->table
                SET $set
                WHERE id = $editId; 
                ";
            if(empty($this->checkError)){
                $this->_query($sql);
            }
        }

        /**
         * Xóa dữ liệu trong bảng
         * $connection - các table có liên quan
         */
        public function destroy($connection = []){
            $id = $_GET['id'];

            //Xóa file cũ 
            $data = $this->find($id); 
            if(isset($data['fileUpload']) && file_exists($data['fileUpload'])){
                unlink($data['fileUpload']);
            }

            // Xóa các table liên quan
            if(!empty($connection)){
                foreach($connection as $value){
                    $where = rtrim($this->table,'s') . 'Id';
                    $sql = "DELETE FROM $value WHERE $where = ${id}";
                    $this->_query($sql);
                }
            }

            $sql = "DELETE FROM $this->table WHERE id = ${id}";
            $this->_query($sql);
        }



        protected function _query($sql){
            return mysqli_query($this->connect, $sql);
        }

        public function _uploadFile(){
            $fileUpload = $_FILES[$this->tagFileInput];

            $uploadFileType = strtolower(pathinfo($fileUpload['name'], PATHINFO_EXTENSION));
            
            $fileName = $this->table . time();
            $target_file = $this->target_dir . $fileName . '.' . $uploadFileType;           //Đường dẫn lưu file

            // Kiểm tra đuôi file hợp lệ
            if(count($this->fileType) > 0){
                if(!in_array($uploadFileType, $this->fileType)){
                    $type = strtoupper(implode(', ', $this->fileType));
                    $this->checkError = "Chỉ cho phép các tệp $type";
                    return false;
                }
            }

            
            if(!move_uploaded_file($fileUpload['tmp_name'], $target_file)){
                $this->checkError = "Đã xảy ra lỗi khi tải xuống tệp tin";
                return false;
            }
            
            return $target_file;
        }


        // Paging

        public function paging($limit){

            $totalRecord = mysqli_fetch_array($this->_query("SELECT COUNT(id) FROM $this->table"))['0'];
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

            // Previous

            $prePage = $pagePresent > 1 ? $pagePresent -1 : $pagePresent;
            $nextPage = $pagePresent < $totalPages ? $pagePresent + 1 : $pagePresent;
    
            $html .= "
            <li class='page-item'>
            <a class='page-link' href='./?ctl=$this->table&rl=1&page=$prePage' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
                <span class='sr-only'>Previous</span>
            </a>
            </li>
            ";

            for($i=1; $i<=$totalPages; $i++){
                $html .= "<li class='page-item'><a class='page-link";
                $html .= $pagePresent == $i ? ' bg-primary text-dark ' : '';
                $html.= "' href='./?ctl=$this->table&rl=1&page=$i'>" . $i ."</a></li>";
            }
            $html .= "
                <li class='page-item'>
                <a class='page-link' href='./?ctl=$this->table&rl=1&page=$nextPage' aria-label='Next'>
                    <span aria-hidden='true'>&raquo;</span>
                    <span class='sr-only'>Next</span>
                </a>
                </li>
            </ul>
            </nav>
            ";
            return $html;
        }

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
        public function lastRow($table = ''){
            $table = empty($table) ? $this->table : $table;
            $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
            $query = $this->_query($sql);
            return mysqli_fetch_assoc($query);
        }
    }