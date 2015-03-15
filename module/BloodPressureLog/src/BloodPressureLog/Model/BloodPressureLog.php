<?php
/**
 * @file BloodPressureLog.php
 * @project bloodpressurelog
 * @author Josh Houghtelin <josh@findsomehelp.com>
 * @created 3/15/15 10:38 AM
 */

namespace BloodPressureLog\Model;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class BloodPressureLog implements InputFilterAwareInterface
{
    protected $id;
    protected $timestamp;
    protected $systolic;
    protected $diastolic;
    protected $bpm;
    protected $inputFilter;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function exchangeArray(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param $timestamp
     *
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSystolic()
    {
        return $this->systolic;
    }

    /**
     * @param $systolic
     *
     * @return $this
     */
    public function setSystolic($systolic)
    {
        $this->systolic = $systolic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiastolic()
    {
        return $this->diastolic;
    }

    /**
     * @param $diastolic
     *
     * @return $this
     */
    public function setDiastolic($diastolic)
    {
        $this->diastolic = $diastolic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBpm()
    {
        return $this->bpm;
    }

    /**
     * @param $bpm
     *
     * @return $this
     */
    public function setBpm($bpm)
    {
        $this->bpm = $bpm;
        return $this;
    }

    public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not Used");
    }

    public function getInputFilter()
    {
        if(!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add([
                'name' => 'id',
                'required' => true,
                'filters' => [
                    ['name' => 'Int'],
                ],
            ]);

            $inputFilter->add([
                'name' => 'timestamp',
                'required' => false,
                'filters' => [
                    ['name' => 'StripTags'],
                ],
            ]);

            $inputFilter->add([
                'name' => 'systolic',
                'required' => true,
                'filters' => [
                    ['name' => 'Int'],
                ],
            ]);

            $inputFilter->add([
                'name' => 'diastolic',
                'required' => true,
                'filters' => [
                    ['name' => 'Int'],
                ],
            ]);

            $inputFilter->add([
                'name' => 'bpm',
                'required' => true,
                'filters' => [
                    ['name' => 'Int'],
                ],
            ]);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}