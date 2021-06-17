<?php

/**
 * Class Post
 * Gère la logique métier pour les articles
 */
class Post {
    /**
     * @var Database $db
     */
    private $db;

    /**
     * Post constructor.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @return mixed
     * Récupère tous les articles en bdd
     */
    public function findAllPosts() {
        $this->db->query('SELECT * FROM posts ORDER BY created_at ASC');
        return $this->db->fetchAll();
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (user_id, title, slug, image, body, published) VALUES (:user_id, :title, :slug, :image, :body, :published)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':published', $data['published']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE post_id = :post_id');
        $this->db->bind(':post_id', $id);
        return $this->db->fetch();
    }

    public function updatePost($data)
    {
        var_dump($data);
        $this->db->query('UPDATE posts SET title = :title, slug = :slug, image = :image, body = :body WHERE post_id = :post_id');
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':body', $data['body']);
        var_dump($data['post_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id) {
        $this->db->query('DELETE FROM posts WHERE post_id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getComments($id)
    {
        $this->db->query('SELECT * FROM comments JOIN (`users`) USING (`user_id`) WHERE users.user_id = comments.user_id AND post_id = ' . $id . ' ORDER BY comments.created_at ASC');
        return $this->db->fetchAll();
    }

    public function postComment($data)
    {
        $this->db->query('INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `body`, `created_at`) VALUES (NULL, :user_id, :post_id, :body, current_timestamp())');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getReplies($id)
    {
        $this->db->query('SELECT * FROM comment_replies JOIN (`comments`, `posts`) USING (`comment_id`) WHERE posts.post_id = ' . $id . ' ORDER BY comment_replies.created_at ASC');
        return $this->db->fetchAll();
    }

    public function postReply($data)
    {
        $this->db->query('INSERT INTO `comment_replies` (`reply_id`, `comment_id`, `post_id`, `user_id`, `body`) VALUES (NULL, :comment_id, :post_id, :user_id, :body)');
        $this->db->bind(':comment_id', $data['comment_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
