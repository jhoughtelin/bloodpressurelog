<?php
namespace BloodPressureLog;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'BloodPressureLog\Model\BloodPressureLogTable' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\BloodPressureLogTable($dbAdapter);
                    return $table;
                }
            ],
        ];
    }
}
