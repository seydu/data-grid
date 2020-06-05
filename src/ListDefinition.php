<?php


namespace Seydu\DataGrid;


class ListDefinition implements ListDefinitionInterface
{
    /**
     * @var array
     */
    private $columns;

    /**
     * @var array
     */
    private $objectActions;

    /**
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $sortColumn;

    /**
     * @var string
     */
    private $sortDirection;

    /**
     * @var string
     */
    private $sortRoute;

    public function __construct(array $columns=[], array $objectActions=[], array $options=[])
    {
        $this->columns = $columns;
        $this->objectActions = $objectActions;
        $this->options = $options;
        $this->sortColumn = '';
        $this->sortDirection = 'ASC';
    }

    /**
     * @param array $columns
     * @return self
     */
    protected function setColumns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array $objectActions
     * @return self
     */
    protected function setObjectActions(array $objectActions): self
    {
        $this->objectActions = $objectActions;
        return $this;
    }

    /**
     * @param array $options
     * @return self
     */
    protected function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    public function getObjectActions()
    {
        return $this->objectActions;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setSortColumn(string $columnName)
    {
        $this->sortColumn = $columnName;
        return $this;
    }

    public function getSortColumn(): string
    {
        return $this->sortColumn;
    }

    public function setSortDirection(string $direction)
    {
        $this->sortDirection = $direction;
        return $this;
    }

    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    public function setSortRoute(string $route)
    {
        $this->sortRoute = $route;
        return $this;
    }
    public function getSortRoute()
    {
        return $this->sortRoute;
    }
}
