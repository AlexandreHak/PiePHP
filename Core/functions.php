<?php
function ddgps($data = null)
{
    echo '<pre>';
    is_null($data) ? var_dump($_GET, $_POST, $_SERVER) : var_dump($data);
    echo '</pre>';
    die();
}