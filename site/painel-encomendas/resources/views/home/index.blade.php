@extends('default/layout')

@section('content')
    <style>
        .col-4 {
            width: calc(33.3333% - 1rem);
        }
    </style>

    <input type="hidden" name="encomendas" id="encomendas"
        value="@if (isset($encomendas)) {{ json_encode($encomendas) }} @endif">

    <nav class="navbar navbar-expand-lg bg-white p-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="/LocalEasy.png" alt="Logo" width="150"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-novo">Novo
                            rastreio</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-historico">Histórico
                            de rastreios</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="mt-3">
        <div class="container">
            <div class="row d-flex justify-content-between gap-3" id="encomendas-div">
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-novo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="/rastreio/novo">
                @csrf
                <input type="hidden" name="user" id="user" value="{{ $user->id }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Rastreio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="cod_rastreio" class="form-label">Código de Rastreio</label>
                        <input type="text" name="cod_rastreio" id="cod_rastreio" class="form-control"
                            placeholder="Código de rastreio">
                    </div>

                    <div class="mb-3">
                        <label for="transportadora" class="form-label">Transportadora</label>
                        <select class="form-select" name="transportadora" id="transportadora">
                            <option value="correios" selected>Correios</option>
                            <option value="jadlog">JadLog</option>
                            <option value="melhor_envio">Melhor Envio</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-historico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="min-width: 1050px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Histórico de Rastreios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <table class="datatable-table" style="border-radius: 10px; width: 100%; overflow: scroll">
                    <thead class="datatable-head">
                      <tr class="datatable-row" style="left: 0px;">
                        <th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="padding-left: 10px; width: 300px;">Código</span></th>
                        <th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 100px;">Transportadora</span></th>
                        <th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 500px;">status</span></th>
                        <th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span style="width: 150px;">Ativo</span></th>
                      </tr>
                    </thead>

                    <tbody id="body" class="datatable-body">
                      @foreach ($log as $l)
                        <tr class="datatable-row" style="height: 60px; @if($l->ativo == 0) background-color: #f0a1a9 @endif @if($l->ativo == 2) background-color: #7ed6ad @endif">
                          <td class="datatable-cell"><span class="codigo" style="padding-left: 10px; width: 300px;" id="id">{{$l->codigo}}</span>
                          </td>
                          <td class="datatable-cell"><span class="codigo" style="width: 100px;" id="id">{{$l->transportadora}}</span>
                          </td>
                          <td class="datatable-cell"><span class="codigo" style="width: 500px;" id="id">{{$l->status}}</span>
                          </td>
                          <td class="datatable-cell"><span class="codigo" style="padding-right: 20px; width: 150px;" id="id">
                            @if($l->ativo == 0) Cancelado @endif @if($l->ativo == 2) Recebido @endif @if($l->ativo == 1) Em transito @endif
                          </span>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
