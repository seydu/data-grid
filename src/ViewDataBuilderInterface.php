<?php


namespace Seydu\DataGrid;


interface ViewDataBuilderInterface
{
    /**
     * @param $object
     * @return array|\ArrayAccess
     */
    public function buildData($object);
}
