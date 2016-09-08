<?php

/**
 * Class UserRepository
 *
 * @author Sypam <sypam@smile.fr>
 */
class UserRepository
{

    /**
     * Find a user by id and send back its data
     * @param int $id identifier of the user
     * @return array user data
     */
    public function findOneById($id)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT id, username, email, firstname, lastname 
                FROM users WHERE id = :id AND enabled=1 LIMIT 1'
        );

        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;;
    }

    /**
     * Find a user by username and send back its data
     * @param int $username of the user
     * @return array user data
     */
    public function findOneByUsername($username)
    {
        $queryDriver = DBQuery::getInstance()->getDSN();

        $stmt = $queryDriver->prepare(
            'SELECT id, username, email, firstname, lastname 
                FROM users WHERE username = :username AND enabled=1 LIMIT 1'
        );

        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;;
    }
}



