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
}
