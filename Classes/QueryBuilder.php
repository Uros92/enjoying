<?php

class QueryBuilder
{
    private $db;

    /**
     * QueryBuilder constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * get user
     *
     * @return object
     */
    public function selectUser($id): object
    {
        $sql = "SELECT * FROM users WHERE id = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        // If user not exist, send 400 response
        if(!$user) {
            http_response_code(400);
            die('User not found');
        }

        return $user;
    }

    /**
     * update user
     *
     * @return string
     */
    public function updateUser($name, $year, $userId): string
    {
        $sql = "UPDATE users SET name = :name, year_of_birth = :year, updated = :updated WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->execute([':name' => $name, ':year' => $year, ':id' => $userId, ':updated' => $updated]);

        // Check if user is not updated and send 400 response
        if($query->rowCount() !== 1) {
            http_response_code(404);
            die('User not updated');
        }

        return 'User has been updated!';
    }

    /**
     * create user
     *
     * @return object
     */
    public function createUser($name, $year): object
    {
        $created = date('Y-m-d');

        $sql = "INSERT INTO users (name, year_of_birth, created) VALUES (:name,:year,:created)";

        $query = $this->db->prepare($sql);

        $query->execute([':name' => $name, ':year' => $year, ':created' => $created]);

        $user_id =  $this->db->lastInsertId();

        http_response_code(201);
        return $this->selectUser($user_id);
    }

}