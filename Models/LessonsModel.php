<?php
    class LessonsModel extends BaseModel
    {
        protected $table = "lessons";

        protected $colums = [
            'id', 
            'name', 
            // 'described', 
            'courseId', 
            'fileUpload',
            'relate',
            'created_at',
        ];

        // Upload File
        // protected $fileUpload = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : [];
        protected $tagFileInput = 'fileUpload';            //images file
        protected $target_dir = "./uploads/files/lessons/";      //đường dẫn thư mục lưu file ảnh upload

        protected $fileType = ['pdf', 'mp4'];       //chọn đuôi file upload


        function create(){
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
            if(isset($_POST['id'])){  
                $editId = $_POST['id'];
            }

            // relate
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
    }