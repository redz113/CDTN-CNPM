<?php
    class AdminExercisesController extends BaseController{

        protected $coursesModel;
        protected $exercisesModel;
        private $data = [];

        protected $limit = 4;    //Số bản ghi hiển thị trên 1 trang

        public function __construct() {
            // $this->_requireModel();                 // BaseController
            $this->loadModel('CoursesModel');
            $this->loadModel('exercisesModel');
            $this->coursesModel = new CoursesModel;    //Tạo object Courses
            $this->exercisesModel = new ExercisesModel;

            $this->data['courses'] = $this->coursesModel->all();
            $this->data['exercises'] = $this->exercisesModel->all();
        }

        public function index() {
            // $this->coursesModel->paging();
            $page = isset($_GET['page']) ? $_GET['page'] : 1; 

            $this->data['exercises'] = $this->exercisesModel->getDataJoin("courses", 
                                                        "exercises.courseId = courses.id", 
                                                        ($page-1)*$this->limit, 
                                                        $this->limit);
            $this->data["paging"] = $this->exercisesModel->paging($this->limit);
            return $this->view('admin.exercises.index', $this->data);
        }

        public function create() {
            return $this->view('admin.exercises.create', $this->data);
        }

        public function store() {

            if(trim($_POST['name']) == ""){
                $this->data['error'][] = "Tên không được để trống";
            }

            if(trim($_POST['content']) == ""){
                $this->data['error'][] = "Nội dung bài tập không được để trống";
            }
            
            if(empty($this->data['error'])){
                $this->exercisesModel->create();

                if(!empty($this->exercisesModel->checkError)){
                    $this->data['error'][] = $this->exercisesModel->checkError;
                }
                
                if(empty($this->data['error'])){
                    echo "<script>alert('Tạo bài tập thành công');</script>";
                    return $this->index();
                }
            }

            return $this->view('admin.exercises.create', $this->data) ;
        }

        public function edit(){
            $this->data['exerciseEdit'] = $this->exercisesModel->find($_REQUEST['id']);   // Bản ghi cần cập nhật
            
            return $this->view('admin.exercises.edit', $this->data);
        }

        public function update(){ 
            if(trim($_POST['name']) == ""){
                $this->data['error'][] = "Tên không được để trống";
            }

            if(trim($_POST['content']) == ""){
                $this->data['error'][] = "Nội dung bài tập không được để trống";
            }
            
            if(empty($this->data['error'])){
                $this->exercisesModel->update();

                if(!empty($this->exercisesModel->checkError)){
                    $this->data['error'][] = $this->exercisesModel->checkError;
                }
                
                if(empty($this->data['error'])){
                    echo "<script>alert('Sửa bài tập thành công');</script>";
                    return $this->index();
                }
            }

            $this->data['id'] = $_POST['id'];

            return $this->view('admin.exercises.edit', $this->data) ;
        }

        public function destroy(){
            $this->exercisesModel->destroy();
            echo "<script>alert('Xóa bài tập thành công');</script>";
            return $this->index();
        }

        public function show(){
            $this->data['exercise'] = $this->exercisesModel->find($_REQUEST['id']);
            return $this->view('admin.exercises.show', $this->data);
        }
    }


       