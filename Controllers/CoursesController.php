<?php
class CoursesController extends BaseController{
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
        $this->data['courses'] = $this->coursesModel->all('', '', '', '', '', ['relate' => 'asc']);
        $this->data['topics'] = $this->topicsModel->all();

        return $this->view('courses.index', $this->data);
    }
} 