<?php

namespace BloodPressureLog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BloodPressureLogController extends AbstractActionController
{

    protected $bloodPressureLogTable = null;

    public function indexAction()
    {
        $form = new BloodPressureLogForm();

                                $request = $this->getRequest();
                                if($request->isPost()) {
                                    $bloodPressureLog = new BloodPressureLog();
                                    $form->setInputFilter($bloodPressureLog->getInputFilter());
                                    $form->setData($request->getPost());

                                    if($form->isValid()) {
                                        $bloodPressureLog->setOptions($form->getData());
                                        $this->getBloodPressureLogTable()->saveBloodPressureLog($bloodPressureLog);
                                    }
                                }

                                return new ViewModel([
                                    'bloodPressureLog' => $this->getBloodPressureLogTable()->fetchAll(),
                                    'form' => $form,
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
                        if($request->isPost()) {
                            $bloodPressureLog = new BloodPressureLog();
                            $form->setInputFilter($bloodPressureLog->getInputFilter());
                            $form->setData($request->getPost());

                            if($form->isValid()) {
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
        return new ViewModel();
    }

    public function DeleteAction()
    {
        return new ViewModel();
    }


}

