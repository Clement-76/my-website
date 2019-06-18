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

        $errors = [];

        if (isset($_POST['title'], $_POST['repoLink'], $_POST['link'], $_POST['creationDate'], $_POST['description'])) {

            // check the values
            // create the image
            // make the edit of the image optional (just the edit)
            // -> if no image has been sent, don't change the value in the db

            $newProjectData = [
                'title' => $_POST['title'],
                'repoLink' => $_POST['repoLink'],
                'link' => $_POST['link'],
                'creationDate' => $_POST['creationDate'],
                'description' => $_POST['description'],
            ];

            // test here if a new image was send
            // and push the imagePath in the data array if she was send

            $project->hydrate($newProjectData);
            $success = $projectManager->updateProject($project);

            if (!$success) $errors[] = 'mysql';
            if (empty($errors)) header('Location: ' . BASEURL . '/admin/projects');
        }

        echo $this->twig->render('admin/editProject.twig', [
            'project' => $project,
            'errors' => $errors
        ]);
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
