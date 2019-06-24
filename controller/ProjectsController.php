<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Project;
use App\Model\ProjectManager;
use App\Services\JSON;
use Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProjectsController extends AppController {

    /**
     * echo the projects in JSON
     * @throws Exception
     */
    public function getJSONProjects() {
        $projectManager = new ProjectManager();
        $projects = $projectManager->getProjects();
        echo json_encode($projects);
    }

    public function displayAdminProjects() {

        if (!$this->isAdmin()) {
            $this->redirect404();
        }

        $projectManager = new ProjectManager();
        $projects = $projectManager->getProjects();
        echo $this->twig->render('admin/projects.twig', ['projects' => $projects]);
    }

    /**
     * @param $id
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function editProject($id) {

        if (!$this->isAdmin()) {
            $this->redirect404();
        }

        $projectManager = new ProjectManager();
        $project = $projectManager->getProject($id);

        if (!$projectManager->projectExists($id)) {
            $this->redirect404();
        }

        $errors = [];

        if (isset($_POST['title'], $_POST['repoLink'], $_POST['link'], $_POST['creationDate'], $_POST['description'])) {

            // check the values
            // create the image
            // make the edit of the image optional (just the edit)
            // -> if no image has been sent, don't change the value in the db

            $newProjectData = [
                'title' => $_POST['title'],
                'repoLink' => empty($_POST['repoLink']) ? null : $_POST['repoLink'],
                'link' => empty($_POST['link']) ? null : $_POST['link'],
                'creationDate' => $_POST['creationDate'],
                'description' => $_POST['description'],
            ];

            if (isset($_FILES['image'])) {
                // add a check of the values, if there are errors add it into $error
                // use $image->isValid()

                $image = new Image($_FILES['image']);
                $uploadSuccess = $image->upload();

                if ($uploadSuccess) {
                    $newProjectData['imageName'] = $image->getUploadedName();
                } else {
                    $errors['upload'] = true;
                }
            }

            // test here if a new image was send
            // and push the imagePath in the data array if she was send

            $project->hydrate($newProjectData);
            $success = $projectManager->updateProject($project);

            if (!$success) $errors['mysql'] = true;
            if (empty($errors)) header('Location: ' . BASEURL . '/admin/projects');
        }

        echo $this->twig->render('admin/edit-project.twig', [
            'project' => $project,
            'errors' => $errors
        ]);
    }

    /**
     * display the project form and if it was submit, check the values
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addProject() {

        if (!$this->isAdmin()) {
            $this->redirect404();
        }

        $errors = [];
        $project = null;

        if (isset($_POST['title'], $_POST['repoLink'], $_POST['link'], $_POST['creationDate'], $_POST['description'])) {

            $projectData = [
                'title' => $_POST['title'],
                'repoLink' => empty($_POST['repoLink']) ? null : $_POST['repoLink'],
                'link' => empty($_POST['link']) ? null : $_POST['link'],
                'creationDate' => $_POST['creationDate'],
                'description' => $_POST['description'],
            ];

            if (isset($_FILES['image'])) {
                // add a check of the values, if there are errors add it into $error
                // use $image->isValid()

                $image = new Image($_FILES['image']);
                $uploadSuccess = $image->upload();

                if ($uploadSuccess) {
                    $projectData['imageName'] = $image->getUploadedName();
                } else {
                    $errors['upload'] = true;
                }
            }

            $project = new Project($projectData);
            $projectManager = new ProjectManager();
            $success = $projectManager->createProject($project);

            if (!$success) $errors['mysql'] = true;
            if (empty($errors)) header('Location: ' . BASEURL . '/admin/projects');
        }

        echo $this->twig->render('admin/add-project.twig', [
            'project' => $project,
            'errors' => $errors // if there is an error we don't need to write again values
        ]);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function deleteProject($id) {

        if (!$this->isAdmin()) {
            $this->redirect404();
        }

        $projectManager = new ProjectManager();

        if (!$projectManager->projectExists($id)) {
            echo JSON::JSONResponse('error', 'Ce projet n\'existe pas');
            exit();
        }

        $success = $projectManager->deleteProject($id);

        if ($success) {
            echo JSON::JSONResponse('success');
        } else {
            echo JSON::JSONResponse('error', 'Une erreur inconnue est survenue');
        }
    }
}
