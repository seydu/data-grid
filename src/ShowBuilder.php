<?php


namespace Seydu\DataGrid;


use Prezent\Grid\GridFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;


class ShowBuilder implements ShowBuilderInterface
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

    /**
     * ShowBuilder constructor.
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

    private function getColumnDefinitions()
    {
        return $this->getConfig()['columns'];
    }

    private function getMetadata()
    {
        return $this->getConfig()['metadata'];
    }

    private function getTemplate()
    {
        return empty($this->getConfig()['template']) ? 'default/grid/show.html.twig' : $this->getConfig()['template'];
    }

    /**
     * @param mixed $model
     * @return string
     */
    public function build($model)
    {
        $gridBuilder = $this->gridFactory->createBuilder();
        foreach ($this->getColumnDefinitions() as $column => $columnConfig) {
            $columnOptions = $columnConfig['options'];
            $gridBuilder->addColumn($column, $columnConfig['type'], $columnOptions);
        }
        $data = [
            'data' => $model,
            'grid' => $gridBuilder->getGrid()->createView(),
            'metadata' => $this->getMetadata(),
        ];
        $template = $this->getTemplate();
        $html = $this->twigEngine->render($template, $data);
        return $html;
    }
}