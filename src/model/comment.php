<?php
require_once('db-config.php');

function getComments($identifier)
{
    $bdd = dbConnect();

    $statement = $bdd->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$identifier]);

    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }

    return $comments;
}

function createComment($post, $author, $comment)
{
    $bdd = dbConnect();
    $query = "INSERT INTO comments (post_id, author, comment) VALUES (:post_id ,:author,:comment)";
    $stmt = $bdd->prepare($query);
    $affectedLines = $stmt->execute([
        'post_id' => $post,
        'author' => $author,
        'comment' => $comment,
    ]);
    return ($affectedLines > 0);
}
