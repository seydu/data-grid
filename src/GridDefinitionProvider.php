<?php


namespace Seydu\DataGrid;


use Symfony\Contracts\Translation\TranslatorInterface;

class GridDefinitionProvider implements GridDefinitionProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
    }

    private function findByClass($class)
    {
        if(!class_exists($class)) {
            return null;
        }
        $gridDefinition = new $class($this->translator);
        if(!$gridDefinition instanceof DefinitionInterface) {
            throw new \LogicException("No grid definition found because class '$class' is not allowed");
        }
        return $gridDefinition;
    }

    public function load($class)
    {
        $gridDefinition = $this->findByClass($class);
        if($gridDefinition !== null) {
            return $gridDefinition;
        }
        throw new \LogicException("No grid definition found for '$class'");
    }
}
