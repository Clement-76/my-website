<?php

namespace App\Model;

use App\Entity\Project;

class ProjectManager extends Manager {

    /**
     * return a collection of Project objects
     * @return Project[]
     * @throws \Exception
     */
    public function getProjects() {
        $db = $this->getDb();
        $q = $db->query(
            'SELECT id,
                     title,
                     description,
                     image_path AS imagePath,
                     link,
                     repo_link AS repoLink,
                     creation_date AS creationDate
            FROM my_website_projects
            ORDER BY creationDate'
        );

        $projects = $q->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Project');
        return $projects;
    }
}
