<?php

require_once 'connection.php';

class MarksModel extends Connection
{

    private function checkMarkIfExists($markname)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM marks WHERE markname = :markname";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['markname' => $markname]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getMarks()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM marks";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getMarksNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM marks";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getMarkById($markid)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM marks WHERE markid = :markid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['markid' => $markid]);

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function getMarkByName($markname)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM marks WHERE markname = :markname";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['markname' => $markname]);

            $result = $stmt->fetch();
            $this->disconnect($pdo);
            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteMark($markid)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM marks WHERE markid = :markid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['markid' => $markid]);
            $result = $stmt->fetch();
            echo $result[0];
            echo "red";
            if ($result) {
                echo "ENETEr";
                // $pdo = $this->connect();

                try {
                    $sql = "DELETE FROM marks WHERE markid = :markid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['markid' => $markid]);
                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                echo "error";
                throw new ErrorException("Mark not found or already blocked");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    
    public function createMark($markname, $country, $headoffice, $foundyear, $logo)
    {
        if (empty($markname) || empty($country) || empty($headoffice) || empty($foundyear) || empty($logo)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkMarkIfExists($markname)) {
            throw new ErrorException("Mark already exists");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO marks (markname, country, headoffice, foundyear, logo) VALUES (:markname, :country, :headoffice, :foundyear, :logo) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['markname' => $markname, 'country' => $country, 'headoffice' => $headoffice, 'foundyear' => $foundyear, 'logo' => $logo]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function updateMark($markid, $markname, $country, $headoffice, $foundyear, $logo)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM marks WHERE markid = :markid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['markid' => $markid]);
            $result = $stmt->fetch();
            if ($result) {
                try {
                    $sql = "UPDATE marks SET markname = :markname, country = :country, headoffice = :headoffice, foundyear = :foundyear, logo = :logo WHERE markid = :markid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['markname' => $markname, 'country' => $country, 'headoffice' => $headoffice, 'foundyear' => $foundyear, 'logo' => $logo, 'markid' => $markid]);
                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                echo "error";
                throw new ErrorException("Mark not found");
            }
        } catch (PDOException $e) {
                echo "error33";

            throw new ErrorException($e->getMessage());
        }
    }
}
?>