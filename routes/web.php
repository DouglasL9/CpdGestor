<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AcessoMaxiposController,
    CalcularSenhaController,
    CheckListController,
    CodigoBarrasController,
    PainelController,
    ResetaSenhaController,
    UsuarioController,
    ErrositefController,
    EscalaController,
    EstoqueController,
    FilialController,
    FuncaoController,
    FuncionarioController,
    ItemController,
    ManuaisController,
    PontoController,
    SalarioController
};


//use App\Http\Controllers\Api\FatorController;
use App\Http\Controllers\Authentication\LoginController;

Route::get('/', function () {
    if(auth()->user()) return redirect()->route('painel.index');
    return view('authentication.login');
});
Route::get('/login', function () {
    if(auth()->user()) return redirect()->route('painel.index');
    return view('authentication.login');
})->name('login');

// Rotas para Redefinição de Senha
Route::group(['prefix'=>'reseta-senha'], function(){
    Route::post('/send-mail', [ResetaSenhaController::class, 'sendMail'])->name('resetasenha.sendmail');
    Route::get('/{token}', [ResetaSenhaController::class, 'resetView'])->middleware('guest')->middleware('guest')->name('password.reset');
    Route::post('/update', [ResetaSenhaController::class, 'update'])->name('password.update');
});


Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/cadastro', [LoginController::class, 'cadastro'])->name('login.cadastro');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->get('painel', [PainelController::class, 'index'])->name('painel.index');

    // PERFIL USUÁRIO
Route::group(['prefix' => 'usuario', 'as' => 'usuario.', 'middleware'=>['auth']], function(){
    Route::get('/', [UsuarioController::class, 'index'])->name('index');
    Route::get('/{usuario}/perfil', [UsuarioController::class, 'perfil'])->name('perfil');
    Route::get('/{usuario}/show', [UsuarioController::class, 'show'])->name('show');
    Route::get('/creat', [UsuarioController::class, 'creat'])->name('creat');
    Route::get('/{usuario}/edit', [UsuarioController::class, 'edit'])->name('edit');
    Route::put('/{usuario}/update', [UsuarioController::class, 'update'])->name('update');
    Route::get('/{usuario}/destroy', [UsuarioController::class, "destroy"])->name('destroy');
    Route::post('/store', [UsuarioController::class, 'store'])->name('store');
});

//     // FUNCIONÁRIO
// Route::group(['prefix' => 'funcionarios', 'as' => 'funcionarios.', 'middleware'=>['auth']], function(){
//     Route::get('/', [FuncionarioController::class, 'index'])->name('index');
//     Route::get('/{funcionario}/show', [FuncionarioController::class, 'show'])->name('show');
//     Route::get('/create', [FuncionarioController::class, 'create'])->name('create');
//     Route::get('/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('edit');
//     Route::put('/{funcionario}/update', [FuncionarioController::class, 'update'])->name('update');
//     Route::get('/{funcionario}/destroy', [FuncionarioController::class, "destroy"])->name('destroy');
//     Route::post('/store', [FuncionarioController::class, 'store'])->name('store');
// });

    // ERRO_SITEF
Route::group(['prefix'=>'erro-sitef', 'as'=>'erro-sitef.', 'middleware'=>['auth']], function(){
    Route::get('/', [ErrositefController::class, 'index'])->name('index');
    Route::get('/create', [ErrositefController::class, 'create'])->name('create');
    Route::post('/store', [ErrositefController::class, 'store'])->name('store');
    Route::get('/{erro_sitef}/edite', [ErrositefController::class, 'edit'])->name('edit');
    Route::put('/{erro_sitef}/update', [ErrositefController::class, 'update'])->name('update');
    Route::get('/{erro_sitef}/destroy', [ErrositefController::class, 'destroy'])->name('destroy');
});

    // ROTAS PONTOS
Route::group(['prefix'=>'ponto', 'as'=>'ponto.', 'middleware'=>['auth']], function(){
    Route::get('/index', [PontoController::class, 'index'])->name('index');
    Route::get('create', [PontoController::class, 'create'])->name('create');
    Route::post('store', [PontoController::class, 'store'])->name('store');
    Route::get('{ponto}/edite', [PontoController::class, 'edite'])->name('edite');
    Route::put('{ponto}/update', [PontoController::class, 'update'])->name('update');
    Route::get('{ponto}/show', [PontoController::class, 'show'])->name('show');
    Route::get('{ponto}/destroy', [PontoController::class, 'destroy'])->name('destroy');
    Route::get('hora-extra', [PontoController::class, 'HoraExtra'])->name('hora-extra');
    Route::get('relatorio', [PontoController::class, 'relatorio'])->name('relatorio');
    Route::get('pdf', [PontoController::class, 'pdf'])->name('pdf');
    Route::get('xlsx', [PontoController::class, 'xlsx'])->name('xlsx');
    Route::get('csv', [PontoController::class, 'csv'])->name('csv');
});

    // ESCALA
