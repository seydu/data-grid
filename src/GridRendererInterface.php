<?php


namespace Seydu\DataGrid;


interface GridRendererInterface
{
    public function render(GridInterface $grid, $view);
}
