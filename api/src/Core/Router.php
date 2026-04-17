<?php

namespace Api\Core;

class Router
{
    // دي array هنخزن فيها كل الـ routes
    private array $routes = [];
    // إضافة route ... لو حصل request معين -->
    /**
     * تسجيل Route جديدة داخل الـ Router.
     * تقوم بحفظ نوع الطلب (HTTP Method) والمسار (URI)
     * مع الـ action الخاص بالـ Controller لاستخدامهم لاحقًا عند استقبال الطلب.
     */
    public function addRoute(string $method, string $uri, string $action)
    {
        // store route
        $this->routes[] = [
            'method' => $method, // 'GET'
            'uri' => $uri, // '/api/products'
            'action' => $action,
            /**
         ** وشغّل الفنكشن index" -- روح للكلاس ProductController -- "لما الـ route ده يشتغل →
         *'controller' => ProductController::class,
         *'method' => 'index'
         *'middleware' => [AuthMiddleware::class]
         */
            // لو حد طلب /api/products → شغل ProductController@index
        ];
    }

    // هي اللي "تشغل" الـ routing -- ال function دى
    // check if there is route matches
    public function dispatch(string $requestMethod, string $requestUri)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {

                // Middleware
                // Middleware => كود بيتنفذ قبل ما توصل للـ Controller
                // بيشوف لو ال روت دة عليه حمايه ولا لأ
                if (isset($route['action']['middleware'])) {
                    $this->handleMiddleware($route['action']['middleware']);
                }

                // Controller
                // Dynamic Class Instantiation
                // تقدر تعمل object --> باستخدام اسم الكلاس وهو string
                $controller = $route['action']['controller'];
                $method = $route['action']['method'];

                $controllerInstance = new $controller();

                return call_user_func([$controllerInstance, $method]);
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Route Not Found']);
    }
    private function handleMiddleware(array $middlewares)
    {
        // لووب عشان لما يكون عنددنا اكتر من middelware
        foreach ($middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            $middlewareInstance->handle();
        }
    }
}
/**
 * مثال على اكتر من ميدلويير :
 * AuthMiddleware (لازم يكون logged in)
 * AdminMiddleware (لازم يكون admin)
 */