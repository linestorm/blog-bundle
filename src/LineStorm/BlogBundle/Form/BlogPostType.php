<?php

namespace LineStorm\BlogBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostType extends AbstractBlogFormType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'required' => true
            ))
            ->add('liveOn', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data'        => new \DateTime(),
            ))
            ->add('category', 'entity', array(
                'class'    => $this->modelManager->getEntityClass('category'),
                'property' => 'name',
            ))
        ;

        $module = $this->moduleManager->getModule('post');
        foreach($module->getComponents() as $component){
            $component->buildForm($builder, $options);
        }


    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->modelManager->getEntityClass('post')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_blogbundle_blogpost';
    }
}
