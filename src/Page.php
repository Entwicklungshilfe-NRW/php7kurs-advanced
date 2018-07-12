<?php

namespace gfu;

class Page
{
    public function getNavigation() {
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

            $html .= '<li><a href="' . $link . '">' . $display . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

    public function getContent()
    {
        require_once '../pages/start.php';

        return $content;
    }
}
