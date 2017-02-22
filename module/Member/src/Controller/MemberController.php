<?php 
namespace Member\Controller;

use Member\Form\MemberForm;
use Member\Model\Member;
use Member\Model\MemberTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MemberController extends AbstractActionController
{
    
    private $table;

    public function __construct(MemberTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'members' => $this->table->fetchAll(),
        ]);
    }
    public function addAction()
    {
        $form = new MemberForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $member = new Member();
        $form->setInputFilter($member->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $member->exchangeArray($form->getData());
        $this->table->saveMember($member);
        return $this->redirect()->toRoute('member');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('member', ['action' => 'add']);
        }

        // Retrieve the member with the specified id. Doing so raises
        // an exception if the member is not found, which should result
        // in redirecting to the landing page.
        try {
            $member = $this->table->getMember($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('member', ['action' => 'index']);
        }

        $form = new MemberForm();
        $form->bind($member);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($member->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveMember($member);

        // Redirect to member list
        return $this->redirect()->toRoute('member', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('member');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteMember($id);
            }

            // Redirect to list of members
            return $this->redirect()->toRoute('member');
        }

        return [
            'id'    => $id,
            'member' => $this->table->getMember($id),
        ];
    }
}