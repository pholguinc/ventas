@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background: #343a40;">
                    <h4 class="text-white">
                        {{ $pageTitle }} | {{ $componentName }}
                    </h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Modal
                            With Form</button>
                    </div>
                </div>

                <div class="card-body p-0">

                    @include('components.search')

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <th width="100px" class="text-light text-center">CÓDIGO</th>
                                <th class="text-light">NOMBRE</th>
                                <th class="text-light">DESCRIPCIÓN</th>
                                <th>CODE</th>
                                <th class="text-light">ACCIONES</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $category)
                                <tr>
                                    <td class="text-center">{{ $category->code }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->code }}</td>
                                    <td>
                                        <a wire:click="Edit({{ $category->id }})" class="btn btn-primary text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="Confirm('{{ $category->id }}')" class="btn btn-danger text-white">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('livewire.Categories.form')
</div>
@endsection
@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {

    });

</script>

@endsection
