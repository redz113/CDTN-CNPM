
<?php
    class ExercisesModel extends BaseModel
    {
        protected $table = "exercises";

        protected $colums = [
            'id',
            'name',
            'level',
            'courseId',   
            'content',               
        ];

        // Upload File
        // protected $fileUpload = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : [];
        // protected $tagFileInput = 'imgPath';            //input file name
        // protected $target_dir = "./uploads/files/";      //đường dẫn thư mục lưu file ảnh upload

        // protected $fileType = ['pdf'];       //chọn đuôi file upload
    }