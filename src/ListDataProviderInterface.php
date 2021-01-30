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
    public function getTotalSize(): int;

    /**
     * @return int
     */
    public function getDataSize(): int;
}
