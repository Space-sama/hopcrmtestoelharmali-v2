@extends('layouts.global_assets')
@section('content')
<div class="container myContainerr">
    <a type="button" class="btn btn-primary mb-5" href="{{url('/add_contact')}}">Ajouter un nouveau Contact</a>
    <table id="example" class="table table-striped table-bordered table-blue" style="width:100%">
        <thead>
            <tr>
                <th style="text-transform: uppercase" data-priority="1">nom du contact</th>
                <th  style="text-transform: uppercase" data-priority="2">société</th>
                <th style="text-transform: uppercase" data-priority="3">statut</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $c)
            <tr>
                <td>{{$c->nom}} {{$c->prenom}}</td>
                <td>{{$c->organisation->nom}}</td>
                <td>
                    @if($c->organisation->statut == "LEAD")
                        <span class="badge badge-primary">{{$c->organisation->statut}}</span>
                    @endif
                    @if($c->organisation->statut == "CLIENT")
                        <span class="badge badge-success">{{$c->organisation->statut}}</span>
                    @endif
                    @if($c->organisation->statut == "PROSPECT")
                        <span class="badge badge-warning">{{$c->organisation->statut}}</span>
                    @endif
                </td>
                <td>
                    <button title="Consulter" class="editOnModal btn-modif" value="{{$c->id}}/{{$c->organisation->id}}" type="button" data-toggle="modal" data-target="#exampleModal{{$c->id}}">
                        👁️‍🗨️
                    </button>
                    @include('contacts.modal')
                </td>
                <td>
                    <a id="edit" title="Modifier" href="{{url('/edit_contact/'.$c->id)}}">
                        📝
                    </a>
                </td>
                <td>
                    <form action="{{url('/delete_contact/'.$c->id)}}" method="post">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                        <button class="btn-delete" onclick="return confirm('Voulez vous vraiment supprimer ce contact ?')" type="submit"><span title="Supprimer">🗑️</span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
<br><br><br>
@endsection


