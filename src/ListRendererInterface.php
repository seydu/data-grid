<?php


namespace Seydu\DataGrid;


interface ListRendererInterface
{
    public function render(ListInterface $list, $options);
}