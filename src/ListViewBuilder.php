<?php


namespace Seydu\DataGrid;


class ListViewBuilder implements ListViewBuilderInterface
{
    public function buildViews($data)
    {
        $results = [];
        foreach ($data as $entity) {
            $results[] = new View($entity, $this->buildData($entity));
        }
        return $results;
    }

    /**
     * @param $entity
     * @return array
     */
    protected function buildData($entity)
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
