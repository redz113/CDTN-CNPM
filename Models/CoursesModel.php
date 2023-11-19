
<?php
    class CoursesModel extends BaseModel
    {
        protected $table = "courses";

        protected $colums = [
            'id',
            'name',
            'described',
            'fileUpload',
            'price',
            'inputs',            // Yêu cầu kiến thức đầu vào của khóa học
            'interact',             // Lượt tương tác
            'relate',               //Liên quan  
            'topicId',                  
            'state',                 // Đã hoàn thiện hay chưa
            'tags',
            'created_at',
        ];

        public $checkError = null;

        // Upload File
        // protected $fileUpload = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : [];
        protected $tagFileInput = 'fileUpload';            //images file
        protected $target_dir = "./uploads/images/";      //đường dẫn thư mục lưu file ảnh upload

        protected $fileType = ['jpg', 'png', 'git', 'webp'];       //chọn đuôi file upload

        function create(){
            $totalTag = $_POST['totalTag'];
            $tags = "";
            unset($_POST['totalTag']);

            for($i = 1; $i <= $totalTag; $i++){
                if(isset($_POST['tag'.$i])){
                    // print_r($_POST['tags']);
                    $tags .= $_POST['tag'.$i] . ' ';
                    unset($_POST['tag'.$i]);
                }    
            }
            $_POST['tags'] = $tags;

            // relate
            if(isset($_POST['relate'])){
                $_POST['relate'] = $this->setRelete();
            }

            $cols = implode(',', array_keys($_POST));
            $values = '\'' . implode('\',\'', array_values($_POST)) . '\'';

            ////
            if(isset($_FILES[$this->tagFileInput]) && $_FILES[$this->tagFileInput]['error'] == 0){
                $path = $this->_uploadFile($_FILES[$this->tagFileInput]);
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

        
        public function update(){
            // Tags
            $totalTag = $_POST['totalTag'];
            $tags = "";
            unset($_POST['totalTag']);

            for($i = 1; $i <= $totalTag; $i++){
                if(isset($_POST['tag'.$i])){
                    // print_r($_POST['tags']);
                    $tags .= $_POST['tag'.$i] . ' ';
                    unset($_POST['tag'.$i]);
                }    
            }
            $_POST['tags'] = $tags;

            if(isset($_POST['id'])){  
                $editId = $_POST['id'];
            }

            //relate
            if(isset($_POST['relate'])){
                $_POST['relate'] = $this->setRelete();
            }

            $set = '';
            foreach($_POST as $key => $value){
                $set .= $key. ' = \'' . $value . '\',';  
            }

            if(isset($_FILES[$this->tagFileInput]) && $_FILES[$this->tagFileInput]['error'] == 0){
                //upload file
                $path = $this->_uploadFile($_FILES[$this->tagFileInput]);
                if($path != false){
                    $set .= 'fileUpload = \'' . $path . "' ";

                    //Xóa file cũ 
                    $pathOdd = $this->find_by_id($editId)['fileUpload']; 
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

        public function _uploadFile($fileUpload){
            $fileType = strtolower(pathinfo($fileUpload['name'], PATHINFO_EXTENSION));
            
            $fileName =$this->target_dir .  md5(uniqid()) .".$fileType";
            // $target_file = $this->target_dir . $fileName . '.' . $uploadFileType;           //Đường dẫn lưu file

            // Kiểm tra đuôi file hợp lệ
            if(count($this->fileType) > 0){
                if(!in_array($fileType, $this->fileType)){
                    $type = strtoupper(implode(', ', $this->fileType));
                    $this->checkError = "Chỉ cho phép các tệp $type";
                    return false;
                }
            }

            
            if(!move_uploaded_file($fileUpload['tmp_name'], $fileName)){
                $this->checkError = "Đã xảy ra lỗi khi tải xuống tệp tin";
                return false;
            }
            
            return $fileName;
        }

        // public function setRelete(){
        //     $lastCourse = $this->lastRow($this->table, 'relate');
        //     if($_POST['relate'] == "null" || $_POST['relate'] == $lastCourse['relate']){
        //         $relate = $lastCourse['id'] + 1;
        //     }else{
        //         $where[] = "relate >= " . $_POST['relate'];
        //         $data = $this->all($this->table, ['relate'], $where, 0, 2, ['relate' => 'asc']);
        //         $relate =  ($data[0]['relate'] + $data[1]['relate']) / 2.0;
        //     };
        //     return $relate;
        // }
    }