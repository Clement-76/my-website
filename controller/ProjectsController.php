<?php

namespace App\Controller;

use App\Model\ProjectManager;
use App\Services\JSON;

class ProjectsController extends AppController {

    /**
     * echo the projects in JSON
     * @throws \Exception
     */
    public function getJSONProjects() {
        $projectManager = new ProjectManager();
        $projects = $projectManager->getProjects();
        echo json_encode($projects);
    }

    public function displayAdminProjects() {
        $projectManager = new ProjectManager();
        $projects = $projectManager->getProjects();
        echo $this->twig->render('admin/projects.twig', ['projects' => $projects]);
    }

    /**
     * @param $id
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function editProject($id) {
        $projectManager = new ProjectManager();
        $project = $projectManager->getProject($id);

        if (!$projectManager->projectExists($id)) {
            header('HTTP/1.0 404 Not Found');
            exit();
        }

        if (isset($_POST['title'])) {

            // check the values
            // create the image

            $newProjectData = [];
            $project->hydrate($newProjectData);
            $projectManager->updateProject($project);
        }

        echo $this->twig->render('admin/editProject.twig', ['project' => $project]);
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteProject($id) {
        $projectManager = new ProjectManager();

        if (!$projectManager->projectExists($id)) {
            echo JSON::JSONResponse('error', 'Ce projet n\'existe pas');
        }

        $error = $projectManager->deleteProject($id);

        if (!$error) echo JSON::JSONResponse('success');
    }
}
