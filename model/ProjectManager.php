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
                     image_name AS imageName,
                     link,
                     repo_link AS repoLink,
                     creation_date AS creationDate
            FROM my_website_projects
            ORDER BY creationDate'
        );

        $projects = $q->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Project');
        return $projects;
    }

    /**
     * return the project in the database or false if he doesn't exist
     * @param $id
     * @return bool|Project
     * @throws \Exception
     */
    public function getProject($id) {
        $db = $this->getDb();
        $q = $db->prepare(
            'SELECT id,
                     title,
                     description,
                     image_name AS imageName,
                     link,
                     repo_link AS repoLink,
                     creation_date AS creationDate
            FROM my_website_projects
            WHERE id = :id
            ORDER BY creationDate'
        );

        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Project');
        $projects = $q->fetch();

        if ($projects == false) {
            return false;
        } else {
            return $projects;
        }
    }

    /**
     * return if the project exists or not
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function projectExists($id) {
        $db = $this->getDb();
        $q = $db->prepare(
            'SELECT * FROM my_website_projects 
             WHERE id = :id'
        );

        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
        $nbLines = $q->rowCount();

        if ($nbLines > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete a project in the database
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function deleteProject($id) {
        $db = $this->getDb();
        $q = $db->prepare(
            'DELETE FROM my_website_projects 
             WHERE id = :id'
        );

        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $success = $q->execute();
        return $success;
    }

    /**
     * update a project in the database
     * @param Project $project
     * @return bool
     * @throws \Exception
     */
    public function updateProject(Project $project) {
        $db = $this->getDb();
        $q = $db->prepare(
            'UPDATE my_website_projects
             SET title = :title,
             description = :description,
             image_name = :imageName,
             link = :link,
             repo_link = :repoLink,
             creation_date = :creationDate
             WHERE id = :id'
        );

        $q->bindValue(':id', $project->getId(), \PDO::PARAM_INT);
        $q->bindValue(':title', $project->getTitle(), \PDO::PARAM_STR);
        $q->bindValue(':description', $project->getDescription(), \PDO::PARAM_STR);
        $q->bindValue(':imageName', $project->getImageName(), \PDO::PARAM_STR);
        $q->bindValue(':link', $project->getLink(), \PDO::PARAM_STR);
        $q->bindValue(':repoLink', $project->getRepoLink(), \PDO::PARAM_STR);
        $q->bindValue(':creationDate', $project->getCreationDate(), \PDO::PARAM_STR);

        $success = $q->execute();
        return $success;
    }

    /**
     * @param Project $project
     * @return bool
     * @throws \Exception
     */
    public function createProject(Project $project) {
        $db = $this->getDb();
        $q = $db->prepare(
            'INSERT INTO my_website_projects(title, description, image_name, link, repo_link, creation_date)
             VALUES(:title, :description, :imageName, :link, :repoLink, :creationDate)'
        );

        $q->bindValue(':title', $project->getTitle(), \PDO::PARAM_STR);
        $q->bindValue(':description', $project->getDescription(), \PDO::PARAM_STR);
        $q->bindValue(':imageName', $project->getImageName(), \PDO::PARAM_STR);
        $q->bindValue(':link', $project->getLink(), \PDO::PARAM_STR);
        $q->bindValue(':repoLink', $project->getRepoLink(), \PDO::PARAM_STR);
        $q->bindValue(':creationDate', $project->getCreationDate(), \PDO::PARAM_STR);

        $success = $q->execute();
        return $success;
    }
}
