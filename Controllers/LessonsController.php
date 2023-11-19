<?php
class LessonsController extends BaseController{
    protected $lessonsModel;

    protected $data = [];

    public function __construct() {
        $this->loadModel("lessonsModel");
        $this->lessonsModel = new lessonsModel();

        // $this->loadModel("TopicsModel");
        // $this->topicsModel = new TopicsModel();
    }
    public function index(){
        $this->data['lessons'] = $this->lessonsModel->all('', '', '', '', '', ['relate' => 'asc']);
        return $this->view('lessons.index', $this->data);
    }
}