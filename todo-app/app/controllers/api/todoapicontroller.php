<?php

namespace Controllers\API;

/**
 * Required headers
 */
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: ' . URL_ROOT);
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: false');
header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Max-Age: 3600');

use App\Database;

use App\Middleware;
use Models\Todo;

class TodoController
{
    /**
     * READ all
     *
     * @return void
     */
    public function index()
    {
        $response = Todo::index();

        if (count($response) > 0) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'No result!']);
        }
    }

    /**
     * READ one
     *
     * @param string $slug
     * @return void
     */
    public function show($slug)
    {

    }

    /**
     * UPDATE
     *
     * @return void
     */
    public function update()
    {

    }

    /**
     * DELETE
     *
     * @param string $slug
     * @return void
     */
    public function delete($slug)
    {
        if (is_null(Middleware::init(__METHOD__))) {
            http_response_code(403);
            echo json_encode(["message" => "Authorization failed!"]);
            exit();
        }

        if (Todo::delete($slug)) {
            http_response_code(200);
            echo json_encode(['message' => 'Data deleted successfully!']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Failed during deleting data!']);
        }
    }
}
