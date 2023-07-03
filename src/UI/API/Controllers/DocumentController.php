<?php

declare(strict_types=1);

namespace AdminKit\Documents\UI\API\Controllers;

use AdminKit\Documents\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function show(int $id)
    {
        return Document::findOrFail($id);
    }
}
