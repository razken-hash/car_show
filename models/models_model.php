<?php

require_once 'connection.php';

class ModelModel extends Connection
{

    private function checkModelIfExists($modelname)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM models WHERE modelname = :modelname";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['modelname' => $modelname]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getModels()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM models";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getModelsNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM models";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getModelById($modelid)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM models WHERE modelid = :modelid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['modelid' => $modelid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteModel($modelid)
    {
        try {
            $result = $this->getModelById($modelid);

            if ($result) {
                $pdo = $this->connect();
                try {
                    $sql = "DELETE FROM models WHERE modelid = :modelid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['modelid' => $modelid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Model not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    
    public function createModel($modelname, $foundyear, $markid)
    {
        if (empty($modelname) || empty($foundyear) || empty($markid)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkModelIfExists($modelname)) {
            throw new ErrorException("Model already exists");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO models (modelname, foundyear, markid) VALUES (:modelname, :foundyear, :markid) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['modelname' => $modelname, 'foundyear' => $foundyear, 'markid' => $markid]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function updateModel($modelid, $modelname, $foundyear, $markid)
    {
        try {
            $result = $this->getModelById($markid);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE models SET modelname = :modelname, foundyear = :foundyear, markid = :markid) WHERE modelid = :modelid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['modelname' => $modelname, 'foundyear' => $foundyear, 'markid' => $markid, 'modelid' => $modelid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Model not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>