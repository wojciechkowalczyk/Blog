ZF2_blog_module
===============

Separate_blog_ZF2

In order to show blog menu you need to add following line in layout.phtml file:

<?php 
echo $this->navigation('blog')->menu()->setPartial(array('partial/topnav.phtml', 'Blog')); 
?>
