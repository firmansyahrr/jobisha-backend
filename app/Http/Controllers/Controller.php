<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $service;

    public function getDatatables()
    {
        return $this->service->getDatatables();
    }

    public function deleteWeb($id)
    {
        $process = $this->service->delete($id);
        return redirect()->back()->with('message', 'Data deleted successfully');
    }

}
