<?php
/**
 * Created by PhpStorm.
 * User: saidou
 * Date: 9/29/18
 * Time: 11:55 PM
 */

namespace Seydu\DataGrid\Prezent\Grid\Type;


use Prezent\Grid\BaseElementType;
use Prezent\Grid\ElementView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BooleanWithUndefinedType
 * @package App\Prezent\Grid\Type
 */
class BooleanWithUndefinedType extends BaseElementType
{
    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'true_message'  => 'yes',
            'false_message' => 'no',
            'null_message' => 'undefined',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(ElementView $view, array $options)
    {
        $view->vars['true_message' ] = $options['true_message'];
        $view->vars['false_message'] = $options['false_message'];
        $view->vars['null_message'] = $options['null_message'];
    }

    /**
     * {@inheritDoc}
     */
    public function bindView(ElementView $view, $item)
    {
        $view->vars['value'] = null === $view->vars['value'] ? $view->vars['null_message'] :
            ($view->vars['value'] ? $view->vars['true_message'] : $view->vars['false_message']);
    }
}
