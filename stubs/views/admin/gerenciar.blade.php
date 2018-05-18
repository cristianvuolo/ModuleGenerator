@extends('admin.layout.loader')

@section('content')

    <a href="{{ route("admin.{$moduleName}.novo") }}" class="btn btn-success"><i class="fa fa-plus"></i> Cadastrar {{ $moduleTitle }}</a>
    <hr>
    <table id="gerenciar" class="table table-bordered table-striped img">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Cursos</th>
            <th>Cadastro</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($itens as $iten)
            <tr>
                <td>
                    <a href="{{ route("admin.{$moduleName}.alterar", ['id' => $iten->id]) }}" title="Alterar">
                        {{ $iten->name }}
                    </a>
                </td>
                <td>{{ $iten->email }}</td>
                <td></td>
                <td>{{ $iten->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route("admin.{$moduleName}.alterar", ['id' => $iten->id]) }}" class="btn btn-success" title="Alterar">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onClick="deletar('{{ route("admin.{$moduleName}.delete", ['id' => $iten->id]) }}')" class="btn btn-danger" title="Excluir">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@include('admin.partials.datatables', ['disable' => '4', 'dates' => [3], 'default' => [0],])
