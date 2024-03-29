<?php


namespace Seydu\DataGrid;


use Seydu\Security\ActionAuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ListDefinitionProvider implements ListDefinitionProviderInterface
{
    private $actionAuthorizationChecker;
    private $listDefinitionCollection;
    private $translator;

    public function __construct(
        ActionAuthorizationCheckerInterface $actionAuthorizationChecker,
        ListDefinitionCollection $listDefinitionCollection,
        TranslatorInterface $translator
    )
    {
        $this->actionAuthorizationChecker = $actionAuthorizationChecker;
        $this->listDefinitionCollection = $listDefinitionCollection;
        $this->translator = $translator;
    }

    private function create($class): ListDefinitionInterface
    {
        if(!\class_exists($class)) {
            throw new \LogicException("List definition class '$class' does not exist");
        }
        $listDefinition = new $class($this->translator);
        if(!$listDefinition instanceof ListDefinitionInterface) {
            throw new \LogicException("No list definition found because class '$class' is not allowed");
        }
        return $listDefinition;
    }

    private function findByClass($class): ListDefinitionInterface
    {
        return $this->listDefinitionCollection->get($class) ?: $this->create($class);
    }

    public function withActionAuthorizationChecker(ActionAuthorizationCheckerInterface $actionAuthorizationChecker)
    {
        return new self($actionAuthorizationChecker, $this->listDefinitionCollection, $this->translator);
    }

    private function filterObjectActions(ListDefinitionInterface $listDefinition)
    {
        $filteredActions = [];
        foreach ($listDefinition->getObjectActions() as $name => $action) {
            if(isset($action['role'])) {
                if ($this->actionAuthorizationChecker->isGrantedAction($name, $action)) {
                    unset($action['role']);
                    $filteredActions[$name] = $action;
                }
            } else {
                $filteredActions[$name] = $action;
            }
        }
        $listDefinition->setObjectActions($filteredActions);
        return $listDefinition;
    }

    public function load($class)
    {
        $listDefinition = $this->findByClass($class);
        if($listDefinition !== null) {
            return $this->filterObjectActions($listDefinition);
        }
        throw new \LogicException("No list definition found for '$class'");
    }
}
