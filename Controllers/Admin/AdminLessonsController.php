<?php

class AdminLessonsController extends BaseController{
    protected $coursesModel;
    protected $lessonsModel;
    private $data = [];

    protected $limit = 8;    //Số bản ghi hiển thị trên 1 trang

    public function __construct() {
        // $this->_requireModel();                 // BaseController
        $this->loadModel('CoursesModel');
        $this->loadModel('lessonsModel');
        $this->coursesModel = new CoursesModel;    //Tạo object Courses
        $this->lessonsModel = new LessonsModel;

        $this->data['courses'] = $this->coursesModel->all('', '', '', '', '', ['relate' => 'asc']);
        $this->data['lessons'] = $this->lessonsModel->all();
    }

    public function index() {
        // $this->coursesModel->paging();
        $page = isset($_GET['page']) ? $_GET['page'] : 1; 

        $this->data['lessons'] = $this->lessonsModel->all("", "","", 
                                                    ($page-1)*$this->limit, 
                                                    $this->limit,
                                                    ['relate' => 'asc']);
        $this->data["paging"] = $this->lessonsModel->paging($this->limit);
        return $this->view('admin.lessons.index', $this->data);
    }

    public function create() {
        return $this->view('admin.lessons.create', $this->data);
    }

    public function store() {

        if(trim($_POST['name']) == ""){
            $this->data['error'][] = "Tên không được để trống";
        }

        // if(trim($_POST['described']) == ""){
        //     $this->data['error'][] = "Mô tả về bài giảng không được để trống";
        // }
        
        if(empty($this->data['error'])){
            $this->lessonsModel->create();

            if(!empty($this->lessonsModel->checkError)){
                $this->data['error'][] = $this->lessonsModel->checkError;
            }
            
            if(empty($this->data['error'])){
                echo "<script>alert('Tạo bài giảng thành công');</script>";
                return $this->index();
            }
        }

        return $this->view('admin.lessons.create', $this->data) ;
    }

    public function edit(){
        $this->data['lessonEdit'] = $this->lessonsModel->find_by_id($_REQUEST['id']);   // Bản ghi cần cập nhật
        
        return $this->view('admin.lessons.edit', $this->data);
    }

    public function update(){ 
        if(trim($_POST['name']) == ""){
            $this->data['error'][] = "Tên không được để trống";
        }

        // if(trim($_POST['content']) == ""){
        //     $this->data['error'][] = "Nội dung bài tập không được để trống";
        // }
        
        if(empty($this->data['error'])){
            $this->lessonsModel->update();

            if(!empty($this->lessonsModel->checkError)){
                $this->data['error'][] = $this->lessonsModel->checkError;
            }
            
            if(empty($this->data['error'])){
                echo "<script>alert('Sửa bài giảng thành công');</script>";
                return $this->index();
            }
        }

        $this->data['id'] = $_POST['id'];

        return $this->view('admin.lessons.edit', $this->data) ;
    }

    public function destroy(){
        $this->lessonsModel->destroy();
        echo "<script>alert('Xóa bài giảng thành công');</script>";
        return $this->index();
    }

    public function show(){
            $this->data['lesson'] = $this->lessonsModel->find_by_id($_REQUEST['id']);
            return $this->view('admin.lessons.show', $this->data);
        }
}