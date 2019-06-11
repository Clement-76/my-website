<?php

namespace App\Entity;

class Message extends Entity {

    protected $author = null;
    protected $email = null;
    protected $object = null;
    protected $content = null;
    protected $isValid = true;

    /**
     * @return string
     */
    public function getAuthor(): string {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author) {
        if (is_string($author)) {
            $this->author = $author;
        } else {
            $this->setIsValid(false);
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        if (is_string($email)) {
            $this->email = $email;
        } else {
            $this->setIsValid(false);
        }
    }

    /**
     * @return string
     */
    public function getObject(): string {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject($object) {
        if (is_string($object)) {
            $this->object = $object;
        } else {
            $this->setIsValid(false);
        }
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        if (is_string($content)) {
            $this->content = $content;
        } else {
            $this->setIsValid(false);
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool {

        if (is_null($this->author) || is_null($this->email) || is_null($this->object) || is_null($this->content)) {
            $this->setIsValid(false);
        }

        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid(bool $isValid) {
        $this->isValid = $isValid;
    }
}
