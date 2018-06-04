<?php
namespace Controller;

use Core\Controller;
use Model\MovieModel;
use Model\GenreModel;
use Model\PublisherModel;

class MovieController extends Controller
{
    private $data;

    /**
     * [ ] make pagination
     */
    public function index()
    {
        // Case movie detail
        if (!empty($_GET['id'])) {
            $this->model->id['col'] = 'id_movie';
            $this->model->id['val'] = $_GET['id'];
            
            $detail = $this->model->read();
            
            if (!empty($detail)) {
                $detail[0]->id_genre = $this->model->hasOne(Genre::class, $detail[0]->id_genre)[0]->name;
                $detail[0]->id_publisher = $this->model->hasOne(publisher::class, $detail[0]->id_publisher)[0]->name;
            }

            $this->render('detail', ['movie' => !empty($detail) ? $detail[0] : 'id is invalid']);
            exit;
        }
        
        // Case searoching for movie
        if (!empty($this->params['search'])) {

            // time to pagination

            // to serach for a movie
            // get query 
            // display results
            // if search result is one then go to detail page (by redirecting) else go to index page
            // $this->model->params['WHERE'] => "title LIKE '%" . $this->model->params['search'] . "%'";

            $this->render('index', ['movies' => $this->model->read()]);
            exit;
        } 

        
        
        // pagination
        $offset = 20;
        $p = isset($_GET['p']) ? ($_GET['p'] - 1) * $offset : 0;
        $this->model->params = [
            'LIMIT' => $p . ', ' . $offset
        ];

        $this->render('index', ['movies' => $this->model->read()]);
    }

    /**
     * try to find movie to add
     */
    public function edit()
    {
        if (!isset($_SESSION['auth']) || empty($this->params['id'])) {
            header('Location: ' . BASE_URI);
            exit;
        }
        // get genre and publisher list
        $genreModel = new GenreModel();
        $genreList = $genreModel->read();
        $publisherModel = new PublisherModel();
        $publisherList = $publisherModel->read();

        // CASE user submit change
        if (isset($this->params['title'])) {
            $this->model->id = $this->params['id'];
            unset($this->model->params['id']);

            $this->model->params = $this->filterArrayEmpty($this->model->params);
            /**
             * Verif here
             */
            $this->model->save();
            header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'movie?id=' . $this->params['id']);
            exit;
        }

        // CASE edit movie page
        $this->model->id['col'] = 'id_movie';
        $this->model->id['val'] = $_GET['id'];
        // get genre and publisher real name
        $data = $this->model->read();

        $this->render('edit', [
            'movie' => !empty($data) ? $data[0] : 'No data',
            'genreList' => $genreList,
            'publisherList' => $publisherList
        ]);
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
        $genreModel = new GenreModel();
        $genreList = $genreModel->read();
        $publisherModel = new PublisherModel();
        $publisherList = $publisherModel->read();

        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }
        
        if (empty($this->params) || isset($_SESSION['errors'])) {
            $this->render('add', [
                'genreList' => $genreList,
                'publisherList' => $publisherList
            ]);
            exit;
        }
        
        $this->verifyForm(['overview', 'poster_path', 'id_tmdb']);

        if (!empty($this->inDb($this->params['title'], 'title', $this->model))) {
            $_SESSION['errors']['title'] = 'already exist';
        } 

        // get genre id and replace genre with id
        $genreModel->params = ['WHERE' => "name = '{$this->params['id_genre']}'"];
        $this->model->params['id_genre'] = $genreModel->read()[0]->id_genre;

        // get publisher id
        $publisherModel->params = ['WHERE' => "name = '{$this->params['id_publisher']}'"];
        $this->model->params['id_publisher'] = $publisherModel->read()[0]->id_publisher;
        // ddgps($_SESSION);
        if (empty($_SESSION['errors']) && $this->model->save()) {
            $_SESSION['info'] = 'has been successfully added';
        } else {
            $_SESSION['errors']['unexpected'] = 'unexpected error occured';
        }

        header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'add');
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

    /**
     * verify movie form
     * 
     * @param array $exclude ignore|unset empty optional fields
     * 
     * @return void
     */
    public function verifyForm($exclude)
    {
        foreach ($this->params as $key => $value) {
            if (in_array($key, $exclude)) {
                if (empty($value)) {
                    unset($this->params[$key]);
                }
            } else {
                if (empty($value)) {
                    $_SESSION['errors'] = [$key => 'empty field'];
                }
            }
        }
    }
}