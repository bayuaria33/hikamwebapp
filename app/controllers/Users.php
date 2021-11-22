<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User_model');
    }

    public function register()
    {
        $data = [
            'judul' => 'Register',
            'username' => '',
            'level_user' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'level_userError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'level_user' => trim($_POST['level_user']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'level_userError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate level_user
            if (empty($data['level_user'])) {
                $data['level_userError'] = 'Please enter level_user address.';
            } else {
                //Check if level_user exists.
                if ($this->userModel->findUserByLevel($data['level_user'])) {
                    $data['level_userError'] = 'Level is already taken.';
                }
            }

            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['level_userError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->model("User_model")->register($data)) {
                    //Redirect to the login page
                    header('location: ' . BASEURL . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        if ($_SESSION['level_user'] == '1') {
            $this->view('templates/header', $data);
            $this->view('users/register', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function login()
    {
        $data = [
            'judul' => 'Login',
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('templates/header', $data);
                    $this->view('users/login', $data);
                    $this->view('templates/footer');
                }
            }
        } else {
            $data = [
                'judul' => 'Login',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }


        $this->view('templates/header', $data);
        $this->view('users/login', $data);
        $this->view('templates/footer');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['level_user'] = $user['level_user'];
        header('location:' . BASEURL . '/');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['level_user']);
        header('location:' . BASEURL . '/users/login');
    }

    public function index()
    {
        $data['judul'] = "Daftar User";
        $data['user'] = $this->userModel->getAllUsers();
        if ($_SESSION['level_user'] == '1') {
            $this->view('templates/header', $data);
            $this->view('users/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function gantiPass($id)
    {
        $data['judul'] = "Edit data User";
        $data['user'] = $this->userModel->getUserById($id);
        $this->view('templates/header', $data);
        $this->view('users/gantiPass', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        $url = BASEURL . '/Users';
        if ($this->userModel->editPassUser($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");
            exit;
        }
    }
}
