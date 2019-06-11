<?php

namespace App\Services;

class JSON {

    /**
     * @param $status
     * @param null $message
     * @param array $params associative array with keys => value pairs to add in the data
     * @return string
     */
    public static function JSONResponse($status, $message = null, array $params = null) {
        $data = ['status' => $status];

        if (!is_null($message)) $data['message'] = $message;
        if (!is_null($params)) $data = array_merge($data, $params);

        return json_encode($data);
    }
}
