<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UppgiftRepo;

class TodoApiController extends Controller {

    public function __construct(private UppgiftRepo $repo) {

    }
    public function all() {
        $lista = $this ->repo->all();
        return response()->json(data: ['todo' => $lista]);
    }
}