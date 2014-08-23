<?php 
return array(
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Blog' => 'Blog\Controller\BlogController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/blog[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Blog\Controller',
                        'controller'    => 'Blog',
                        'action'        => 'index',
                    ),
                 ),
             ),
         ),
     ),

    'service_manager' => array(  
        'factories' => array(
            'blog' => 'Blog\Navigation\Service\BlogNavigationFactory',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
    ),
     
    'navigation' => array(
        'blog' => array(
            'blog' => array(
                'label'    => 'Blog',
                'route'    => 'blog',
                'pages'    => array( 
                    array(
                        'label'    => 'Add',
                        'route'    => 'blog', 
                        'action'   => 'add',  
                    ),                    
                ),                
            ),  
         
        ),
    ),     
     
);