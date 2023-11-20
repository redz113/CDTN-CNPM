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

        //
        $where = "courseId = '" . $course['name'] . "'";
        $this->data['lessons'] = $this->lessonsModel->all('', '', [$where], '', '', ['relate' => 'asc']);
        return $this->view('lessons.index', $this->data);
    }

    public function show(){
        if(isset($_GET['id'])){
            $this->data['lessonShow'] = $this->lessonsModel->find_by_id($_GET['id']);
        }else{
            $this->data['lessonShow'] = $this->data['lessons']['0'];
        }
        return $this->view('lessons.show', $this->data);
    }
}