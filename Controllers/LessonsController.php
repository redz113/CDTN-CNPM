<?php
class LessonsController extends BaseController{
    protected $lessonsModel;
    protected $coursesModel;

    protected $data = [];

    public function __construct() {
        $this->loadModel("LessonsModel");
        $this->lessonsModel = new LessonsModel();

        $this->loadModel("CoursesModel");
        $this->coursesModel = new CoursesModel();
        $this->data['lessons'] = $this->lessonsModel->all('', '', '', '', '', ['relate' => 'asc']);
    }
    public function index(){
        $id = $_GET['courseId'];
        $course = $this->coursesModel->find_by_id($id);
        if(!isset($_GET['id'])){
            //Lượt truy cập
            $interact = $course['interact'] + 1;
            $sql = "UPDATE courses SET interact = $interact WHERE id = $id";
            $this->coursesModel->_query($sql);
        }

        $limit = "";
        if($course['price'] > 0){
            $limit = 2;
        }
        //
        $where[] = "courseId = " . $course['id'];
        
        $this->data['lessons'] = $this->lessonsModel->getDataJoin(['name'], 'courses', 
                                                                'lessons.courseId = courses.id', $where, 
                                                                0, $limit);
        return $this->view('lessons.index', $this->data);
    }

    public function show(){
        if(isset($_GET['id'])){
            $this->data['lessonShow'] = $this->lessonsModel->find_by_id($_GET['id']);
        }else{
            $id = $_GET['courseId'];
            $course = $this->coursesModel->find_by_id($id);
            $where = "courseId = '" . $course['id'] . "'";
            $this->data['lessons'] = $this->lessonsModel->all('', '', [$where], '', '', ['relate' => 'asc']);
            $this->data['lessonShow'] = $this->data['lessons']['0'];
        }
        return $this->view('lessons.show', $this->data);
    }
}