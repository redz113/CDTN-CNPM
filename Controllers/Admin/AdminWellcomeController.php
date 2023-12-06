<?php 
	class AdminWellcomeController extends BaseController{
		protected $baseModel;
		protected $data;

		public function __construct(){
			$this->loadModel('BaseModel');
			$this->baseModel = new BaseModel;
		}
		public function index(){
			$this->data['topics'] = $this->baseModel->all('topics', ['*']);
			$this->data['courses'] = $this->baseModel->all('courses', ['*'], '', 0, '', ['interact' => 'desc']);
			$this->data['users'] = $this->baseModel->all('users', ['*'], ['role = 3']);

			return $this->view('admin.wellcome.index', $this->data);
		}
	}
?>