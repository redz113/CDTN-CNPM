<?php
    class AdminCoursesController extends BaseController{

        protected $coursesModel;
        protected $topicsModel;

        private $data = [];

        protected $limit = 8;    //Số bản ghi hiển thị trên 1 trang

        public function __construct() {
            // $this->_requireModel();                 // BaseController
            $this->loadModel('CoursesModel');
            $this->loadModel('TopicsModel');
            $this->coursesModel = new CoursesModel;    //Tạo object Courses
            $this->topicsModel = new TopicsModel;

            // $this->data['courses'] = $this->coursesModel->all();
            //JOIN DATA
            // $this->data['courses'] = $this->coursesModel->all();
            //JOIN DATA
            $this->data['courses'] = $this->coursesModel->all("", "", "", '', '',
                                                        ['relate' => 'ASC']);

            $this->data['topics'] = $this->topicsModel->all();

            $this->data["tags"] = $this->topicsModel->all('tags', ['*']);
        }

        public function index() {
            // $this->coursesModel->paging();
            $page = isset($_GET['page']) ? $_GET['page'] : 1; 
            
            //JOIN DATA
            $this->data['courses'] = $this->coursesModel->all("", "", "", 
                                                        ($page-1)*$this->limit, 
                                                        $this->limit,
                                                        ['relate' => 'ASC']);
            $this->data["paging"] = $this->coursesModel->paging($this->limit);
            return $this->view('admin.courses.index', $this->data);
        }

        public function create() { 
            return $this->view('admin.courses.create', $this->data);
        }

        public function store() {    
            if(trim($_POST['name']) == ""){
                $this->data['error'][] = "Tên không được để trống";
            }

            if(trim($_POST['described']) == ""){
                $this->data['error'][] = "Mô tả không được để trống";
            }

            if(trim($_POST['inputs']) == ""){
                $this->data['error'][] = "Yêu cầu đầu vào không được để trống";
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
            $this->data['courseEdit'] = $this->coursesModel->find_by_id($_REQUEST['id']);   // Bản ghi cần cập nhật
            
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

        public function show(){
            $this->data['course'] = $this->coursesModel->find_by_id($_REQUEST['id']);
            $courseName = $this->data['course']['name'];

            //lấy bài giảng
            $this->data['lessons'] = $this->coursesModel->all("lessons", ['*'], 
                                                            ["courseId = '" . $courseName ."'"],
                                                            '','', ['relate' => 'asc']);
            //lấy bài tập
            $this->data['exercises'] = $this->coursesModel->all("exercises", ['*'], 
                                                            ["courseId = '" . $courseName ."'"],
                                                            '','', ['relate' => 'asc']);
            return $this->view('admin.courses.show', $this->data);
        }
    }