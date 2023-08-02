
@extends('layouts.global_assets')
@section('title', 'Ajouter un nouveau contact')
@section('content')

<div class="container myContainer">
    <center><h4 class="mb-5">Ajouter un nouveau contact</h4></center>
    <center><h6 class="mt-3 correction">{{ Session::get('correction') }}</h6></center>

    <form action="{{ url('/add_contact_action') }}" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prénom">Prénom</label>
                    <input name="prenom" type="text" class="form-control" value="{{ Session::get('nom') ??  old('prenom') }}" id="prénom" placeholder="Votre Prénom ?" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input name="nom" type="text" class="form-control" value="{{ Session::get('nom') ??  old('nom')}}" id="nom" placeholder="Votre Nom ?" />
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="email" class="form-control" value="{{ Session::get('email') ??  old('email') }}" id="email" placeholder="Votre E-mail ?" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tel">Téléphone fixe :</label>
                    <input name="telephone_fixe" type="text" class="form-control" value="{{ Session::get('telephone_fixe') ??  old('telephone_fixe') }}" id="tel" placeholder="Votre Téléphone ?" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fonction">Fonction</label>
                    <input name="fonction" type="text" class="form-control" value="{{ Session::get('fonction') ??  old('fonction') }}" id="fonction" placeholder="Votre Fonction ?" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="service">Service</label>
                    <input name="service" type="text" class="form-control" id="service" value="{{ Session::get('service') ??  old('service') }}" placeholder="Votre Service ?" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="org_name">Entreprise ?</label>
                    <input name="org_name" type="text" class="form-control" id="org_name" value="{{ Session::get('org_name') ??  old('org_name') }}" placeholder="L'organisation ?" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control" name="adresse" id="adresse" rows="3" placeholder="L'adresse de l'entreprise ?">{{ Session::get('adresse') ??  old('adresse') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code_postal">Code Postal</label>
                    <input name="code_postal" type="text" class="form-control" id="code_postal" value="{{ Session::get('code_postal') ??  old('code_postal') }}" placeholder="Code postal ?" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input name="ville" type="text" class="form-control" id="ville" value="{{ Session::get('ville') ??  old('ville') }}" placeholder="La ville ?" />
                </div>
            </div>
            <div class="col-md-8">
                <label for="statut">Statut</label>
                <select name="statut" class="custom-select" id="statut">
                  <option value="PROSPECT">PROSPECT</option>
                  <option value="CLIENT">CLIENT</option>
                  <option value="LEAD">LEAD</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le contact</button>
    </form>
</div>

@endsection



