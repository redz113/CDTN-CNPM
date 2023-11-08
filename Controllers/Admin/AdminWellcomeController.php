<?php 
	class AdminWellcomeController extends BaseController{

		public function index(){
			return $this->view('admin.wellcome.index');
		}
	}
?>