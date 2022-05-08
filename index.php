<?php
    require 'vendor/autoload.php';

    use Manager\Main;

    $main = new Main();

    var_dump($main->run());

    echo "<br> Index";

    