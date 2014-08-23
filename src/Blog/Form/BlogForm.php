<?php 

namespace Blog\Form;

 use Zend\Form\Form;

 class BlogForm extends Form
 {
     public function __construct($name = null)
     {
         parent::__construct('Blog');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'author',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Author',
             ),
         ));
         
         $this->add(array(
             'name' => 'content',
             'type' => 'TextArea',
             'options' => array(
                 'label' => 'Content',
             ),
         ));         
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }