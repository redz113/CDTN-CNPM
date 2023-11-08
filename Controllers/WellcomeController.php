<?php
class WellcomeController extends BaseController{
    protected $coursesModel;
    protected $topicsModel;

    public function __construct() {
        $this->loadModel("CoursesModel");
        $this->coursesModel = new CoursesModel();

        $this->loadModel("TopicsModel");
        $this->topicsModel = new TopicsModel();
    }
    public function index(){
        return $this->view('wellcome.index', [
            'courses'=> $this->coursesModel->all(),
            'topics'=> $this->topicsModel->all(),
        ]);
    }
}