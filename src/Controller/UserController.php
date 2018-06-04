<?php
namespace Controller;

use Core\Controller;
use Model\UserModel;

class UserController extends Controller
{
    private $data;

    public function index()
    {
        $this->render('index');
    }

    /**
     * Check user email and password match
     * 
     * @return void
     */
    public function login()
    {
        if (empty($this->params)) {
            $this->render('login');
            exit;
        }

        $userModel = new userModel($this->params);
        $userModel->table = 'fiche_personne';
        $userModel->args = [
            'WHERE' => "email = '{$this->params['email']}'"
        ];
        
        $user = $userModel->find()[0];
        
        if (empty($user) && !password_verify($this->params['password'], $user->password)) {
            $_SESSION['errors'] = 'Your email address or password is wrong';
            header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'login');
            exit;
        }

        $_SESSION['auth'] = $user->id_perso;
        header('Location: ' . BASE_URI);
        exit;
    }

    /**
     * Either render view page or process data sent by users
     * 
     * If no errors then insert user and redirect to homepage
     * Check if:
     * - post data are valid
     * - post email already exist
     * 
     * @return void
     */
    public function signup()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASE_URI);
            exit;
        }

        if (empty($this->params)) {
            $this->render('signup');
            exit;
        }
        
        $validateForm = $this->validateForm();
        $emailExist = $this->userExist();
        /**
         * Sign up case
         */
        if ($validateForm === true && !$emailExist) {
            $_SESSION['auth'] = $this->insertUser();
            header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR);
            exit; 
        }

        /**
         * Errors case
         */
        $_SESSION['errors'] = $validateForm;
        if ($emailExist) {
            $_SESSION['errors']['your-email'] = 'already exist';
        }
        $_SESSION['post'] = $this->params;
        header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signup');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        $_SESSION['info'] = 'Successful logout';
        header('Location: ' . BASE_URI);
        exit;
    }

    /**
     * render user's profile 
     * if user post data then try to update profile
     * 
     * @return void
     */
    public function profile()
    {
        if (!$this->isConnected()) {
            header('Location: ' . BASE_URI);
            exit;
        }

        if (empty($this->params)) {
            $user = new UserModel();
            $user->table = 'fiche_personne';
            $user->id = [
                'col' => 'id_perso',
                'val' => $_SESSION['auth']
            ];
    
            $this->render('profile', ['user' => $user->read()[0]]);
        } else {
            if (true === $data = $this->validateUpdatedForm()) {
                $user = new UserModel($this->params);
                $user->table = 'fiche_personne';
                $user->id = [
                    'col' => 'id_perso',
                    'val' => $_SESSION['auth']
                ];

                $user->update();
                header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'profile');
            } else {
                // check if errors work
                $_SESSION['errors'] = $data;
                header('Location: ' . BASE_URI . DIRECTORY_SEPARATOR . 'profile');
            }

            // update user profile using method updateUser
            exit;
        }
    }

    /**
     * Works like in_array() but for database
     * 
     * @return bool whether fields already exist or not
     */
    public function userExist(): bool
    {
        $userModel = new UserModel($this->params);
        $userModel->table = 'fiche_personne';
        $userModel->args = [
            'WHERE' => "email = '{$this->params['email']}'"
        ];
        return empty($userModel->find()) ? false : true;
    }

    /**
     * @return int user id
     */
    public function insertUser(): int
    {
        unset($this->params['confirm-password']);
        $this->params['password'] = password_hash($this->params['password'], PASSWORD_DEFAULT);
        
        $userModel = new UserModel($this->params);
        $userModel->table = 'fiche_personne';
        return $userModel->save();
    }

    /**
     * @return array|bool rray of errors or true if form is validate
     */
    public function validateForm()
    {
        $errors = [];
        $fieldLength = [
            'firstname' => 3,
            'lastname' => 3,
            'email' => 8,
            'password' => 8,
            'confirm-password' => 8,
            'birthday' => 10,
            'address' => 6,
            'city' => 4,
            'state' => 4,
            'zip' => 5
        ];

        foreach ($this->params as $key => $value) {
            if (empty($value)) {
                $errors[$key] = "is empty"; 
            } elseif (strlen($this->params[$key]) < $fieldLength[$key]) {
                $errors[$key] = "must be at least {$fieldLength[$key]} long";
            }
        }
        
        if (!filter_var($this->params['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'is invalid';
        }
    
        if ($this->params['password'] !== $this->params['confirm-password']) {
            $errors['password'] = 'does\'t match';
        }
        
        return empty($errors) ? true : $errors; 
    }

    /**
     * if no errors:
     * [x] password_hash
     * [x] unset $this->params['confirm-password']
     * 
     * @return array|bool return array of fields|values to update or false if errors
     */
    public function validateUpdatedForm()
    {
        $errors = [];
        $fieldLength = [
            'firstname' => 3,
            'lastname' => 3,
            'email' => 8,
            'password' => 8,
            'confirm-password' => 8,
            'birthday' => 10,
            'address' => 6,
            'city' => 4,
            'state' => 4,
            'zip' => 5
        ];

        // check password
        if (!empty($this->params['password']) && !empty($this->params['confirm-password'])) {
            if ($this->params['password'] !== $this->params['confirm-password']) {
                $errors['password'] = 'don\'t match';
            } else {
                $this->params['password'] = password_hash($this->params['password'], PASSWORD_DEFAULT);
                unset($this->params['confirm-password']);
            }
        } else {
            unset($this->params['password'], $this->params['confirm-password']);
        }
        
        // check field length && unset empty col
        foreach ($this->params as $key => $value) {
            if (empty($value)) {
                unset($this->params[$key]);
            } elseif (strlen($this->params[$key]) < $fieldLength[$key]) {
                $errors[$key] = "must be at least {$fieldLength[$key]} long";
            }
        }
        
        if (!empty($this->params['email']) && !filter_var($this->params['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'is invalid';
        } else {
            if ($this->userExist()) {
                $errors['email'] = ' already exist';
            }
        }

        return empty($errors) ? true : $errors; 
    }

    public function deleteProfile(): bool
    {
        if ($this->isConnected()) {
            $user = new UserModel($this->params);
            $user->table = 'fiche_personne';
            $user->id = [
                'col' => 'id_perso',
                'val' => $_SESSION['auth'] 
            ];

            $user->delete();
            header('Location: ' . BASE_URI);
            exit;
        }
        header('Location: ' . BASE_URI);
        exit;
    }
}