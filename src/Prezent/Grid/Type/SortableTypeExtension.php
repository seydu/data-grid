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
                'sortable'  => false,
                'sort_field' => null,
                'sort_route'  => null,
                'sort_route_parameters' => null,
                'sort_field_parameter' => $this->fieldParameter,
                'sort_order_parameter' => $this->orderParameter,

                'is_active_sort' => false,
                'current_sort_order'  => null,
            ])
            ->setAllowedTypes('sortable', 'bool')
            ->setAllowedTypes('sort_field', ['null', 'string'])
            ->setAllowedTypes('sort_route', ['null', 'string'])
            ->setAllowedTypes('sort_route_parameters', ['null', 'array'])
            ->setAllowedTypes('sort_field_parameter', 'string')
            ->setAllowedTypes('sort_order_parameter', 'string')
            ->setAllowedTypes('is_active_sort', 'bool')
            ->setAllowedValues('current_sort_order', [null, 'asc', 'desc', 'ASC', 'DESC'])
        ;
    }

    /**
     * @inheritdoc
     */
    public function buildView(ElementView $view, array $options)
    {
        if (!$options['sortable']) {
            return;
        }
        $columnName = $view->name;
        $active = $options['is_active_sort'];
        $currentOrder = $options['current_sort_order'];
        $order = 'ASC' === $currentOrder ? 'DESC' : 'ASC';

        $sortField = $options['sort_field'] ?: $columnName;
        $routeParams = $options['sort_route_parameters'];
        $routeParams[$options['sort_field_parameter']] = $sortField;
        $routeParams[$options['sort_order_parameter']] = $order;

        $view->vars['sort_route'] = $options['sort_route'];
        $view->vars['sort_route_parameters'] = $routeParams;
        $view->vars['sort_active'] = $active;
        $view->vars['sort_order'] = $order;
    }

    public function getExtendedType()
    {
        return ColumnType::class;
    }
}
