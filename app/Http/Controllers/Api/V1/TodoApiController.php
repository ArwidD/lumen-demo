<?php 

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Http\Request;
use App\Models\Uppgift;

class TodoApiController extends Controller {
    
    public function __construct(private UppgiftRepo $repo) {
        
    }

    public function all() {
        $lista = $this->repo->all();
        return response()->json(['todo' => $lista]);
    }

    public function get(Request $request) {
        $item = $this->repo->get($request->route('id'));
        return response()->json(['todo'=>$item]);
    }

    public function add(Request $request) {

        $text = $request->input('uppgift');
        $uppgift = Uppgift::factory()->make(['text'=> $text, 'done' => false]);
        
        $this->repo->add($uppgift);
        return response()->json(['todo' => $uppgift], 201);
    }
    
    public function update(Request $request) {
        $id = filter_var($request->route('id'), FILTER_VALIDATE_INT);
        $uppgift = $this->repo->get($id);
        $uppgift->text = $request->input('uppgift');
        $uppgift->done = $request->input('done', $uppgift->done);
        
        $this->repo->update($uppgift);
        
        return response()->json(['todo' => $uppgift]);
    }
    
    public function remove(Request $request) {
        $text = $request->input('uppgift');
        $this->repo->delete($id);
        return response()->json(['todo'=>$text]);
        }
}