<?php
namespace Blog\DataFixtures;

use Blog\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

date_default_timezone_set('Europe/Madrid');

/**
 *  Post Fitures
 */
class LoadPostData implements FixtureInterface{
    
    /**
     * Number of posts to add
     */
    const NUMBER_OF_POSTS = 10;
    
    /**
     * 
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i; $i <= self::NUMBER_OF_POSTS; $i++){
            $post = new Post();
            $post->setTitle(sprintf('Blog post number %d',$i))
                    ->setBody("Lorem ipsum dolor sit amet, consectur adipiscing elit.")
                    ->setPublicationDate(new \DateTime(sprintf('-%d days',self::NUMBER_OF_POSTS - $i)));
            
            $manager->persist($post);
        }
        
        $manager->flush();
    }
}