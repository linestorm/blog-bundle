<?php

namespace LineStorm\BlogBundle\Form;

use LineStorm\BlogBundle\Model\ModelManager;
use LineStorm\BlogBundle\Module\ModuleManager;
use Symfony\Component\Form\AbstractType;

abstract class AbstractBlogFormType extends AbstractType
{
    /**
     * ModelManager
     *
     * @var ModelManager
     */
    protected $modelManager;

    /**
     * ModuleManager
     *
     * @var ModuleManager
     */
    protected $moduleManager;

    function __construct(ModelManager $modelManager, ModuleManager $moduleManager = null)
    {
        $this->modelManager = $modelManager;
        $this->moduleManager = $moduleManager;
    }

} 
