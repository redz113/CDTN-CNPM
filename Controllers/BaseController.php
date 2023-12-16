<?php

class BaseController{

    const VIEWS_FOLDER_NAME = './Views/';
    const MODELS_FOLDER_NAME = './Models/';

    /**
     * Quy tắc:
     * + viewPath name: folderName.viewName
     * + Lấy từ sau folder Views
     */
    protected function view($viewPath, array $data = []){
        
        foreach($data as $key => $value){
            $$key = $value;
        }

        include_once self::VIEWS_FOLDER_NAME . str_replace('.', '/', $viewPath) . '.php';
    }

    protected function loadModel($modelPath){
        // die('Load Model');
        require_once self::MODELS_FOLDER_NAME . str_replace('.', '/', $modelPath) . '.php';
    }

    public function interfaceConvert(){
        if(isset($_GET['ui'])){
            $_SESSION['ui'] = 1;
        }

        if(isset($_GET['ai'])){
            unset($_SESSION['ui']);
        }
        return header( "refresh:0.0;url=./" );
    }
}