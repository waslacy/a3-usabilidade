<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Undefined;

class HomeController extends Controller
{
    public function index()
    {
        if (session('user_logged')) {
            $user = User::where('email', session('user_logged')['email'])->first();
            $encomendas = Encomenda::where('user', $user->id)->get();
            $log = Encomenda::get();

            return view('home/index')
                ->with('user', $user)
                ->with('log', $log)
                ->with('encomendas', $encomendas);
        } else {
            return redirect('/');
        }
    }

    public function saveRastreio(Request $request)
    {
        $encomenda = new Encomenda;

        $encomenda->create([
            'user' => $request->user,
            'codigo' => $request->cod_rastreio,
            'transportadora' => $request->transportadora,
            'status' => '',
            'ultima_atualizacao' => date('d/m/Y H:i'),
            'ativo' => 1,
        ]);

        return redirect('/home');
    }

    public function getEncomendas()
    {
        $encomendas = Encomenda::
        where('ativo', 1)
        ->get();

        $encomendasJSON = [];

        foreach($encomendas as $e){
            array_push($encomendasJSON, $e->codigo);
        }

        $encomendasJSON = json_encode($encomendasJSON);


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/correios");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "encomendas=$encomendasJSON");

        $response = curl_exec($ch);
        $response = json_decode($response);
        curl_close($ch);

        foreach($response as $r){
            $encomenda = Encomenda::
            where('codigo', $r->cod)
            ->first();

            $encomenda->status = $r->status;
            $encomenda->ultima_atualizacao = date('d/m/Y H:i');
            $encomenda->save();
        }


        $encomendasAtualizadas = json_encode(Encomenda::
        where('ativo', 1)
        ->get());
        return response()->json($encomendasAtualizadas, 200);
    }

    public function deleteRastreio($id){
        $encomenda = Encomenda::
        where('id', $id)
        ->first();

        $encomenda->ativo = 0;
        $encomenda->save();

        return redirect('/home');
    }

    public function receber($id){
        $encomenda = Encomenda::
        where('id', $id)
        ->first();

        $encomenda->ativo = 2;
        $encomenda->save();

        return redirect('/home');
    }
}
