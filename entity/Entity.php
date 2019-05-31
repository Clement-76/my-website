<?php

namespace App\Entity;

class Entity {

    public function __construct(array $array =[]) {
        $this->hydrate($array);
    }

    public function hydrate($array) {
        foreach ($array as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }
}
