<?php


namespace Seydu\DataGrid;


interface ListRendererInterface
{
    public function render(GridInterface $grid, $views, $data);
}
