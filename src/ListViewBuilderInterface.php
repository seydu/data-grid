<?php


namespace Seydu\DataGrid;


interface ListViewBuilderInterface
{
    /**
     * @param iterable $data
     * @return iterable
     */
    public function buildViews($data);
}
