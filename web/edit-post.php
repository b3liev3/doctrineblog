<?php
/**
 * Creates or edits a blog post
 */

use Blog\Entity\Post;

require_once __DIR__.'/../src/bootstrap.php';

//Retrieve the blog post if an id parameter exists
if(isset($_GET['id'])){
    /** @var Post $psot The post to edit */
    $post = $entityManager->find('Blog\Entity\Post',$_GET['id']);
    
    if(!$post){
        throw new Exception('Post not found');
    }
}

//create or update the blog post
if('POST' === $_SERVER['REQUEST_METHOD']){
    //create a new post if a post has not been retrieved and set its date of publication
    if(!isset($post)){
        $post = new Post();
        //manage the entity
        $entityManager->persist($post);
        $post->setPublicationDate(new DateTime());
    }
    
    $post->setTitle($_POST['title'])
            ->setBody($_POST['body']);
    
    //Flush changes to the database
    $entityManager->flush();
    
    //redirect to the index
    header('Location: index.php');
    exit;
}

/** @var string Page title */
$pageTitle = isset($post) ? sprintf('Edit post #%d',$post->getId()) : 'Create a new post'; 
?>

<html>
    <head>
        <meta charset="utf-8">
        <title><?=$pageTitle?> - My blog</title>
    </head>
    <body>
        <h1><?=$pageTitle?></h1>
        <form method="POST">
            <label>Title <input type="text" name="title" value="<?=isset($post) ? htmlspecialchars($post->getTitle()) : '' ?>" maxlength="255" required></label><br/>
            <label>Body <textarea name="body" cols="20" rows="10" required><?=isset($post) ? htmlspecialchars($post->getBody()) : '' ?></textarea></label><br/>
            
            <input type="submit" />
        </form>
        
        <a href="index.php">Back to index</a>
    </body>
</html>