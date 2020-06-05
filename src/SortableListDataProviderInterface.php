<?php


namespace Seydu\DataGrid;


use Seydu\DataQueryFilter\SortDefinitionInterface;

interface SortableListDataProviderInterface extends ListDataProviderInterface
{
    /**
     * @param SortDefinitionInterface $sortDefinition
     * @return self
     */
    public function setSortDefinition(SortDefinitionInterface $sortDefinition);

    public function createSortDefinition(?string $name, ?string $direction): SortDefinitionInterface;
}
