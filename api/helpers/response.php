<?php
class Response{
    public static function json($code, $message, $data = null) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);

        echo json_encode([
            'status' => ($code >= 200 && $code < 300),
            'code' => $code,
            'message' => $message,
            'data' => $data
        ],JSON_UNESCAPED_UNICODE);
        exit;
    }
}