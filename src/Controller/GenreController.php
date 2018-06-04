<?php
namespace Controller;

use Core\Controller;
use Model\GenreModel;

class GenreController extends Controller
{

    /**
     * DELETE LATER ONLY FOR TESTING PUROPOSE
     * route: movie/test
     */
    public function test()
    {
        $this->model->id['val'] = 2;
        ddgps($this->model->movies());
    }


    // doing relations later
    public $relations = [
        'has many' => 'movies'
    ];

    public function index()
    {
        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }
        
        $this->render('index', ['genreList' => $this->model->find()]);
    }

    /**
     * ajax use only
     * 
     * @return void
     */
    public function add()
    {
        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }

        $info = [];

        if (empty($this->params['name'])) {
            $info['empty'] = 'is empty';
        } else {
            $this->params['name'] = trim($this->params['name']);

            if ($this->verifyParams() !== 1) {
                $info['invalid'] = 'is invalid';
            } else {
                if (!$this->inDb($this->params['name'], 'name', $this->model)) {
                    $this->model->save();
                    $info['info'] = 'genre has been added';
                } else {
                    $info['exist'] = 'already exist';
                }
            }
        }

        echo json_encode($info);
    }

    public function edit()
    {
        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }

        $info = [];

        if ($this->model->save()) {
            
        }
        

        echo json_encode($info);
    }

    public function delete()
    {
        $this->params['name'] = 'adventure';
        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }

        $info = [];

        if ($this->model->delete()) {
            $info['info'] = 'has been successfully deleted';
        } else {
            $info['errors'] = 'unexpected error occurred';
        }

        echo json_encode($info);
    }

    // create read method for ajax ?

    
}
