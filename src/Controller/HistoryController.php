<?php
namespace Controller;

use Core\Controller;
use Model\HistoryModel;
use Model\GenreModel;
use Model\PublisherModel;

class HistoryController extends Controller
{
    /**
     * [ ] make pagination
     */
    public function index()
    {
        if (empty($_SESSION['auth'])) {
            header('Location: ' . BASE_URI);
            exit;
        }

        // pagination here
        // $_SESSION['auth']
        $this->model->params = [
            'INNER JOIN' => 'movie ON history.id_film = id_movie',
            'JOIN' => 'fiche_personne ON history.id_membre = id_perso',
            'WHERE' => 'id_perso = ' . $_SESSION['auth']
        ];
        
        $result = $this->model->read();
        ddgps($result);
        $this->render('index');
    }


    /**
     * if genre or publisher doesn't exist then add it before adding movie
     * 
     * replace params['genre'] name with it's id
     * 
     * @return void
     */
    public function add()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: ' . BASE_URI);
        }

        $this->model->params = [
            'id_membre' => $this->params['id_u'],
            'id_film' => $this->params['id_m']
        ];
        
        $this->model->save();
        $this->render('index');
    }


    public function delete()
    {
        if (!isset($_SESSION['auth']) || empty($this->params['id'])) {
            header('Location: ' . BASE_URI);
        }

        $this->model->id['col'] = 'id_movie';
        $this->model->id['val'] = $this->params['id'];
        $this->model->delete();
        // display message in index with get ?
        header('Location: ' . BASE_URI .DIRECTORY_SEPARATOR . 'movie');
        exit;
    }
}