<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Utility\Hash;
use Cake\Filesystem\File;
use Cake\I18n\Time;

class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index']);
    }

    public function index() 
	{
        $this->set(compact('imagePath'));
    }

}
