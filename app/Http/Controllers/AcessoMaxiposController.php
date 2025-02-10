<?php

namespace App\Http\Controllers;

use App\Models\Acessomaxipos;
use App\Models\Acessopromotor;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

class AcessoMaxiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $funcionario = $request->nome_funcionario;
        $mateusid = $request->mateusid;
        $gmcore = $request->gmcore;
        
        $filial = session()->get('filial')->id;
        
        $rows = Acessomaxipos::where('filial_id', $filial);
        
        if ($request['nome_funcionario'] != '') {
            $rows->where('nome', 'LIKE', '%'.$request['nome_funcionario'].'%');
        }
        if ($request['mateusid'] != '') {
            $rows->where('login', 'LIKE', '%'.$request['mateusid'].'%');
        }
        if ($request['gmcore'] != '') {
            $rows->where('cod_gm', 'LIKE', '%'.$request['gmcore'].'%');
        }

        $rows = $rows->orderby('nome', 'ASC')->paginate(15);
        
        return view('acesso_maxipos.index', compact('rows', 'filial', 'funcionario', 'mateusid', 'gmcore'));
    }

    public function create()
    {
        return View('acesso_maxipos.create');
    }

    public function store(Request $request)
    {
        $isexist = Acessomaxipos::where('login', $request['login'])->orWhere('cod_gm', $request['cod_gm']);
        if ($isexist->count() > 0){
            return redirect()->back()->with('info', 'Colaborador já cadastrado!');
        }

        Acessomaxipos::create([
            'filial_id' => session()->get('filial')->id,
            'nome' => $request->nome,
            'login' => $request->login,
            'senha' => $request->senha,
            'cod_gm' => $request->cod_gm
        ]);

        return redirect()->route('acesso_maxipos.index')->with('success', 'Usuario maxpos cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcessoMaxipos  $acesso_naxipos
     * @return \Illuminate\Http\Response
     */
    public function show(AcessoMaxipos $acesso_maxipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcessoMaxipos  $acesso_naxipos
     * @return \Illuminate\Http\Response
     */
    public function edit(Acessomaxipos $acesso_maxipos)
    {
        return view('acesso_maxipos.edit', compact('acesso_maxipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcessoMaxipos  $acesso_naxipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acessomaxipos $acesso_maxipos)
    {
        // $isexist = Acessomaxipos::where('login', $request['login'])->orWhere('cod_gm', $request['cod_gm']);
        // if ($isexist->count() > 0){
        //     return redirect()->back()->with('info', 'Colaborador já cadastrado!');
        // }

        $acesso_maxipos->update([
            'filial_id' => session()->get('filial')->id,
            'nome' => $request->nome,
            'login' => $request->login,
            'senha' => $request->senha,
            'cod_gm' => $request->cod_gm,
        ]);
        
        return redirect()->route('acesso_maxipos.index')->with('success', 'Usuario maxpos atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcessoMaxipos  $acesso_naxipos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acessomaxipos $acesso_maxipos)
    {   
        $acesso_maxipos->delete();
        return redirect()->route('acesso_maxipos.index')->with('success', 'Usuario maxpos removido com sucesso!');
    }
    
    // PROMOTOR //
    
    public function indexPromotor(Request $request)
    {
        $promotor = $request->nome_promotor;
        $mateusid = $request->mateusid;
        $cpf = $request->cpf;
        
        $filial = session()->get('filial')->id;
        
        $rows = Acessopromotor::where('filial_id', $filial);
        
        if ($request['promotor'] != '') {
            $rows->where('nome', 'LIKE', '%'.$request['nome_promotor'].'%');
        }
        if ($request['mateusid'] != '') {
            $rows->where('mateusid', 'LIKE', '%'.$request['mateusid'].'%');
        }
        if ($request['cpf'] != '') {
            $rows->where('cpf', 'LIKE', '%'.$request['cpf'].'%');
        }
        
        $rows = $rows->orderby('nome', 'ASC')->paginate(15);
        
        return view('acesso_maxipos.promotor.index', compact('rows', 'filial', 'promotor', 'mateusid', 'cpf'));
    }

    public function createPromotor()
    {
        return View('acesso_maxipos.promotor.create');
    }

    public function storePromotor(Request $request)
    {
        $isexist = Acessopromotor::Where('mateusid', $request['mateusid'])->orWhere('cpf', $request['cpf'])->orWhere('numero', $request['numero'])->first();
        // if ($isexist->count() > 0){
            switch ($isexist->count() > 0) {
                case $isexist->mateusid == $request['mateusid']:
                    return redirect()->back()->withInput()->with('info', 'MateusID já cadastrado!');
                    break;
                case $isexist->cpf == $request['cpf']:
                    return redirect()->back()->withInput()->with('info', 'CPF já cadastrado!');
                    break;
                case $isexist->numero == $request['numero']:
                    return redirect()->back()->withInput()->with('info', 'Número já cadastrado!');
                    break;
                default:
                    return redirect()->back()->withInput()->with('danger', 'Erro no cadastro, contate o suporte');
                    break;
            }
            // return $request->all();
            // return redirect()->back()->with('info', 'Colaborador já cadastrado!');
        // }
    
        Acessopromotor::create([
            'filial_id' => session()->get('filial')->id,
            'nome' => $request->nome,
            'mateusid' => $request->mateusid,
            'senha' => $request->senha,
            'cpf' => $request->cpf,
            'numero' => $request->numero,
        ]);

        return redirect()->route('acesso_promotor.index')->with('success', 'Promotor cadastrado com sucesso!');
    }

    public function showPromotor(Acessopromotor $acesso_promotor)
    {
        //
    }

    public function editPromotor(Acessopromotor $acesso_promotor)
    {
        return view('acesso_maxipos.promotor.edit', compact('acesso_promotor'));
    }

    public function updatePromotor(Request $request, Acessopromotor $acesso_promotor)
    {
        
        $acesso_promotor->update([
            'filial_id' => session()->get('filial')->id,
            'nome' => $request->nome,
            'mateusid' => $request->mateusid,
            'senha' => $request->senha,
            'cpf' => $request->cpf,
            'numero' => $request->numero,
        ]);
        
        return redirect()->route('acesso_promotor.index')->with('success', 'Acesso Promotor atualizado com sucesso!');
    }

    public function destroyPromotor(Acessopromotor $acesso_promotor)
    {   
        $acesso_promotor->delete();
        return redirect()->route('acesso_promotor.index')->with('success', 'Acesso Promotor removido com sucesso!');
    }
}