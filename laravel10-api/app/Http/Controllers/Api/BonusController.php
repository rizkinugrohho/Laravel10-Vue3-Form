<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BonusResource;
use App\Models\Bonus;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function index()
    {
        //get all posts
        $bonus = Bonus::latest()->paginate(5);

        //return collection of bonus as a resource
        return new BonusResource(true, 'List Data bonus', $bonus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_bonus' => 'required|numeric',
            'employee1' => 'required|string',
            'percentage1' => 'required|numeric|min:0|max:100',
            'employee2' => 'required|string',
            'percentage2' => 'required|numeric|min:0|max:100',
            'employee3' => 'required|string',
            'percentage3' => 'required|numeric|min:0|max:100',
        ]);

        $totalBonus = $request->input('total_bonus');
        $percentage1 = $request->input('percentage1') / 100;
        $percentage2 = $request->input('percentage2') / 100;
        $percentage3 = $request->input('percentage3') / 100;

        $totalPercentage = $percentage1 + $percentage2 + $percentage3;

        if ($totalPercentage != 1) {
            return redirect()->back()->with('error', 'Pembagian bonus masih salah. Total persentase harus 100%.');
        }

        $bonus1 = $totalBonus * $percentage1;
        $bonus2 = $totalBonus * $percentage2;
        $bonus3 = $totalBonus * $percentage3;

        // Simpan data ke database
        $bonus = Bonus::create([
            'total_bonus' => $totalBonus,
            'employee1' => $request->input('employee1'),
            'percentage1' => $percentage1,
            'bonus1' => $bonus1,
            'employee2' => $request->input('employee2'),
            'percentage2' => $percentage2,
            'bonus2' => $bonus2,
            'employee3' => $request->input('employee3'),
            'percentage3' => $percentage3,
            'bonus3' => $bonus3,
        ]);

        return new BonusResource(true, 'Data Bonus Berhasil Ditambahkan!', $bonus);
    }

    public function show(string $id)
    {
        //get Bonus by ID
        $bonus = Bonus::findOrFail($id);

        //render view with bonus
        return new BonusResource(true, 'Detail Data Bonus!', $bonus);
    }

    public function update(Request $request, Bonus $bonus, string $id)
    {
        $bonus = Bonus::findOrFail($id);
        if ($bonus->update($request->validate([
            'total_bonus' => 'required|numeric',
            'employee1' => 'required|string',
            'percentage1' => 'required|numeric|min:0|max:100',
            'employee2' => 'required|string',
            'percentage2' => 'required|numeric|min:0|max:100',
            'employee3' => 'required|string',
            'percentage3' => 'required|numeric|min:0|max:100',
        ]))) {

            $totalBonus = $request->input('total_bonus');
            $percentage1 = $request->input('percentage1') / 100;
            $percentage2 = $request->input('percentage2') / 100;
            $percentage3 = $request->input('percentage3') / 100;

            $totalPercentage = $percentage1 + $percentage2 + $percentage3;

            if ($totalPercentage != 1) {
                return response()->json(['error' => 'Pembagian bonus masih salah. Total persentase harus 100%.'], 422);
            }

            $bonus1 = $totalBonus * $percentage1;
            $bonus2 = $totalBonus * $percentage2;
            $bonus3 = $totalBonus * $percentage3;

            // Update data ke database
            $bonus->update([
                'total_bonus' => $totalBonus,
                'employee1' => $request->input('employee1'),
                'percentage1' => $percentage1,
                'bonus1' => $bonus1,
                'employee2' => $request->input('employee2'),
                'percentage2' => $percentage2,
                'bonus2' => $bonus2,
                'employee3' => $request->input('employee3'),
                'percentage3' => $percentage3,
                'bonus3' => $bonus3,
            ]);

            return new BonusResource(true, 'Data Post Berhasil Diubah!', $bonus);

        }
    }

    public function destroy($id)
    {

        //find post by ID
        $bonus = Bonus::find($id);

        //delete Bonus
        $bonus->delete();

        //return response
        return new BonusResource(true, 'Data Bonus Berhasil Dihapus!', null);
    }
}