Route::group(['prefix'=>'escala', 'as'=>'escala.', 'middleware'=>['auth']], function(){
    Route::get('/index', [EscalaController::class, 'index'])->name('index');
    Route::post('/store', [EscalaController::class, 'store'])->name('store');
    Route::get('/{escala}/destroy', [EscalaController::class, 'destroy'])->name('destroy');
    Route::put('/{escala}/update', [EscalaController::class, 'update'])->name('update');
});

    // FILIAL
Route::group(['prefix'=>'filial', 'as'=>'filial.', 'middleware'=>['auth']], function(){
    Route::get('/index', [FilialController::class, 'index'])->name('index');
    Route::get('{filial}/edit', [FilialController::class, 'edit'])->name('edit');
    Route::get('/create', [FilialController::class, 'create'])->name('create');
    Route::post('/store', [FilialController::class, 'store'])->name('store');
    Route::put('/{filial}/update', [FilialController::class, 'update'])->name('update');

    // FUNÇÃO
    Route::group(['prefix'=>'funcao', 'as' =>'funcao.', 'middleware'=>['auth']], function(){
        Route::get('/', [FuncaoController::class, 'index'])->name('index');
        Route::get('filial/{filial}/funcao/{funcao}/edit', [FuncaoController::class, 'edit'])->name('edit');
        Route::get('{filial}/create', [FuncaoController::class, 'create'])->name('create');
        Route::post('{filial}/store', [FuncaoController::class, 'store'])->name('store');
        Route::put('filial/{filial}/funcao/{funcao}/update', [FuncaoController::class, 'update'])->name('update');
    });

    // SALARIO
    Route::group(['prefix'=>'salario', 'as' =>'salario.', 'middleware'=>['auth']], function(){
        // Route::get('/', [SalarioController::class, 'index'])->name('index');
        Route::get('funcao/{funcao}/salario/{salario}/edit', [SalarioController::class, 'edit'])->name('edit');
        Route::get('funcao/{funcao}/create', [SalarioController::class, 'create'])->name('create');
        Route::post('funcao/{funcao}/store', [SalarioController::class, 'store'])->name('store');
        Route::put('/funcao/{funcao}/salario/{salario}/update', [SalarioController::class, 'update'])->name('update');
    });
    
    // Estoque
    Route::group(['prefix'=>'estoque', 'as' =>'estoque.', 'middleware'=>['auth']], function(){
        Route::get('/', [EstoqueController::class, 'index'])->name('index');
        Route::get('{estoque}/edit', [EstoqueController::class, 'edit'])->name('edit');
        Route::get('create', [EstoqueController::class, 'create'])->name('create');
        Route::post('store', [EstoqueController::class, 'store'])->name('store');
        Route::put('{estoque}/update', [EstoqueController::class, 'update'])->name('update');
    });
    
    // Itens
    Route::group(['prefix'=>'item', 'as' =>'item.', 'middleware'=>['auth']], function(){
        Route::get('/', [ItemController::class, 'index'])->name('index');
        Route::get('{item}/edit', [ItemController::class, 'edit'])->name('edit');
        Route::get('create', [ItemController::class, 'create'])->name('create');
        Route::post('store', [ItemController::class, 'store'])->name('store');
        Route::put('{item}/update', [ItemController::class, 'update'])->name('update');
        Route::get('{item}/destroy', [ItemController::class, 'destroy'])->name('destroy');

    });
});

    //CÓDIGO DE BARRAS
Route::group(['prefix'=>'codigo_barra', 'as' =>'codigo_barra.', 'middleware'=>['auth']], function(){
    Route::get('/', [CodigoBarrasController::class, 'index'])->name('index');
    Route::get('pdf', [CodigoBarrasController::class, 'gerarPdf'])->name('gerarPdf');
});

