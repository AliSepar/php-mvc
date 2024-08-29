<?php
// controllers/post.php

require_once('src/model/model.php');
require_once('src/model/comment.php');

function post(string $identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);

    require('view/post.php');
}
