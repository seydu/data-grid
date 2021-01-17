<?php


namespace Seydu\DataGrid;


use Symfony\Component\PropertyAccess\PropertyAccess;

class View
{
    private $_object;
    private $_data;
    private $_propertyPath;

    public function __construct($object, $data)
    {
        $this->_object = $object;
        $this->_data = $data;
        $this->_propertyPath = PropertyAccess::createPropertyAccessor();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return $this->_propertyPath->getValue($this->_object, $name);
    }
}
