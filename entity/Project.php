<?php

namespace App\Entity;

class Project extends Entity implements \JsonSerializable {

    protected $id;
    protected $title;
    protected $description;
    protected $imageName = null;
    protected $link = null;
    protected $repoLink = null;
    protected $creationDate;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'imageName' => $this->imageName,
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
     * @return string|null
     */
    public function getImageName() {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName(string $imageName) {
        $this->imageName = $imageName;
    }

    /**
     * @return string|null
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
     * @return string|null
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
     * @return string
     */
    public function getCreationDate(): string {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate) {
        $this->creationDate = $creationDate;
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
