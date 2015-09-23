<?php

namespace Ekyna\Bundle\BlogBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class PostType
 * @package Ekyna\Bundle\BlogBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PostType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('title', 'anchor', [
                'label' => 'ekyna_core.field.title',
                'sortable' => true,
                'route_name' => 'ekyna_blog_post_admin_show',
                'route_parameters_map' => [
                    'postId' => 'id'
                ],
            ])
            ->addColumn('category', 'anchor', [
                'label' => 'ekyna_blog.category.label.singular',
                'sortable' => true,
                'property_path' => 'category.name',
                'route_name' => 'ekyna_blog_category_admin_show',
                'route_parameters_map' => [
                    'categoryId' => 'category.id'
                ],
            ])
            ->addColumn('publishedAt', 'datetime', [
                'label' => 'ekyna_core.field.published_at',
                'sortable' => true,
            ])
            ->addColumn('createdAt', 'datetime', [
                'label' => 'ekyna_core.field.created_at',
                'sortable' => true,
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_blog_post_admin_edit',
                        'route_parameters_map' => [
                            'postId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_blog_post_admin_remove',
                        'route_parameters_map' => [
                            'postId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
            ->addFilter('title', 'text', [
                'label' => 'ekyna_core.field.title',
            ])
            ->addFilter('category', 'entity', [
                'label' => 'ekyna_blog.category.label.singular',
                'class' => 'Ekyna\Bundle\BlogBundle\Entity\Category',
            ])
            ->addFilter('publishedAt', 'datetime', [
                'label' => 'ekyna_core.field.published_at',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    /*public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'default_sort' => 'position asc',
            'max_per_page' => 100,
        ));
    }*/

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_post';
    }
}
