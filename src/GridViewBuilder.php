<?php


namespace Seydu\DataGrid;


class GridViewBuilder implements GridViewBuilderInterface
{
    public function build($entity)
    {
        return new View($entity, $this->buildData($entity));
    }
    /**
     * @param mixed $data
     * @return array
     */
    protected function buildData($data)
    {
        return [];
    }
    protected function renderCollection(array $items)
    {
        return sprintf(
            "<ul>%s</ul>",
            implode(
                "",
                array_map(
                    function ($item) { return "<li>$item</li>";},
                    $items
                )
            )
        );
    }
}
