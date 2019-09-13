<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * News cell
 */
class NewsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('News');
        $news = $this->News->find()->where(['is_deleted'=>false, 'status'=>'Approved'])->limit(4);
        $this->set('news', $news);
    }
}
