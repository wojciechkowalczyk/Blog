<?php 

namespace Blog\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 
 use Blog\Model\Blog;    
 use Blog\Form\BlogForm; 


 class BlogController extends AbstractActionController
 {
   
     protected $BlogTable;
 
     public function indexAction()
     {    
         return new ViewModel(array(
             'posts' => $this->getBlogTable()->fetchAll(),
         ));
     }
     
     public function showAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);     
     
         return new ViewModel(array(
             'post' => $this->getBlogTable()->getBlog($id),
         ));
     }     

     public function addAction()
     {
         $form = new BlogForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $Blog = new Blog();
             $form->setInputFilter($Blog->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $Blog->exchangeArray($form->getData());
                 $this->getBlogTable()->saveBlog($Blog);

                 return $this->redirect()->toRoute('blog');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('blog', array(
                 'action' => 'add'
             ));
         }

         try {
             $blog = $this->getBlogTable()->getBlog($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('blog', array(
                 'action' => 'index'
             ));
         }

         $form  = new BlogForm();
         $form->bind($blog);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($blog->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getBlogTable()->saveBlog($blog);

                 return $this->redirect()->toRoute('blog');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('Blog');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getBlogTable()->deleteBlog($id);
             }

             return $this->redirect()->toRoute('blog');
         }

         return array(
             'id'    => $id,
             'post' => $this->getBlogTable()->getBlog($id)
         );
     }
     
     public function getBlogTable()
     {
         if (!$this->BlogTable) {
             $sm = $this->getServiceLocator();
             $this->BlogTable = $sm->get('Blog\Model\BlogTable');
         }
         return $this->BlogTable;
     }
 }