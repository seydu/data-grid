<?php


namespace Seydu\DataGrid;


interface GridViewBuilderInterface
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function build($data);

    /**
     * @param ViewDataBuilderInterface $viewDataBuilder
     * @return $this
     */
    public function setViewDataBuilder(ViewDataBuilderInterface $viewDataBuilder);
}
