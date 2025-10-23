<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Http\Request;

class TodoAPiController extends Controller {
    public function __construct(private UppgiftRepo $repo) {}

    public function all() {
        $lista = $this->repo->all();
        return response()->json(['todo' => $lista]);
    }

    public function get(Request $request) {
        $item = $this->repo->get($request->route('id'));
        return response()->json(['todo' => $item]);
    }

    public function add(Request $request) {
        $text = $request->input('uppgift');
        $uppgift = Uppgift::factory()->make(['text' => $text, 'done' => false]);

        $this->repo->add($uppgift);
        return response()->json(['todo' => $uppgift], 201);
    }

    public function update(Request $request) {
        // Kontrollera indata
        $id = filter_var($request->route('id'), FILTER_VALIDATE_INT);

        // Hämta tidigare post
        $uppgift = $this->repo->get($id);
        // Uppdatera med nya data
        $uppgift->text = $request->input('uppgift');
        $uppgift->done = $request->input('done', $uppgift->done);

        // Spara post
        $this->repo->update($uppgift);

        // Returnera
        return response()->json(['todo' => $uppgift]);
    }

    public function check(Request $request) {
        // Kontrollera indata
        $id = filter_var($request->route('id'), FILTER_VALIDATE_INT);

        // Hämta tidigare post
        $uppgift = $this->repo->get($id);
        // Kryssa i/av
        $uppgift->done = !$uppgift->done;

        // Spara post
        $this->repo->update($uppgift);

        // Returnera
        return response()->json(['todo' => $uppgift]);
    }

    public function remove(Request $request) {
        // Kontrollera indata
        $id = filter_var($request->input('id'), FILTER_VALIDATE_INT);

        // Radera post
        $this->repo->delete($id);

        return response()->json(null, 204);
    }
}