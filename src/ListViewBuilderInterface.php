<?php


namespace Seydu\DataGrid;


interface ListViewBuilderInterface
{
    /**
     * @param iterable $dataSet
     * @return iterable
     */
    public function buildViews($dataSet);
}
