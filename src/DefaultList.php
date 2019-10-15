<?php


namespace Seydu\DataGrid;


class DefaultList implements ListInterface
{

    private $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }
    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }
}