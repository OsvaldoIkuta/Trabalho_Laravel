@extends('painel.templates.dashboard')
@section('conteudo')
    <div class="title-pg">
        <h1 class="title-pg">Cadastro de Post</h1>
    </div>

    <div class="content-din">

        <!-- Alert Errors start -->
        @if( isset($errors) && count($errors) > 0 )
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
                    @foreach( $errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            </div>

        @endif
    <!-- /.Alert Errors start -->
        <!-- form start -->
        @if(isset($data))
            <form
                    class="form form-search form-ds"
                    method="post" action="{{route('posts.update', $data->id)}}" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @else
                    <form
                            class="form form-search form-ds"
                            method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                        @endif
                        {{ csrf_field() }}

                        <div class="form-group col-md-6">
                            <label for="InputName">Título</label>
                            <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Título" value="{{$data->title or old('title')}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="SelectCategory">Nome</label>
                            <select name="category_id" id="SelectCategory" class="form-control">
                                <option value=""> -- Selecione --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" <?php echo (isset($data->category_id)) && ($category->id == $data->category_id)? "selected":"" ?>>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputFile">Imagem de Post</label>
                            <input type="file" id="InputFile" name="image">
                            @if(isset($data->image))
                                <img src="{{URL::asset('/assets/uploads/posts/'.$data->image)}}" alt="$data->image" width="200" height="200" />
                            @endif

                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputDescription">Descrição</label>
                            <input type="text" class="form-control" id="InputDescription" name="description" placeholder="Description" value="{{$data->description or old('description')}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputDate">Data</label>
                            <input type="date" name="date" class="form-control" id="InputDate" value="{{$data->date or old('date')}}" >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputTime">Time</label>
                            <input type="time" name="hour" class="form-control" id="InputTime" value="{{$data->hour or old('hour')}}" >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputFeatured">É destaque?</label>
                            <input type="checkbox" name="featured" class="form-control" id="InputFeatured" value="1" <?php echo (isset($data->featured)) && ($data->featured == 1)? "checked":"" ?>>SIM
                            <input type="checkbox" name="featured" class="form-control" id="InputFeatured" value="0" <?php echo (isset($data->featured)) && ($data->featured == 0)? "checked":""?>>NÃO
                        </div>

                        <div class="form-group col-md-6">
                            <label for="InputStatus">Status</label>
                            <input type="checkbox" name="status" class="form-control" id="InputStatus" value="A" <?php echo (isset($data->status)) && ($data->status == "A")? "checked":""?>>Ativo
                            <input type="checkbox" name="status" class="form-control" id="InputStatus" value="R" <?php echo (isset($data->status)) && ($data->status == "R")? "checked":""?>>Rascunho
                        </div>

                        <div class="form-group col-md-6">
                            <button class="btn btn-info">Enviar</button>
                        </div>
                    </form>

    </div><!--Content Dinâmico-->

@endsection