<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class DocumentController extends Controller
{
    public function create_document()
    {
        Storage::Cloud()->put('test.txt','Test create');
        dd('Created');
    }
}
