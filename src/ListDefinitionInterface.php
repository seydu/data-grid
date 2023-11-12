<?php


namespace Seydu\DataGrid;


interface ListDefinitionInterface
{
    public function initialize();
    public function getColumns();
    public function setColumns(array $columns);

    public function getObjectActions();
    public function setObjectActions(array $objectActions);

    public function getOptions();
    public function setOptions(array $options);

    public function setSortColumn(string $columnName);
    public function getSortColumn(): ?string;

    public function setSortDirection(string $direction);
    public function getSortDirection(): string;

    public function setSortRoute(string $route);
    public function getSortRoute(): ?string;

    public function setSortRouteParameters(array $routeParameters);
    public function getSortRouteParameters(): array;




}
