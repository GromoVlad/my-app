<?php

declare(strict_types=1);

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\CreateMessagesRequest;
use Illuminate\Support\Facades\Auth;

class CreateMessageController extends Controller
{
    public function create(CreateMessagesRequest $request)
    {
        dd($request->toVO(), Auth::user());
    }
}
