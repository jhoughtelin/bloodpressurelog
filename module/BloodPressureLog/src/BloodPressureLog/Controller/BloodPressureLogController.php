<?php

namespace BloodPressureLog\Controller;

use BloodPressureLog\Form\BloodPressureLogForm;
use BloodPressureLog\Model\BloodPressureLog;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BloodPressureLogController extends AbstractActionController
{

    protected $bloodPressureLogTable = null;

    public function indexAction()
    {
        $form = new BloodPressureLogForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $bloodPressureLog = new BloodPressureLog();
            $form->setInputFilter($bloodPressureLog->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $bloodPressureLog->setOptions($form->getData());
                $this->getBloodPressureLogTable()->saveBloodPressureLog($bloodPressureLog);
            }
        }

        return new ViewModel([
            'bloodPressureLog' => $this->getBloodPressureLogTable()->fetchAll(),
            'form'             => $form,
        ]);
    }

    public function getBloodPressureLogTable()
    {
        if (!$this->bloodPressureLogTable) {
            $sm = $this->getServiceLocator();
            $this->bloodPressureLogTable = $sm->get('BloodPressureLog\Model\BloodPressureLogTable');
        }
        return $this->bloodPressureLogTable;
    }

    public function AddAction()
    {
        $form = new BloodPressureLogForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $bloodPressureLog = new BloodPressureLog();
            $form->setInputFilter($bloodPressureLog->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $bloodPressureLog->setOptions($form->getData());
                $this->getBloodPressureLogTable()->saveBloodPressureLog($bloodPressureLog);

                return $this->redirect()->toRoute('bloodpressurelog');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function EditAction()
    {
        $id = (int) $this->params()->fromRoute('id',0);
        if(!$id) {
            return $this->redirect()->toRoute('bloodpressurelog',['action' => 'add']);
        }

        try {
            $bloodPressureLog = $this->getBloodPressureLogTable()->getBloodPressureLog($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('bloodpressurelog',['action' => 'index']);
        }

        $form = new BloodPressureLogForm();
        $form->bind($bloodPressureLog);
        $form->get('submit')->setAttribute('value','Edit');

        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setInputFilter($bloodPressureLog->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()) {
                $this->getBloodPressureLogTable()->saveBloodPressureLog($bloodPressureLog);
                return $this->redirect()->toRoute('bloodpressurelog');
            }
        }

        return new ViewModel([
            'id' => $id,
            'form' => $form,
        ]);
    }

    public function DeleteAction()
    {
        $id = (int) $this->params()->fromRoute('id',0);
        if(!$id) {
            return $this->redirect()->toRoute('bloodpressurelog');
        }

        $request = $this->getRequest();
        if($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getBloodPressureLogTable()->deleteBloodPressureLog($id);
            }

            return $this->redirect()->toRoute('bloodpressurelog');
        }

        return new ViewModel([
            'id' => $id,
            'bloodPressureLog' => $this->getBloodPressureLogTable()->getBloodPressureLog($id),
        ]);
    }
}

