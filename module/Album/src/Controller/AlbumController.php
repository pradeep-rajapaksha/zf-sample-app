<?php 
namespace Album\Controller;

use Album\Model\AlbumTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Form\AlbumForm;
use Album\Model\Album;
use Zend\Db\Adapter\Adapter;

class AlbumController extends AbstractActionController
{
    private $table; 

    public function ___construct( AlbumTable $table )
    {
        $this->table = $table;
    } 

    public function indexAction()
    {

        // var_dump($this->table); 
        // exit(); 
        // die(); 

        return new ViewModel([
            'albums' => $this->table->fetchAll(),
        ]);
    } 

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}

?>