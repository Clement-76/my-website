<?php

namespace App\Entity;

class Project extends Entity implements \JsonSerializable {

    protected $id;
    protected $title;
    protected $description;
    protected $imagePath;
    protected $link;
    protected $repoLink;
    protected $creationDate;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'imagePath' => $this->imagePath,
            'link' => $this->link,
            'repoLink' => $this->repoLink,
            'creationDate' => $this->creationDate,
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImagePath(): string {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath) {
        $this->imagePath = $imagePath;
    }

    /**
     * @return mixed string or null
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link) {
        $this->link = $link;
    }

    /**
     * @return mixed string or null
     */
    public function getRepoLink() {
        return $this->repoLink;
    }

    /**
     * @param mixed $repoLink
     */
    public function setRepoLink($repoLink) {
        $this->repoLink = $repoLink;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate) {
        $this->creationDate = new \DateTime($creationDate);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }
}
