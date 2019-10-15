<?php


namespace Seydu\DataGrid;


use App\DataGrid\ListPaginationRendererInterface;
use App\DataGrid\PaginationRouterGenerator;
use Prezent\Grid\Grid;
use Prezent\Grid\GridBuilder;
use Prezent\Grid\GridFactory;
use Prezent\Grid\Extension\Core\GridType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;


class ListBuilder implements ListBuilderInterface
{
    /**
     * @var GridFactory
     */
    private $gridFactory;

    /**
     * @var EngineInterface
     */
    private $twigEngine;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var array
     */
    private $config;

    private $viewData = [];


    /**
     * @var ListDataProviderInterface
     */
    private $dataProvider;

    /**
     * @var ListPaginationRendererInterface
     */
    private $paginationRenderer;

    /**
     * @var PaginationRouterGenerator
     */
    private $paginationRouteGenerator;

    /**
     * ListBuilder constructor.
     * @param GridFactory $gridFactory
     * @param EngineInterface $twigEngine
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        GridFactory $gridFactory,
        EngineInterface $twigEngine,
        UrlGeneratorInterface $router
    )
    {
        $this->gridFactory = $gridFactory;
        $this->twigEngine = $twigEngine;
        $this->router = $router;
        $this->config = [];
    }

    /**
     * @param ListDataProviderInterface $dataProvider
     * @return $this
     */
    public function setDataProvider(ListDataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
        return $this;
    }

    /**
     * @param ListPaginationRendererInterface $paginationRenderer
     * @return $this
     */
    public function setPaginationRenderer(ListPaginationRendererInterface $paginationRenderer)
    {
        $this->paginationRenderer = $paginationRenderer;
        return $this;
    }

    /**
     * @param PaginationRouterGenerator $paginationRouteGenerator
     * @return $this
     */
    public function setPaginationRouteGenerator($paginationRouteGenerator)
    {
        $this->paginationRouteGenerator = $paginationRouteGenerator;
        return $this;
    }

    /**
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return array
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param GridBuilder $gridBuilder
     * @param array $gridColumns
     * @param $gridActions
     * @return Grid
     */
    private function buildGrid(GridBuilder $gridBuilder, array $gridColumns, $gridActions)
    {
        foreach ($gridColumns as $column => $columnConfig) {
            $gridBuilder->addColumn($column, $columnConfig['type'], $columnConfig['options']);
        }
        foreach ($gridActions as $action => $actionConfig) {
            $gridBuilder->addAction($action, $actionConfig);
        }
        return $gridBuilder->getGrid();
    }

    private function getColumnDefinitions()
    {
        return $this->getConfig()['columns'];
    }

    private function getObjectActions()
    {
        return $this->getConfig()['actions'];
    }

    private function getPaginationOptions()
    {
        return $this->getConfig()['pagination']['options'];
    }

    private function getMetadata()
    {
        return $this->getConfig()['metadata'];
    }

    private function getTemplate()
    {
        return empty($this->getConfig()['template']) ? 'default/grid/list.html.twig' : $this->getConfig()['template'];
    }

    /**
     * @param array $options
     * @return string
     */
    public function build(array $options)
    {
        $options['page'] = $this->dataProvider->getCurrentPage();
        $pagerHtml = null;
        if ($this->dataProvider->haveToPaginate()) {
            $paginationOptions = $this->getPaginationOptions();
            $paginationOptions['page'] = $this->dataProvider->getCurrentPage();
            $pagerHtml = $this->paginationRenderer->render(
                $this->dataProvider,
                $this->paginationRouteGenerator,
                $paginationOptions
            );
        }
        $totalResults = $this->dataProvider->count();
        $results = $this->dataProvider->getData();
        $gridColumns = $this->getColumnDefinitions();

        $gridActions = $this->getObjectActions();
        $gridBuilder = $this->gridFactory->createBuilder(GridType::class, $this->getConfig()['options']);
        $grid = $this->buildGrid($gridBuilder, $gridColumns, $gridActions);

        $data = \array_merge(
            $this->viewData,
            [
                'total_results' => $totalResults,
                'pagerHtml' => $pagerHtml,
                'objectViews' => $results,
                'headers' => $gridColumns,
                'grid' => $grid->createView(),
                'metadata' => $this->getMetadata()
            ]
        );
        $template = $this->getTemplate();
        return $this->twigEngine->render($template, $data);
    }
}