<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 13/05/17
 * Time: 10:47
 */

namespace FWAP\Database\Mapper;


use FWAP\Core\Collections\Collection\IteratorCollection;
use FWAP\Database\DatabaseAdapterInterface;
use FWAP\Database\Drives\interfaceDatabase;

abstract class AbstractMapper implements MapperInterface
{
    protected $_adapter;
    protected $_entityTable;
    protected $_entityClass;
    /**
     * @var interfaceDatabase
     */
    private $adapter;


    public function __construct( DatabaseAdapterInterface $adapter, array $entityOptions = array())
    {
        $this->adapter = $adapter;

        if(isset($entityOptions['entityTable'])) {
            $this->setEntityTable($entityOptions['entityTable']);
        }

        if(isset($entityOptions['entityClass'])) {
            $this->setEntityClass($entityOptions['entityClass']);
        }

        $this->checkEntityOptions();
    }

    public function checkEntityOptions() {

        if(!isset($this->_entityTable)) {
            throw new \InvalidArgumentException("the entity table has not been set yet");
        }
        if(!isset($this->_entityClass)) {
            throw new \InvalidArgumentException("the entity class has not been set yet");
        }
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function setEntityTable($entityTable) {

        $table ="";
        if(!is_string($table) || empty($entityTable)) {
            throw  new \InvalidArgumentException("the entity table is invalid");
        }

        $this->_entityTable = $entityTable;
        return $this;
    }

    public function getEntityTable(){
        return $this->_entityTable;
    }

    public function setEntityClass($entityClass) {

        if(!is_subclass_of($entityClass, 'FWAP\Core\Controller')) {
            throw new \InvalidArgumentException("the entity class is invalid");
        }

        $this->_entityClass = $entityClass;
        return $this;
    }

    public function getEntityClass() {
        return $this->_entityClass;
    }

    public function findById($id)
    {
            $this->adapter->select($this->_entityTable, "id= $id");

            if($data = $this->adapter->fetch()) {
                return $this->crateEntity($data);
            }
    }

    public function find($condtions = "")
    {
        $coll = new IteratorCollection();
        $this->adapter->select($this->_entityTable, $coll);

        while ($data = $this->adapter->fetch()) {
            $coll[] = $this->crateEntity($data);
        }
        return $coll;
    }

    abstract protected function crateEntity($data);

}