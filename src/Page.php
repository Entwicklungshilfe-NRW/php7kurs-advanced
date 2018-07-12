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
        $users = $this->db->con->table('users');
        $users = $users->select()->get();

        return 'Admin content';
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
}