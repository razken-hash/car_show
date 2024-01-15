<?php

require_once 'connection.php';

class CarsModel extends Connection
{

    private function checkIfCarExists($carname)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM cars WHERE carname = :carname";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['carname' => $carname]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getCars()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM cars ORDER BY carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getCarByData($markId, $model, $version, $year)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM cars WHERE carname = :carname AND markid = :markid AND carversion = :carversion AND caryear = :caryear";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['carname' => $model, 'markid' => $markId, 'carversion' => $version, 'caryear' => $year]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);
            $stmt->execute();

            $result = $stmt->fetchAll();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getCarsNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM cars";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getCarById($carid)
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM cars WHERE carid = :carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['carid' => $carid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function deleteCar($carid)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM cars WHERE carid = :carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['carid' => $carid]);
            $result = $stmt->fetch();
            if ($result) {
                try {
                    $sql = "DELETE FROM cars WHERE carid = :carid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['carid' => $carid]);
                    echo "done";
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

    public function createCar($carname, $cardescription, $carversion, $caryear, $markid)
    {
        // if (empty($carname) || empty($cardescription) || empty($carversion) || empty($caryear) || empty($markid)) {
        //     throw new ErrorException("All fields are required");
        // }

        // if ($this->checkIfCarExists($carname)) {
        //     throw new ErrorException("Car already exists");
        // }

        $pdo = $this->connect();

        try {
            echo "CAr";
            $sql = "INSERT INTO cars (carname, cardescription, carversion, caryear, markid) VALUES (:carname, :cardescription, :carversion, :caryear, :markid)";
            echo "CAr";
            $stmt = $pdo->prepare($sql);
            echo "CAr";
            $stmt->execute(['carname' => $carname, 'cardescription' => $cardescription, 'carversion' => $carversion, 'caryear' => $caryear, 'markid' => $markid]);
            echo "Done";

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function createCarFeature($carid, $featureid, $featurevalue) {
        // if (empty($carid) || empty($featureid) || empty($featurevalue)) {
        //     throw new ErrorException("All fields are required");
        // }

        echo "Begin";

        $pdo = $this->connect();

        try {
            echo "Fin";

            $sql = "INSERT INTO carsfeatures (carid, featureid, featureval) VALUES (:carid, :featureid, :featureval)";
            $stmt = $pdo->prepare($sql);
            echo "Fin";
            $stmt->execute(['carid' => $carid, 'featureid' => $featureid, 'featureval' => $featurevalue]);
            echo "Fin";
            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function updateCar($carid, $carname, $cardescription, $carversion, $caryear, $modelid)
    {
        try {
            $result = $this->getCarById($carid);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE cars SET carname = :carname, cardescription = :cardescription, carversion = :carversion, caryear = :caryear, modelid = :modelid) WHERE carid = :carid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['carname' => $carname, 'cardescription' => $cardescription, 'carversion' => $carversion, 'caryear' => $caryear, 'modelid' => $modelid, 'carid' => $carid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("Car not found");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getCarsWithFeatures($carid) {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM (cars 
                     JOIN carsfeatures ON cars.carid = carsfeatures.carid )
                    WHERE cars.carid = :carid ORDER BY cars.carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['carid' => $carid]);

            $result = $stmt->fetchAll();
            
            $this->disconnect($pdo);
            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getCarsWithMarks() {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM (cars 
                     JOIN marks ON cars.markid = marks.markid) ORDER BY cars.carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            $this->disconnect($pdo);
            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>