<?php

namespace App\Controller;

use App\Model\ProjectManager;

class ProjectsController {

    /**
     * echo the projects in JSON
     * @throws \Exception
     */
    public function getJSONProjects() {
        $projectManager = new ProjectManager();
        $projects = $projectManager->getProjects();
        echo json_encode($projects);
    }
}
