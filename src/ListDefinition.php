<?php


namespace Seydu\DataGrid;


use Symfony\Contracts\Translation\TranslatorInterface;

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

    /**
     * @var array|null
     */
    private $sortRouteParameters;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(
        TranslatorInterface $translator = null,
        array $columns = [],
        array $objectActions = [],
        array $options = []
    )
    {
        $this->translator = $translator;
        $this->columns = $columns;
        $this->objectActions = $objectActions;
        $this->options = $options;
        $this->sortColumn = '';
        $this->sortDirection = 'ASC';
        $this->sortRouteParameters = [];
        $this->initialize();
        $this->initializeSortDefinition();
    }

    protected function initializeSortDefinition()
    {

    }

    protected function initialize()
    {
        $this->columns = $this->loadColumns();
        $this->objectActions = $this->loadObjectActions();
    }

    /**
     * @param array $columns
     * @return self
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array $objectActions
     * @return self
     */
    public function setObjectActions(array $objectActions)
    {
        $this->objectActions = $objectActions;
        return $this;
    }

    /**
     * @param array $options
     * @return self
     */
    public function setOptions(array $options)
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
    public function getSortRoute(): ?string
    {
        return $this->sortRoute;
    }

    /**
     * @return array|null
     */
    public function getSortRouteParameters(): array
    {
        return $this->sortRouteParameters;
    }

    /**
     * @param array $routeParameters
     * @return self
     */
    public function setSortRouteParameters(array $routeParameters): self
    {
        $this->sortRouteParameters = $routeParameters;
        return $this;
    }
}
