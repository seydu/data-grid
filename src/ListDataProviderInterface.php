<?php


namespace Seydu\DataGrid;


interface ListDataProviderInterface
{
    /**
     * @return array|iterable
     */
    public function getData();

    /**
     * @return int
     */
    public function getTotalSize();

    /**
     * @return int
     */
    public function getDataSize();
}
