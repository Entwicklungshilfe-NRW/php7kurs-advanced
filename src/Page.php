<?php

namespace gfu;

class Page
{
    public function getNavigation()
    {
        $path = '../pages/';
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

            if($name !== '404') {
                $html .= '<li><a href="' . $link . '">' . $display . '</a></li>';
            }
        }

        $html .= '</ul>';

        return $html;
    }

    public function getContent()
    {
        $fileName = 'start';

        if (isset($_GET['page'])) {
            $fileName = $_GET['page'];
        }

        $pathToFile = '../pages/' . $fileName . '.php';

        if(!is_file($pathToFile)) {
            $pathToFile = '../pages/404.php';
        }

        require_once $pathToFile;

        return $content;
    }
}