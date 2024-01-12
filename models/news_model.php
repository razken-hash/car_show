<?php

require_once 'connection.php';

class NewsNews extends Connection
{

    private function checkNewsIfExists($title)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM news WHERE title = :title";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getNews()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM news";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getnewsNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM news";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getNewsById($newsid)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM news WHERE newsid = :newsid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['newsid' => $newsid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteNews($newsid)
    {
        try {
            $result = $this->getNewsById($newsid);

            if ($result) {
                $pdo = $this->connect();
                try {
                    $sql = "DELETE FROM news WHERE newsid = :newsid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['newsid' => $newsid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("News not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    
    public function createNews($title, $summary, $article)
    {
        if (empty($title) || empty($summary) || empty($article)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkNewsIfExists($title)) {
            throw new ErrorException("News already exists");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO news (title, summary, article) VALUES (:title, :summary, :article) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['title' => $title, 'summary' => $summary, 'article' => $article]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function updateNews($newsid, $title, $summary, $article)
    {
        try {
            $result = $this->getNewsById($newsid);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE news SET title = :title, summary = :summary, article = :article) WHERE newsid = :newsid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['title' => $title, 'summary' => $summary, 'article' => $article, 'newsid' => $newsid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("News not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>