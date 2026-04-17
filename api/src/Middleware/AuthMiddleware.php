<?php

namespace Api\Middleware;

class AuthMiddleware
{
    public function handle()
    {
        // بيتأكد إن فيه token
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) { // هل فيه Authorization header لو فيه يبقى فى توكن
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
}