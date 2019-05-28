<?php


namespace App\Service;


class Slugify
{
    public function generate($str)
    {
        return preg_replace("/[à]+/", "a",preg_replace("/[éêè]+/", "e", preg_replace("/[&!,;?_'\"<>%#(){}[\]]+/", "",strtolower(str_replace(" ", "-",trim($str))))));
    }

}