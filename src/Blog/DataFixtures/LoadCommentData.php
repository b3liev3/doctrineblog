<?php
namespace Blog\DataFixtures;

use Blog\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCommentData implements FixtureInterface, DependentFixtureInterface{
    
    /**
     * Number of comments add by post
     */
    const NUMBER_OF_COMMENTS_BY_POST = 5;
    
    /**
     * 
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('Blog\Entity\Post')->findAll();
        
        foreach($posts as $post){
            for($i=1; $i<= self::NUMBER_OF_COMMENTS_BY_POST; $i++){
                $comment = new Comment();
                $comment->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit')
                        ->setPublicationDate(new \DateTime(sprintf('-%ddays',self::NUMBER_OF_COMMENTS_BY_POST - $i)))
                        ->setPost($post);
            }
            
            $manager->persist($comment);
        }
        
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    function getDependencies()
    {
        return ['Blog\DataFixtures\LoadPostData'];
    }
}