<?php

namespace gfu;

use gfu\Db;

class Page
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function getNavigation($path = '../pages/')
    {
        $html = $this->getHtmlForDirectoryPath($path);

        return $html;
    }

    public function getContent()
    {
        $fileName = 'start';

        if (isset($_GET['page'])) {
            $fileName = $_GET['page'];
        }

        $possibleDirectories = [
            'pages',
            'footer',
            'admin'
        ];

        $isFileFound = false;
        foreach ($possibleDirectories as $possibleDirectory) {
            $pathToFile = '../' . $possibleDirectory . '/' . $fileName . '.php';
            if(is_file($pathToFile)) {
                $isFileFound = true;
                break;
            }
        }

        if(!$isFileFound) {
            $pathToFile = '../pages/404.php';
        }

        require_once $pathToFile;

        return $content;
    }

    private function getAdminContent() {
        if(isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Input validation

            // Edit case
            if(isset($_POST['id'])) {
                $id = $_POST['id'];

                $params = [
                    'table' => 'users',
                    'values' => [
                        'id' => $id,
                        'username' => $username,
                        'password' => $password
                    ]
                ];

                $this->db->updateTable($params);
            }
            // Add case

            // Error handling
        }

        $html = $this->getHtmlForAdminForm();

        return $html;
    }

    /**
     * @param $path
     * @return string
     */
    private function getHtmlForDirectoryPath($path)
    {
        $fileExtension = '.php';
        $files = glob($path . '*' . $fileExtension);

        $html = '<ul>';
        foreach ($files as $file) {
            $name = str_replace(
                [
                    $path,
                    $fileExtension
                ],
                '',
                $file
            );
            $link = '/teilnehmer-advanced/public/?page=' . $name;
            $display = ucfirst($name);

            if ($name !== '404') {
                $html .= '<li><a href="' . $link . '">' . $display . '</a></li>';
            }
        }

        $html .= '</ul>';
        return $html;
    }

    /**
     * @param $users
     * @return string
     */
    private function getHtmlForAdminForm()
    {
        $users = $this->db->getTable('users');
        $html = '';
        $html .= '<h2>Edit Users</h2>';
        foreach ($users as $user) {
            $html .= '<form action="" method="post">';
            $html .= '<label for="username">Username</label>';
            $html .= '<input type="text" name="username" id="username" value="' . $user['username'] . '">';
            $html .= '<label for="password">Password</label>';
            $html .= '<input type="password" name="password" id="password" value="' . $user['password'] . '">';
            $html .= '<input type="hidden" name="id" value="' . $user['id'] . '">';
            $html .= '<input type="submit" value="edit">';
            $html .= '</form>';
        }
        return $html;
//            <h2>Add User</h2>
//            <form action="" method="post">
//                <label for="username">Username</label>
//                <input type="text" name="username" id="username">
//                <label for="password">Password</label>
//                <input type="password" name="password" id="password">
//                <input type="submit" value="add">
//            </form>
    }
}