//     // CHECK-LIST
// Route::group(['prefix'=>'check-list', 'as'=>'check-list.', 'middleware'=>['auth']], function(){
//     Route::group(['prefix'=>'fechamento', 'as'=>'fechamento.'], function(){
//     Route::get('/', [CheckListController::class, 'fechamento_index'])->name('index');
//     Route::get('/create', [CheckListController::class, 'create'])->name('create');
//     Route::post('/store', [CheckListController::class, 'store'])->name('store');
//     Route::post('/show', [CheckListController::class, 'show'])->name('show');
//     Route::get('/{check-list}/edite', [CheckListController::class, 'edit'])->name('edit');
//     Route::put('/{check-list}/update', [CheckListController::class, 'update'])->name('update');
//     Route::get('/{check-list}/destroy', [CheckListController::class, 'destroy'])->name('destroy');
// });

//     Route::get('/', [CheckListController::class, 'index'])->name('index');
//     Route::get('/create', [CheckListController::class, 'create'])->name('create');
//     Route::post('/store', [CheckListController::class, 'store'])->name('store');
//     Route::post('/show', [CheckListController::class, 'show'])->name('show');
//     Route::get('/{check-list}/edite', [CheckListController::class, 'edit'])->name('edit');
//     Route::put('/{check-list}/update', [CheckListController::class, 'update'])->name('update');
//     Route::get('/{check-list}/destroy', [CheckListController::class, 'destroy'])->name('destroy');
// });

    //ACESSO MAXIPOS
Route::group(['prefix'=>'acesso_maxipos', 'as' =>'acesso_maxipos.', 'middleware'=>['auth']], function(){
    Route::get('/', [AcessoMaxiposController::class, 'index'])->name('index');
    Route::get('/create', [AcessoMaxiposController::class, 'create'])->name('create');
    Route::post('/store', [AcessoMaxiposController::class, 'store'])->name('store');
    Route::post('/show', [AcessoMaxiposController::class, 'show'])->name('show');
    Route::get('/{acesso_maxipos}/edite', [AcessoMaxiposController::class, 'edit'])->name('edit');
    Route::put('/{acesso_maxipos}/update', [AcessoMaxiposController::class, 'update'])->name('update');
    Route::get('/{acesso_maxipos}/destroy', [AcessoMaxiposController::class, 'destroy'])->name('destroy');
    // Route::get('pdf', [AcessoMaxiposController::class, 'gerarPdf'])->name('gerarPdf');
});

Route::group(['prefix'=>'acesso_promotor', 'as' =>'acesso_promotor.', 'middleware'=>['auth']], function(){
    Route::get('/', [AcessoMaxiposController::class, 'indexPromotor'])->name('index');
    Route::get('/create', [AcessoMaxiposController::class, 'createPromotor'])->name('create');
    Route::post('/store', [AcessoMaxiposController::class, 'storePromotor'])->name('store');
    Route::post('/show', [AcessoMaxiposController::class, 'showPromotor'])->name('show');
    Route::get('/{acesso_promotor}/edite', [AcessoMaxiposController::class, 'editPromotor'])->name('edit');
    Route::put('/{acesso_promotor}/update', [AcessoMaxiposController::class, 'updatePromotor'])->name('update');
    Route::get('/{acesso_promotor}/destroy', [AcessoMaxiposController::class, 'destroyPromotor'])->name('destroy');
    // Route::get('pdf', [AcessoMaxiposController::class, 'gerarPdf'])->name('gerarPdf');
});

  //SENHA PDV
Route::group(['prefix'=>'senha-pdv', 'as' =>'senha-pdv.', 'middleware'=>['auth']], function(){
    Route::get('/', [CalcularSenhaController::class, 'index'])->name('index');
});


    //MANUAIS
Route::group(['prefix'=>'manuais', 'as' =>'manuais.', 'middleware'=>['auth']], function(){
    Route::get('/', [ManuaisController::class, 'index'])->name('index');
    Route::get('create/', [ManuaisController::class, 'create'])->name('create');
    Route::post('store/', [ManuaisController::class, 'store'])->name('store');
    Route::get('edite/', [ManuaisController::class, 'edite'])->name('edite');
    Route::put('update/', [ManuaisController::class, 'update'])->name('update');
    Route::get('delete/', [ManuaisController::class, 'delete'])->name('delete');
    Route::get('/pdf-ribbon', [ManuaisController::class, 'pdf_ribbon'])->name('troca-ribbon');
    Route::get('/pdf-painel', [ManuaisController::class, 'pdf_painel'])->name('guia-painel');
    Route::get('/pdf-controle', [ManuaisController::class, 'pdf_controle'])->name('configuracao-controle');
});

