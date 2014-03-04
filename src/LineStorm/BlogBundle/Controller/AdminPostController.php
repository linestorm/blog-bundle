<?php

namespace LineStorm\BlogBundle\Controller;

use LineStorm\BlogBundle\Form\BlogPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminPostController extends Controller
{
    public function listAction()
    {
        $user = $this->getUser();
        if(!($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $posts = $modelManager->get('post')->findAll();

        return $this->render('LineStormBlogBundle:Modules:Post/list.html.twig', array(
            'posts' => $posts,
        ));
    }


    public function editAction($id)
    {
        $user = $this->getUser();
        if(!($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $post = $modelManager->get('post')->find($id);

        return $this->render('LineStormBlogBundle:Modules:Post/edit.html.twig', array(
            'post' => $post,
        ));
    }


    public function newAction()
    {
        $user = $this->getUser();
        if(!($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');
        $class        = $modelManager->getEntityClass('post');
        $entity       = new $class();

        $form = $this->createForm(new BlogPostType($modelManager), $entity, array(
            'action' => $this->generateUrl('linestorm_blog_api_post_post'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $this->render('LineStormBlogBundle:Modules:Post/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
