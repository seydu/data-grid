<?php


namespace Seydu\DataGrid;


interface GridViewBuilderInterface
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function build($data);
}
