
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
            'outputs',              // kiến thức đầu ra
            'topicId',                  
            'state',                 // Đã hoàn thiện hay chưa
        ];

        // Upload File
        // protected $fileUpload = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : [];
        protected $tagFileInput = 'fileUpload';            //images file
        protected $target_dir = "./uploads/images/";      //đường dẫn thư mục lưu file ảnh upload

        protected $fileType = ['jpg', 'png', 'git'];       //chọn đuôi file upload
    }