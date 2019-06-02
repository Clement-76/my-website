<?php

namespace App\Model;

class UserManager extends Manager {
    /**
     * get the user in the db with his email or password
     * @param string $pseudo
     * @return object a User object
     * @throws \Exception
     */
    public function getUser($pseudo) {
        $db = $this->getDb();

        $q = $db->prepare(
            'SELECT id,
                     pseudo,
                     email,
                     role,
                     password,
                     registration_date AS registrationDate
             FROM my_website_users 
             WHERE pseudo = :pseudo'
        );

        $q->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\User');
        $user = $q->fetch();

        return $user;
    }
}
