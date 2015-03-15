<?php
/**
 * @file BloodPressureLogForm.php
 * @project bloodpressurelog
 * @author Josh Houghtelin <josh@findsomehelp.com>
 * @created 3/15/15 11:17 AM
 */

namespace BloodPressureLog\Form;

use Zend\Form\Form;

class BloodPressureLogForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('BloodPressureLog');

        $this->add([
            'name' => 'id',
            'type' => 'Hidden',
        ]);

        $this->add([
            'name' => 'timestamp',
            'type' => 'text',
            'options' => [
                'label' => 'Timestamp',
            ],
            'attributes' => [
                'placeholder' => date("Y-m-d H:i:s")
            ]
        ]);

        $this->add([
            'name' => 'systolic',
            'type' => 'text',
            'options' => [
                'label' =>'Systolic',
            ],
        ]);

        $this->add([
            'name' => 'diastolic',
            'type' => 'text',
            'options' => [
                'label' => 'Diastolic',
            ],
        ]);

        $this->add([
            'name' => 'bpm',
            'type' => 'text',
            'options' => [
                'label' => 'BPM',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'submitbutton',
            ],
        ]);
    }
}