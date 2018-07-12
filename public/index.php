<?php

require_once '../vendor/autoload.php';

$page = new \gfu\Page();

$content = $page->getContent();
$navigation = $page->getNavigation();
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
    </body>
</html>
