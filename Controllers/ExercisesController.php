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

    public function show(){
        return $this->view('exercises.show', []);
    }
} 