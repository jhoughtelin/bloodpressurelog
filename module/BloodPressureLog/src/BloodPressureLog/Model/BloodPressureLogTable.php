<?php
/**
 * @file BloodPressureLogTable.php
 * @project bloodpressurelog
 * @author Josh Houghtelin <josh@findsomehelp.com>
 * @created 3/15/15 10:45 AM
 */

namespace BloodPressureLog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class BloodPressureLogTable extends AbstractTableGateway
{
    protected $table = 'bloodpressurelog';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function fetchAll()
    {
        $resultSet = $this->select(function (Select $select) {
            $select->order('timestamp ASC');
        });
        $entities = [];
        foreach($resultSet as $row) {
            $entity = new BloodPressureLog();
            $entity->setId($row->id)
                ->setTimestamp($row->timestamp)
                ->setSystolic($row->systolic)
                ->setDiastolic($row->diastolic)
                ->setBpm($row->bpm);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function saveBloodPressureLog(BloodPressureLog $bloodPressureLog)
    {
        $data = [
            'timestamp' => $bloodPressureLog->timestamp,
            'systolic' => $bloodPressureLog->systolic,
            'diastolic' => $bloodPressureLog->diastolic,
            'bpm' => $bloodPressureLog->bpm,
        ];

        if(empty($data['timestamp'])) {
            unset($data['timestamp']);
        }

        $id = (int) $bloodPressureLog->id;
        if($id == 0) {
            // Insert
            $this->insert($data);
        } else {
            // Update
            $this->update($data, ['id' => $id]);
        }
    }
}