<?php

namespace Blog\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class BlogNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'blog';
    }
}