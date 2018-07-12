<?php

require_once '../vendor/autoload.php';

$page = new \gfu\Page();

$content = $page->getContent();
$navigation = $page->getNavigation();
$footerNavigation = $page->getNavigation('../footer/');
?>

<html>
    <title>
        <?= $content['title'] ?>
    </title>
    <body>
    <nav>
        <?= $navigation ?>
    </nav>
    <div class="content">
        <h1>
            <?= $content['headline'] ?>
        </h1>
        <p>
            <?= $content['bodytext'] ?>
        </p>
    </div>
    <footer>
        <h4>Footer</h4>
        <p>
            <?= $footerNavigation ?>
        </p>
    </footer>
    </body>
</html>
