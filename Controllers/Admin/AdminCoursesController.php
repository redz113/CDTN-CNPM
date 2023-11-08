<?php
    class AdminCoursesController extends BaseController{

        protected $coursesModel;
        protected $topicsModel;

        private $data = [];

        protected $limit = 4;    //Số bản ghi hiển thị trên 1 trang

        public function __construct() {
            // $this->_requireModel();                 // BaseController
            $this->loadModel('CoursesModel');
            $this->loadModel('TopicsModel');
            $this->coursesModel = new CoursesModel;    //Tạo object Courses
            $this->topicsModel = new TopicsModel;

            $this->data['courses'] = $this->coursesModel->all();
            $this->data['topics'] = $this->topicsModel->all();
        }

        public function index() {
            // $this->coursesModel->paging();
            $page = isset($_GET['page']) ? $_GET['page'] : 1; 
            
            //JOIN DATA
            $this->data['courses'] = $this->coursesModel->getDataJoin("topics", 
                                                        "courses.topicId = topics.id", 
                                                        ($page-1)*$this->limit, 
                                                        $this->limit);
            $this->data["paging"] = $this->coursesModel->paging($this->limit);
            return $this->view('admin.courses.index', $this->data);
        }

        public function create() {
            return $this->view('admin.courses.create', $this->data);
        }

        public function show(){
            $this->data['course'] = $this->coursesModel->find($_REQUEST['id']);
            return $this->view('admin.courses.show', $this->data);
        }

        public function store() {
            // $this->data['error'] = [];
    
            if(trim($_POST['name']) == ""){
                $this->data['error'][] = "Tên không được để trống";
            }

            if(trim($_POST['described']) == ""){
                $this->data['error'][] = "Mô tả không được để trống";
            }

            if(trim($_POST['inputs']) == ""){
                $this->data['error'][] = "Yêu cầu đầu vào không được để trống";
            }

            if(trim($_POST['outputs']) == ""){
                $this->data['error'][] = "Yêu cầu đầu ra không được để trống";
            }
            
            if(empty($this->data["error"])) {
                $this->coursesModel->create();

                if(!empty($this->coursesModel->checkError)){
                    $this->data['error'][] = $this->coursesModel->checkError;
                }

                if(empty($this->data['error'])) {
                    echo "<script>alert('Tạo khóa học thành công');</script>";
                    return $this->index();
                }
            }
            return $this->view('admin.courses.create', $this->data);
        }

        public function edit(){
            $this->data['courseEdit'] = $this->coursesModel->find($_REQUEST['id']);   // Bản ghi cần cập nhật
            
            return $this->view('admin.courses.edit', $this->data);
        }

        public function update(){
            
            if(trim($_POST['name']) == ""){
                $this->data['error'][] = "Tên không được để trống";
            }

            if(trim($_POST['described']) == ""){
                $this->data['error'][] = "Mô tả không được để trống";
            }

            if(trim($_POST['inputs']) == ""){
                $this->data['error'][] = "Yêu cầu đầu vào không được để trống";
            }

            if(trim($_POST['outputs']) == ""){
                $this->data['error'][] = "Yêu cầu đầu ra không được để trống";
            }

            if(empty($this->data["error"])) {
                $this->coursesModel->update();

                if(!empty($this->coursesModel->checkError)){
                    $this->data['error'][] = $this->coursesModel->checkError;
                }
                
                if(empty($this->data['error'])) {
                    echo "<script>alert('Sửa khóa học thành công');</script>";
                    return $this->index();
                }
            }

            $this->data['id'] = $_POST['id'];

            return $this->view('admin.courses.edit', $this->data) ;
        }

        public function destroy(){
            $this->coursesModel->destroy(['exercises']);
            echo "<script>alert('Xóa khóa học thành công');</script>";
            return $this->index();
        }
    }