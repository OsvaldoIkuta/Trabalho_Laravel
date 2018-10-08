<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Painel\StandardController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;

class CategoryController extends StandardController
{
    //

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $totalpages = 10;
    protected $views = 'painel.modulos.categoria';
    protected $rotas = 'categorias';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }



    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');

        //Filtra os usuários
        $datas = $this->model
            ->where('name', 'LIKE', "%{$dataForm}%")
            ->paginate($this->totalpages);
        //dd($datas);
        return view("{$this->views}.index", compact('datas', 'dataForm'));
    }


}
