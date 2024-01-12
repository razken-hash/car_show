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
            $sql = "SELECT * FROM cars";
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
        try {
            $result = $this->getCarById($carid);

            if ($result) {
                $pdo = $this->connect();
                try {
                    $sql = "DELETE FROM cars WHERE carid = :carid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['carid' => $carid]);
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

    public function createCar($carname, $cardescription, $carversion, $caryear, $modelid)
    {
        if (empty($carname) || empty($cardescription) || empty($carversion) || empty($caryear) || empty($modelid)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkIfCarExists($carname)) {
            throw new ErrorException("Car already exists");
        }

        $pdo = $this->connect();

        try {
            $sql = "INSERT INTO cars (carname, cardescription, carversion, caryear, modelid) VALUES (:carname, :cardescription, :carversion, :caryear, :modelid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['carname' => $carname, 'cardescription' => $cardescription, 'carversion' => $carversion, 'caryear' => $caryear, 'modelid' => $modelid]);

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

    public function getCarsFeatures($carid) {
        $pdo = $this->connect();
        try {
            $sql = "SELECT * FROM (cars 
                     JOIN carsfeatures ON cars.carid = carsfeatures.carid )
                    WHERE cars.carid = :carid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['carid' => $carid]);

            $result = $stmt->fetchAll();
            
            $this->disconnect($pdo);
            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>