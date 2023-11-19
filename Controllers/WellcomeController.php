<?php
class WellcomeController extends BaseController{
    protected $coursesModel;
    protected $topicsModel;

    protected $data = [];

    public function __construct() {
        $this->loadModel("CoursesModel");
        $this->coursesModel = new CoursesModel();

        $this->loadModel("TopicsModel");
        $this->topicsModel = new TopicsModel();
    }
    public function index(){
        $this->data['courses'] =  $this->coursesModel->all('', '', '', '', '', ['relate' => 'asc']);
        $this->data['topics'] =  $this->topicsModel->all();

        if(isset($_GET['textSearch'])){
            // echo $_GET['textSearch'];
            // unset($this->data['courses']);
            $this->data['courses'] = $this->coursesModel->search('courses', ['name', 'described'] ,$_GET['textSearch']);
        }
        return $this->view('wellcome.index', $this->data);
    }
}