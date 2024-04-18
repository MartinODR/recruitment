<?php

namespace App\Controller;     //learn namespaces 



class HomeController extends BaseController
{
    public function index()
    {
        //echo 'hallo vom HomeController - index()';
       parent::loadView('home');
    }
}