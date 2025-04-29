<?php
require_once 'config/db_connect.php';

class NewsModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllNews($search = '', $limit = 10, $offset = 0) {
        $query = "SELECT n.*, p.promotion_type, p.promotion_name 
                  FROM news n 
                  LEFT JOIN promotions p ON n.promotion_id = p.promotion_id";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE n.Title LIKE ? OR n.Description LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);

        if (!empty($search)) {
            $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);
            $stmt->bindValue(2, "%$search%", PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT news.*, admin.Fname, admin.Lname, CONCAT(admin.Fname, ' ', admin.Lname) AS AdminName 
                                   FROM news 
                                   JOIN admin ON news.AdminID = admin.AdminID 
                                   WHERE NewsID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $description, $content, $admin_id, $news_type, $promotion_id = null, $thumbnail = null) {
        $query = "INSERT INTO news (Title, Description, Content, AdminID, news_type, promotion_id, thumbnail) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $description, $content, $admin_id, $news_type, $promotion_id, $thumbnail]);
    }

    public function updateNews($id, $title, $description, $content, $news_type, $promotion_id = null, $thumbnail = null) {
        $query = "UPDATE news SET Title = ?, Description = ?, Content = ?, news_type = ?, promotion_id = ?, thumbnail = ? 
                  WHERE NewsID = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $description, $content, $news_type, $promotion_id, $thumbnail, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE NewsID = ?");
        return $stmt->execute([$id]);
    }

    public function getNewsWithAdmin($search = '', $limit = 10, $offset = 0) {
        $query = "SELECT n.*, CONCAT(admin.Fname, ' ', admin.Lname) AS AdminName, p.promotion_name 
                  FROM news n 
                  JOIN admin ON n.AdminID = admin.AdminID 
                  LEFT JOIN promotions p ON n.promotion_id = p.promotion_id";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE n.Title LIKE ? OR n.Description LIKE ? OR n.Content LIKE ?";
            $params = ["%$search%", "%$search%", "%$search%"];
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);

        if (!empty($search)) {
            $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);
            $stmt->bindValue(2, "%$search%", PDO::PARAM_STR);
            $stmt->bindValue(3, "%$search%", PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsCount($search = '') {
        $query = "SELECT COUNT(*) 
                  FROM news 
                  JOIN admin ON news.AdminID = admin.AdminID";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE news.Title LIKE ? OR news.Description LIKE ? OR news.Content LIKE ?";
            $params = ["%$search%", "%$search%", "%$search%"];
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getPublicNewsCount($search = '') {
        $query = "SELECT COUNT(*) FROM news";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE Title LIKE ? OR Description LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}