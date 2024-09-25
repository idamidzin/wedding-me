<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Greeting;

class GreetingController extends Controller
{
    public function index()
    {
        $greetings = Greeting::orderBy('created_at', 'DESC')->get();
        return response()->json($greetings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Greeting::create($request->only('name', 'message'));

        return response()->json(['success' => 'Ucapan berhasil dikirim!']);
    }
}
