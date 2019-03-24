<?php
/**
 * @author: Manoj Tanwar
 * @date: 24/03/2019
 * @version: 1.0
 */
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Utility\Hash;

class DashboardsController extends AppController
{
    public function index()
    {
        $this->set('page_title', 'Dashboard');
		exit;
        $this->set('activeMenu', 'Admin.Dashboards.index');
    }
    

}
