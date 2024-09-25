<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gift;

class GiftController extends Controller
{
    public function index(Request $request)
    {
        $for = $request->has('for') ? $request->for : null;
        $gifts = Gift::get();
        
        if ($for) {
            $gifts = Gift::where('for', $for)->get();
        }
        
        return view('management.gift.index', compact('gifts', 'for'));
    }

    public function create(Request $request)
    {
        $for = $request->has('for') ? $request->for : null;
        return view('management.gift.create', compact('for'));
    }

    public function store(Request $request)
    {
        $amount = preg_replace('/[Rp.]/', '', $request->amount);

        $gift = Gift::create([
            'name' => $request->name,
            'amount' => $amount,
            'address' => $request->address,
            'for' => $request->for,
        ]);

        if ($gift) {
            return redirect()
                ->route('mgt.gift.index')
                ->with('msg',['type'=>'success','text'=> 'Hadiah Berhasil disimpan']);
        }
    }

    public function edit(Request $request, $id)
    {
        $gift = Gift::findOrFail($id);
        $for = $request->has('for') ? $request->for : null;

        return view('management.gift.edit', compact('gift', 'for'));
    }

    public function update(Request $request, $id)
    {
        $gift = Gift::findOrFail($id);
        $amount = preg_replace('/[Rp.]/', '', $request->amount);

        if ($gift)
        {
            $gift->name = $request->name;
            $gift->amount = $amount;
            $gift->address = $request->address;
            $gift->update();
        }

        return redirect()
            ->route('mgt.gift.index')
            ->with('msg',['type'=>'success','text'=> 'Satuan Berhasil diperbaharui']);
    }

    public function destroy($id)
    {
        Gift::where('id', $id)->delete();
        return response()->json(['status' => true]);
    }
}
