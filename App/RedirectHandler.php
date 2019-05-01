<?php


class RedirectHandler
{
    static function HTTP_301($target)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: {$target}");
        exit();
    }
}