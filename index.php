<?php
/**
 * GIT
 * [ ] merge branch and final push
 * 
 * NOTES: 
 * uri parameter:
 * e.g. http://localhost/PiePHP/user/show/1
 * [ ] check entity pdf
 * [ ] use city/country/zip api for signup
 * [ ] user logo first letter must be his char
 * 
 * MAIN QUESTS
 * [X] .htaccess file
 * [ ] Model relation: hasMany, hasOne...
 * [X] Use ajax for auto complete
 * [ ] Enfin, vous devez permettre à l’utilisateur de votre framework, lorsqu’il utilise les méthodes read et
find de votre ORM d’obtenir tous enregistrements liés à l’enregistrement demandé.
 * 
 * BONUS
 * [X] movie data autocomplete from tmdb
 * [X] auto instanciation model with parameters
 * [ ] other type of relations
 * 
 * BUGS
 * [X] header locations => document root
 * [ ] session clear (core\core destruct) not working when displaying 
 * [X] if user is logged in then he mustn't be able to access login page
 * [X] profile page: birthday format date
 * [X] profile page: select country (e.g. put selected and value="")
 * [ ] re-check validate updatedform
 * [ ] user logo not centered
 * [ ] when delete profile: delete fiche_personne/membre...
 */

session_start();

require_once 'Core\functions.php';
define('BASE_URI', str_replace('\\', '/', substr(__DIR__, 
strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

use Core\Core;

$app = new Core();
$app->run();

/**
 * In controllers:
 * $app['database']->insert('users, [
 *  'name' => $_POST['name]
 * ])
 * 
 * in controller:
 * header('Location: /');
 * 
 * Your First DI Container
 * in core/App.php
 * https://laracasts.com/series/php-for-beginners/episodes/22?autoplay=true
 */