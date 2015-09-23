<?php

namespace Ekyna\Bundle\BlogBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\BlogBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translationsForms', [
                'form_type' => new CategoryTranslationType(),
                'label'     => false,
                'attr' => [
                    'widget_col' => 12,
                ],
            ])
            ->add('enabled', 'checkbox', [
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => [
                    'align_with_widget' => true,
                ],
            ])
            ->add('seo', 'ekyna_cms_seo')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_category';
    }
}
