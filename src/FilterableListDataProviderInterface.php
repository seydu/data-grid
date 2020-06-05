<?php


namespace Seydu\DataGrid;


interface FilterableListDataProviderInterface extends ListDataProviderInterface
{
    public function getFilters(): array ;
    public function setFilterData(array $filterData): self ;
}
