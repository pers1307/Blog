<?php
    if ($status === 'Unaccept') {
        require 'views/Template/alertControlPage.html';
    } else {
        require 'views/acceptedControlPage.php';
    }