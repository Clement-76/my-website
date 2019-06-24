<?php

namespace App\Entity;

class Image extends Entity {

    protected $dimensions = null; // associative array with width and height
    protected $size;
    protected $extension;
    protected $tmpName;
    protected $uploadedName;
    protected $allowedExtensions = ['PNG', 'JPG', 'JPEG'];

    /**
     * Image constructor.
     * @param $fileImage the $_FILES['name']
     */
    public function __construct($fileImage) {
        $this->setTmpName($fileImage['tmp_name']);
        $this->setExtension($fileImage['name']);
        $this->setSize($fileImage['size']);
    }

    /**
     * @return bool true if it's a success false if it's not
     */
    public function upload() {
        // path to the new image
        $imagePath = PROJECTS_PATH . '/' . $this->generateName();

        if (!file_exists($imagePath)) {
            move_uploaded_file($this->tmpName, $imagePath);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function generateName() {
        $generateName = str_shuffle(time()) . '.' . $this->extension;

        $this->setUploadedName($generateName);
        return $generateName;
    }

    public function resize() {

    }

    public function compress() {

    }

    public function isValid() {
        // check the extension
        // check the size
        // check if the file isn't empty

    }

    /**
     * @return string
     */
    public function getExtension(): string {
        return $this->extension;
    }

    /**
     * @param $fileName
     * @return Image
     */
    public function setExtension($fileName) {
        $this->extension = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpName(): string {
        return $this->tmpName;
    }

    /**
     * @param $tmpName
     * @return Image
     */
    public function setTmpName($tmpName): self {
        $this->tmpName = $tmpName;
        return $this;
    }

    /**
     * @return array
     */
    public function getDimensions(): array {
        if (is_null($this->dimensions)) $this->setDimensions();
        return $this->dimensions;
    }

    public function setDimensions() {
        $this->dimensions = getimagesize($this->tmpName);
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Image
     */
    public function setSize(int $size) {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string
     */
    public function getUploadedName(): string {
        return $this->uploadedName;
    }

    /**
     * @param mixed $uploadedName
     * @return Image
     */
    public function setUploadedName(string $uploadedName): self {
        $this->uploadedName = $uploadedName;
        return $this;
    }
}
