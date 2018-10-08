<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Painel\StandardController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class PostController extends StandardController
{
    //

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $totalpages = 10;
    protected $views = 'painel.modulos.post';
    protected $rotas = 'posts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function create()
    {
        $categories = Category::all();
        return view ("{$this->views}.create-edit", compact('categories'));
    }

    public function store(Request $request)
    {
        //$date = $this->request->input('date');

        //VALIDA OS DADOS
        $this->validate($request, $this->model->rules());

        //PEGANDO OS DADOS DO FORMULÁRIO

        $dataForm = $request->all();

        $dataForm['user_id'] = auth()->user()->id;

        //dd($dataForm);
        //$now = new \DateTime();
        //$dataForm['date'] = $now->createFromFormat('d/m/Y', $request->input('date'));
        //$data = $now->format('Y/m/d');
        //dd($data);



        //dd($date);
        //echo $dataForm['user_id'];
        //$now = new \DateTime();
        //dd($now);
        //$dataForm['date'] = $now->format('Y/m/d');
        //$dataForm['date'] = date("Y-m-d");

        //dd($dataForm['date']);

        //$dataForm['hour'] = $now->format('H:i:s');
        //dd($dataForm['hour']);

        //Verificar se existe a imagem
        if ( $request->hasFile('image')){
            //pegar a imagem
            $image = $request->file('image');

            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs($this->rotas, $nameFile);

            if ( $upload )
                $dataForm['image'] = $nameFile;
            else
                return redirect()
                    ->route("{$this->rotas}.index")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }


        //inserir os dados
        $insert = $this->model->create($dataForm);

        //RETORNADO MENSAGEM PARA VIEW
        if($insert)
            return redirect()
                ->route("{$this->rotas}.index")
                ->with(['success'=>'Cadastro realizado com sucesso!']);
        else
            return redirect()
                ->route( "{$this->rotas}.create")
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

    public function edit($id)
    {
        $categories = Category::all();
        //Recuperar usuário
        $data = $this->model->find($id);
        //dd($data);

        return view("{$this->views}.create-edit", compact('data', 'categories'));
    }



    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');

        //Filtra os usuários
        $datas = $this->model
            ->where('name', 'LIKE', "%{$dataForm}%")
            ->paginate($this->totalpages);

        return view("{$this->views}.index", compact('datas', 'dataForm'));
    }


}
