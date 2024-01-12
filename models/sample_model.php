<?php

require_once 'connection.php';

class SampleModel extends Connection
{

    private function checkModelIfExists($modelTable, $modelAttribute ,$modelValue)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM :modelTable WHERE :modelAttribute = :modelValue";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['modelTable' => $modelTable, 'modelAttribute' => $modelAttribute, 'modelValue' => $modelValue]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getModel($modelTable)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM :modelTable";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['modelTable' => $modelTable]);

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getModelNumber($modelTable)
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM :modelTable";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['modelTable' => $modelTable]);

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getModelById($modelTable, $modelIdAttribute ,$modelIdValue)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM :modelTable WHERE :modelIdAttribute = :modelIdValue";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['modelTable' => $modelTable, 'modelIdAttribute' => $modelIdAttribute, 'modelIdValue' => $modelIdValue]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteNews($modelTable, $modelIdAttribute ,$modelIdValue)
    {
        try {
            $result = $this->getModelById($modelTable, $modelIdAttribute ,$modelIdValue);

            if ($result) {
                $pdo = $this->connect();
                try {
                    $sql = "DELETE FROM :modelTable WHERE :modelIdAttribute = :modelIdValue";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['modelTable' => $modelTable, 'modelIdAttribute' => $modelIdAttribute, 'modelIdValue' => $modelIdValue]);
                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    
    // public function createModel($modelTable, $modelAttributes ,$modelValues)
    // {
    //     // if (empty($title) || empty($summary) || empty($article)) {
    //     //     throw new ErrorException("All fields are required");
    //     // }

    //     if ($this->checkModelIfExists($modelTable, $modelAttributes[0] ,$modelValues[0])) {
    //         throw new ErrorException("News already exists");
    //     }

    //     $pdo = $this->connect();

    //     try {
    //         $sql = "INSERT INTO news (title, summary, article) VALUES (:title, :summary, :article) ";
    //         $stmt = $pdo->prepare($sql);
    //         $stmt->execute(['title' => $title, 'summary' => $summary, 'article' => $article]);

    //         $this->disconnect($pdo);
    //     } catch (PDOException $e) {
    //         throw new ErrorException($e->getMessage());
    //     }
    // }

    // public function updateNews($newsid, $title, $summary, $article)
    // {
    //     try {
    //         $result = $this->getNewsById($newsid);

    //         if ($result) {
    //             $pdo = $this->connect();

    //             try {
    //                 $sql = "UPDATE news SET title = :title, summary = :summary, article = :article) WHERE newsid = :newsid";
    //                 $stmt = $pdo->prepare($sql);
    //                 $stmt->execute(['title' => $title, 'summary' => $summary, 'article' => $article, 'newsid' => $newsid]);

    //                 $this->disconnect($pdo);
    //             } catch (PDOException $e) {
    //                 throw new ErrorException($e->getMessage());
    //             }
    //         } else {
    //             throw new ErrorException("News not found");
    //         }
    //     } catch (PDOException $e) {
    //         throw new ErrorException($e->getMessage());
    //     }
    // }
}
?>