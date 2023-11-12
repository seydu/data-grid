<?php


namespace Seydu\DataGrid;


use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractListDefinition implements ListDefinitionInterface
{
    /**
     * @var bool
     */
    private $initialized;
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
        $this->initialized = false;
        $this->translator = $translator;
        $this->columns = $columns;
        $this->objectActions = $objectActions;
        $this->options = $options;
        $this->sortColumn = '';
        $this->sortDirection = 'ASC';
        $this->sortRouteParameters = [];
    }

    abstract protected function loadColumns();
    abstract protected function loadObjectActions();


    protected function initializeSortDefinition()
    {

    }

    public function initialize()
    {
        $this->columns = $this->loadColumns();
        $this->objectActions = $this->loadObjectActions();
        $this->initializeSortDefinition();
        $this->initialized = true;
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
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->columns;
    }

    public function getObjectActions()
    {
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->objectActions;
    }

    public function getOptions()
    {
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->options;
    }

    public function setSortColumn(string $columnName)
    {
        $this->sortColumn = $columnName;
        return $this;
    }

    public function getSortColumn(): string
    {
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->sortColumn;
    }

    public function setSortDirection(string $direction)
    {
        $this->sortDirection = $direction;
        return $this;
    }

    public function getSortDirection(): string
    {
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->sortDirection;
    }

    public function setSortRoute(string $route)
    {
        $this->sortRoute = $route;
        return $this;
    }
    public function getSortRoute(): ?string
    {
        if(!$this->initialized) {
            $this->initialize();
        }
        return $this->sortRoute;
    }

    /**
     * @return array|null
     */
    public function getSortRouteParameters(): array
    {
        if(!$this->initialized) {
            $this->initialize();
        }
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
