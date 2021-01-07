<?php

    if(!isset($_GET['lang']))
        $_SESSION['lang'] = "fr";
    elseif ($_GET['lang'] == "en")
        $_SESSION['lang'] = "en";
    elseif ($_GET['lang'] == "pt")
        $_SESSION['lang'] = "pt";
    elseif ($_GET['lang'] == "it")
        $_SESSION['lang'] = "it";
    elseif ($_GET['lang'] == "ir")
        $_SESSION['lang'] = "ir";
    elseif ($_GET['lang'] == "fr")
        $_SESSION['lang'] = "fr";
