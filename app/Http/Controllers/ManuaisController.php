<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Recursos\Anexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ManuaisController extends Controller
{

    private $anexo;

    public function __construct(Anexo $anexo){
        $this->anexo = $anexo;  // Injeta a dependência do anexo no construtor do controller
    }

    public function index(){
        $rows = Manual::all();
        return view('manuais.index', compact('rows'));
    }

    public function create(){
        return view('manuais.create');
    }

    public function store(Request $request){

        try {
            DB::beginTransaction();
            $manual = Manual::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,   
            ]);
            
            try {
                if(isset($request->pdf) && $request->pdf->isValid()){
                    $pdf = $this->anexo->StoreManual($manual->id, $request->pdf, $manual->pdf);
                    $manual->update([
                        'pdf' => $pdf,
                    ]);
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th->getMessage());
                return redirect()->back()->with('error','error ao salvar Pdf');
            }

            DB::commit();
            return redirect()->route('manuais.index')->with('success', 'Manual Cadastrado com sucesso!');

        } catch (\Throwable $th) {
            
            DB::rollback();
            return redirect()->back()->with('error','error ao cadastrar Manual');
            
        }

    }

    public function pdf_ribbon(){
        $caminhoPdf = storage_path('app/public/manuais/GuiaTrocaRibbon.pdf'); // Altere para o nome do seu arquivo
        
        // Verifique se o arquivo existe
        if (!file_exists($caminhoPdf)) {
            abort(404, 'Arquivo PDF não encontrado.');
        }

        // Exibir o PDF no navegador
        return response()->file($caminhoPdf);

    }

    public function pdf_painel(){
        
        $caminhoPdf = storage_path('app/public/manuais/GuiaPainelDeSenhasImpressora.pdf'); // Altere para o nome do seu arquivo

        // Verifique se o arquivo existe
        if (!file_exists($caminhoPdf)) {
            abort(404, 'Arquivo PDF não encontrado.');
        }

        // Exibir o PDF no navegador
        return response()->file($caminhoPdf);

    }

    public function pdf_controle(){
        
        
        $caminhoPdf = storage_path("app/public/manuais/ConfiguracaoControle.pdf"); // Altere para o nome do seu arquivo

        // Verifique se o arquivo existe
        if (!file_exists($caminhoPdf)) {
            abort(404, 'Arquivo PDF não encontrado.');
        }

        // Exibir o PDF no navegador
        return response()->file($caminhoPdf);
    }
}
