<?php
namespace Core;

class Controller
{
    /**
     * @var mixed
     */
    public $request;
    
    /**
     * @var mixed
     */
    public $params;

    /**
     * @var object instance of ClassModel
     */
    public $model;

    /**
     * @var string
     */
    private static $_render;

    public function __construct()
    {
        $this->request = new Request();
        $this->params = get_object_vars($this->request);
        $this->model =  str_replace('Controller', 'Model', get_class($this));
        $this->model = new $this->model($this->params);
    }

    /**
     * Get content of view file and render it in View/index.php
     * 
     * @param string $view File to render
     * @param array $scope 
     */
    protected function render($view, $scope = [])
    {
        extract($scope);

        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
        str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
        if (file_exists($f)) {
            ob_start();
            include TemplateEngine::parseView($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
            'index']) . '.php');
            self::$_render = ob_get_clean();
        }
    }

    public function isConnected()
    {
        return isset($_SESSION['auth']);
    }

    /**
     * Works like in_array() but for db
     * 
     * Used for searching if movie|genre|publisher... already exist
     * 
     * @param object $tab instanceof corresponding model
     */
    public function inDb(string $val, string $col, $tab)
    {
        $tab->args = [
            'WHERE' => "$col = '$val'"
        ];

        return $tab->find();
    }

    /**
     * @return array without empty value
     */
    public function filterArrayEmpty(array $array)
    {
        return array_filter($array, function($val) {
            return !empty($val);
        });
    }

    /**
     * trim params['genre']
     * Make it general and put it on controller ?
     * 
     * @return int|false 1 => match, 0 => unmatch and false => error occured
     */
    public function verifyParams(array $punctuations = [])
    {
        return preg_match('/^[a-zA-Z0-9 ' . implode('', $punctuations) . ']*$/', $this->params['name']);
    }

    public function __destruct()
    {
        echo self::$_render;
    }
}