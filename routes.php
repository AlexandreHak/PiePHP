<?php
use Core\Router;

Router::connect('', ['controller' => 'UserController', 'action' => 'index']);
Router::connect('/user/signup', ['controller' => 'UserController', 'action' => 'signup']);
Router::connect('/user/login', ['controller' => 'UserController', 'action' => 'login']);
Router::connect('/user/logout', ['controller' => 'UserController', 'action' => 'logout']);
Router::connect('/user/profile', ['controller' => 'UserController', 'action' => 'profile']);
Router::connect('/user/delete', ['controller' => 'UserController', 'action' => 'deleteProfile']);
Router::connect('/movie', ['controller' => 'MovieController', 'action' => 'index']);
Router::connect('/movie/add', ['controller' => 'MovieController', 'action' => 'add']);
Router::connect('/movie/edit', ['controller' => 'MovieController', 'action' => 'edit']);
Router::connect('/movie/delete', ['controller' => 'MovieController', 'action' => 'delete']);
Router::connect('/genre', ['controller' => 'GenreController', 'action' => 'index']);
Router::connect('/genre/add', ['controller' => 'GenreController', 'action' => 'add']);
Router::connect('/genre/edit', ['controller' => 'GenreController', 'action' => 'edit']);
Router::connect('/genre/delete', ['controller' => 'GenreController', 'action' => 'delete']);
Router::connect('/publisher/add', ['controller' => 'PublisherController', 'action' => 'add']);
Router::connect('/history', ['controller' => 'HistoryController', 'action' => 'index']);
Router::connect('/history/add', ['controller' => 'HistoryController', 'action' => 'add']);
Router::connect('/history/delete', ['controller' => 'HistoryController', 'action' => 'delete']);