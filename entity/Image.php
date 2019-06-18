<?php

namespace App\Entity;

class Image extends Entity {

    protected $dimensions; // associative array with width and height
    protected $size;
    protected $extension;
    protected $name;

    public function resize() {

    }

    public function compress() {

    }

    public function generateName() {
        $generateName = '';

        // write the process

        $this->setName($generateName);
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getExtension(): string {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getDimensions(): array {
        return $this->dimensions;
    }
}
