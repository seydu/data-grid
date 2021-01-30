<?php


namespace Seydu\DataGrid;


use Seydu\Security\ActionAuthorizationCheckerInterface;

class ListDefinitionProvider implements ListDefinitionProviderInterface
{
    private $actionAuthorizationChecker;
    public function __construct(ActionAuthorizationCheckerInterface $actionAuthorizationChecker)
    {
        $this->actionAuthorizationChecker = $actionAuthorizationChecker;
    }

    private function findByClass($class)
    {
        if(!class_exists($class)) {
            return null;
        }
        $listDefinition = new $class();
        if(!$listDefinition instanceof ListDefinitionInterface) {
            throw new \LogicException("No list definition found because class '$class' is not allowed");
        }
        return $listDefinition;
    }

    public function withActionAuthorizationChecker(ActionAuthorizationCheckerInterface $actionAuthorizationChecker)
    {
        return new self($actionAuthorizationChecker);
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
