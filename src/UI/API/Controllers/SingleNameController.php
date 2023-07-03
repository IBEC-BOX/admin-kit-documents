<?php

declare(strict_types=1);

namespace VendorName\Skeleton\UI\API\Controllers;

use VendorName\Skeleton\Models\SingleName;

class SingleNameController extends Controller
{
    public function index()
    {
        return SingleName::all();
    }

    public function show(int $id)
    {
        return SingleName::findOrFail($id);
    }
}
