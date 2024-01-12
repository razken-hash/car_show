<?php

require_once 'connection.php';

class FeaturesModel extends Connection
{

    private function checkFeatureIfExists($featurename)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM features WHERE featurename = :featurename";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['featurename' => $featurename]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getFeatures()
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM features";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getFeaturessNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM features";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getFeatureById($featureid)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM features WHERE featureid = :featureid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['featureid' => $featureid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function getFeatureByName($featurename)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM features WHERE featurename = :featurename";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['featurename' => $featurename]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteFeature($featureid)
    {
        try {
            $result = $this->getFeatureById($featureid);
            if ($result) {
                $pdo = $this->connect();
                try {
                    $sql = "DELETE FROM features WHERE featureid = :featureid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['featureid' => $featureid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Feature not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    
    public function createFeature($featurename, $featureunit)
    {
        if (empty($featurename) || empty($featureunit)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkFeatureIfExists($featurename)) {
            throw new ErrorException("Feature already exists");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO features (featurename, featureunit) VALUES (:featurename, :featureunit) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['featurename' => $featurename, 'featureunit' => $featureunit]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function updateFeature($featureid, $featurename, $featureunit)
    {
        try {
            $result = $this->getFeatureById($featureid);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE features SET featurename = :featurename, featureunit = :featureunit) WHERE featureid = :featureid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['featurename' => $featurename, 'featureunit' => $featureunit, 'featureid' => $featureid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Feature not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>