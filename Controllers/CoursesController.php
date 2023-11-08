<?php
class CoursesController extends BaseController{
    protected $coursesModel;
    protected $topicsModel;

    public function __construct() {
        $this->loadModel("CoursesModel");
        $this->coursesModel = new CoursesModel();

        $this->loadModel("TopicsModel");
        $this->topicsModel = new TopicsModel();
    }
    public function index(){
        $courses = $this->coursesModel->all();
        $topics = $this->topicsModel->all();

        return $this->view('courses.index', [
            'topics' => $this->topicsModel->all(),
            'courses' => $this->coursesModel->all(),
        ]);
    }
} 