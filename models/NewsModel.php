<?php
require_once 'config/db_connect.php';

class NewsModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllNews($search = '') {
        $query = "SELECT * FROM news";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE Title LIKE ? OR Description LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT news.*, admin.Fname, admin.Lname 
                                   FROM news 
                                   JOIN admin ON news.AdminID = admin.AdminID 
                                   WHERE NewsID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $description, $content, $admin_id) {
        $stmt = $this->db->prepare("INSERT INTO news (Title, Description, Content, AdminID) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $content, $admin_id]);
    }

    public function updateNews($id, $title, $description, $content) {
        $stmt = $this->db->prepare("UPDATE news SET Title = ?, Description = ?, Content = ? WHERE NewsID = ?");
        return $stmt->execute([$title, $description, $content, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE NewsID = ?");
        return $stmt->execute([$id]);
    }

    public function getNewsWithAdmin($search = '') {
        $query = "SELECT news.*, admin.Fname, admin.Lname 
                  FROM news 
                  JOIN admin ON news.AdminID = admin.AdminID";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE news.Title LIKE ? OR news.Description LIKE ? OR news.Content LIKE ?";
            $params = ["%$search%", "%$search%", "%$search%"];
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}