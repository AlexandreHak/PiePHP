<?php
namespace Controller;

use Core\Controller;

class PublisherController extends Controller
{
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
                $info['invalid'] = 'publisher is invalid';
            } else {
                if (!$this->inDb($this->params['name'], 'name', $this->model)) {
                    $this->model->save();
                    $info['info'] = 'publisher has been added';
                } else {
                    $info['exist'] = 'already exist';
                }
            }
        }

        echo json_encode($info);
    }    
}
