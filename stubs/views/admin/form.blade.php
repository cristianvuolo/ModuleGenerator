@extends('admin.layout.loader')

@section('content')
    {!! BootForm::open([
        'model' => $model,
        'id' => 'form',
        'store' => "admin.{$moduleName}.store",
        'update' => "admin.{$moduleName}.update",
        'enctype' => 'multipart/form-data'
    ]) !!}

    {!! formBtn("admin.{$moduleName}.gerenciar") !!}
    {!! BootForm::close() !!}

@endsection

@section('js')
    @parent
    {!! tinymce() !!}
    <script type="text/javascript">
        $('#price').mask("#.##0,00", {reverse: true});
    </script>
@endsection