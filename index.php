<?php
    require 'vendor/autoload.php';

    // use Manager\Main;
    use Manager\CountryList;

    // $main = new Main();
    $countlist = new CountryList();

    // var_dump($main->run());

    var_dump($countlist->createWorld());

    echo "<br> Index";

    