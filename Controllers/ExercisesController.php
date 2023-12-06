<?php
class ExercisesController extends BaseController{
    protected $exercisesModel;
    protected $coursesModel;
    protected $topicsModel;
    protected $data = [];

    public function __construct() {
        $this->loadModel("ExercisesModel");
        $this->exercisesModel = new ExercisesModel();

        $this->loadModel("CoursesModel");
        $this->coursesModel = new CoursesModel();

        $this->loadModel("TopicsModel");
        $this->topicsModel = new TopicsModel();
    }
    public function index(){
        return $this->view('exercises.index', [
            'topics' => $this->topicsModel->all(),
            'courses' => $this->coursesModel->all('', '', '', '', '', ['relate' => 'asc']),
        ]);
    }

    public function list(){
        $id = $_GET['courseId'];
        $course = $this->coursesModel->find_by_id($id);
        // if(!isset($_GET['id'])){
        //     //Lượt truy cập
        //     $interact = $course['interact'] + 1;
        //     $sql = "UPDATE courses SET interact = $interact WHERE id = $id";
        //     $this->coursesModel->_query($sql);
        // }

        $limit = "";
        if($course['price'] > 0){
            $limit = 2;
        }
        //
        $where[] = "courseId = " . $course['id'];
        
        $this->data['exercises'] = $this->exercisesModel->getDataJoin(['name'], 'courses', 
                                                                'exercises.courseId = courses.id', $where, 
                                                                0, $limit);
        return $this->view('exercises.list', $this->data);
    }

    public function show(){
        if(isset($_GET['id'])){
            $this->data['exerciseShow'] = $this->exercisesModel->find_by_id($_GET['id']);
        }else{
            $id = $_GET['courseId'];
            $course = $this->coursesModel->find_by_id($id);
            $where = "courseId = '" . $course['id'] . "'";
            $this->data['exercises'] = $this->exercisesModel->all('', '', [$where], '', '', ['relate' => 'asc']);
            $this->data['exerciseShow'] = $this->data['exercises']['0'];
        }
        return $this->view('exercises.show', $this->data);
    }
} 