<?php
/**
 * Created by PhpStorm.
 * User: saidou
 * Date: 9/7/18
 * Time: 4:41 PM
 */

namespace Seydu\DataGrid\Prezent\Grid\Type;


use Prezent\Grid\BaseElementTypeExtension;
use Prezent\Grid\ElementView;
use Prezent\Grid\Extension\Core\Type\ColumnType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortableTypeExtension extends BaseElementTypeExtension
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $fieldParameter;

    /**
     * @var string
     */
    private $orderParameter;

    /**
     * Constructor
     *
     * @param RequestStack $requestStack
     * @param string $fieldParameter
     * @param string $orderParameter
     */
    public function __construct(RequestStack $requestStack, $fieldParameter = 'sort_by', $orderParameter = 'sort_order')
    {
        $this->requestStack = $requestStack;
        $this->fieldParameter = $fieldParameter;
        $this->orderParameter = $orderParameter;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'sortable'              => false,
                'sort_field'            => null,
                'sort_route'            => null,
                'sort_route_parameters' => null,
                'sort_field_parameter'  => $this->fieldParameter,
                'sort_order_parameter'  => $this->orderParameter,

                'is_default_sort'            => false,
                'default_sort_order'         => 'ASC',
            ])
            ->setAllowedTypes('sortable', 'bool')
            ->setAllowedTypes('sort_field', ['null', 'string'])
            ->setAllowedTypes('sort_route', ['null', 'string'])
            ->setAllowedTypes('sort_route_parameters', ['null', 'array'])
            ->setAllowedTypes('sort_field_parameter', 'string')
            ->setAllowedTypes('sort_order_parameter', 'string')
            ->setAllowedTypes('is_default_sort', 'bool')
            ->setAllowedTypes('default_sort_order', ['null', 'string'])
            ->setAllowedValues('default_sort_order', [null, 'asc', 'desc', 'ASC', 'DESC'])
        ;
    }

    /**
     * @internal
     * @param Request $request
     * @param array $options
     * @param string $columnName
     * @return array
     */
    private function processActiveColumn(Request $request, array $options, $columnName)
    {
        $sortColumn = $request->get($options['sort_field_parameter']);
        $activeSortOrder = $request->get($options['sort_order_parameter'], 'ASC');
        if(!$sortColumn && $options['is_default_sort']) {
            $sortColumn = $columnName;
            $activeSortOrder = $options['default_sort_order'];
        }
        $isActive = $columnName == $sortColumn;
        $sortOrder = 'ASC' === $activeSortOrder ? 'DESC' : 'ASC';
        return [$isActive, $sortOrder];
    }

    /**
     * @inheritdoc
     */
    public function buildView(ElementView $view, array $options)
    {
        if (!$options['sortable'] || !($request = $this->requestStack->getCurrentRequest())) {
            return;
        }
        $columnName = $view->name;
        list($active, $order) = $this->processActiveColumn($request, $options, $columnName);

        $sortField = $options['sort_field'] ?: $columnName;
        $routeParams = $options['sort_route_parameters'] ?: $request->attributes->get('_route_params', []);
        $routeParams = array_merge($routeParams, $request->query->all());
        $routeParams[$options['sort_field_parameter']] = $sortField;
        $routeParams[$options['sort_order_parameter']] = $order;

        $view->vars['sort_route'] = $options['sort_route'] ?: $request->attributes->get('_route');
        $view->vars['sort_route_parameters'] = $routeParams;
        $view->vars['sort_active'] = $active;
        $view->vars['sort_order'] = $order;
    }

    public function getExtendedType()
    {
        return ColumnType::class;
    }
}