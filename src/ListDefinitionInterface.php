<?php


namespace Seydu\DataGrid;


interface ListDefinitionInterface
{
    /**
     * @return array
     */
    public function getColumns();

    public function getObjectActions();

    public function getOptions();

    public function setSortColumn(string $columnName);
    public function getSortColumn(): string ;

    public function setSortDirection(string $direction);
    public function getSortDirection(): string ;

    public function setSortRoute(string $route);
    public function getSortRoute();


}
