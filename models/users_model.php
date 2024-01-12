<?php

require_once 'connection.php';

class UserModel extends Connection
{

    private function checkUserExists($email)
    {
        $pdo = $this->connect();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $result = $stmt->fetch();

        $this->disconnect($pdo);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function signup($firstname, $lastname, $sex, $birthdate, $email, $pswd)
    {
        if (empty($firstname) || empty($lastname) || empty($birthdate) || empty($email) || empty($pswd)) {
            throw new ErrorException("All fields are required");
        }

        if ($this->checkUserExists($email)) {
            throw new ErrorException("Email already exists");
        }

        $pdo = $this->connect();

        try {

            $sql = "INSERT INTO users (firstname, lastname, sex, birthdate, status, email, pswd) VALUES(:firstName, :lastName, :sex, :birthdate, :status :email, :pswd)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['firstname' => $firstname, 'lastName' => $lastname, 'sex' => $sex, 'birthdate' => $birthdate, 'status' => "pending", 'email' => $email, 'pswd' => $pswd]);

            $this->disconnect($pdo);
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function login($email, $pswd)
    {
        if (empty($email) || empty($pswd)) {
            throw new ErrorException("All fields are required");
        }

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                if ($pswd === $result['pswd']) {
                    $status = $result['status'];
                    if ($status === 'pending') {
                        throw new ErrorException("Your account is not activated yet");
                    }
                    if ($status === 'blocked') {
                        throw new ErrorException("Your account is blocked");
                    }
                    return $result;
                }
                throw new ErrorException("Invalid password");

            } else {
                throw new ErrorException("Invalid email");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUsers()
    {

        $pdo = $this->connect();

        try {
            // dont get admin
            $sql = "SELECT * FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUsersNumber()
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT COUNT(*) FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function getUserById($userid)
    {

        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM users WHERE userid = :userid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            return $result;
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function activateUser($userid)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM users WHERE userid = :userid AND status = 'blocked' OR status = 'pending'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE users SET status = 'active'  WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['userid' => $userid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already accepted");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function blockUser($userid)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT * FROM users WHERE userid = :userid AND status = 'active'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['userid' => $userid]);

            $result = $stmt->fetch();

            $this->disconnect($pdo);

            if ($result) {
                $pdo = $this->connect();

                try {
                    $sql = "UPDATE users SET status = 'blocked' WHERE userid = :userid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['userid' => $userid]);

                    $this->disconnect($pdo);
                } catch (PDOException $e) {
                    throw new ErrorException($e->getMessage());
                }
            } else {
                throw new ErrorException("User not found or already blocked");
            }
        } catch (PDOException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>