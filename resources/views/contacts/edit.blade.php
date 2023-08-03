
@extends('./layouts.global_assets')
@section('title', 'Modifier un contact')
@section('content')

<div class="container myContainer">
<center><h4 class="mb-5">Modifier le contact</h4></center>
<center><h6 class="mt-3 correction">{{ Session::get('correction') }}</h6></center>
<form action="{{ url('/edit_contact_action/'.$contactToEdit->id.'/'.$contactToEdit->organisation->id) }}" method="post" data-parsley-validate id="form">

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="prénom">Prénom</label>
                <input name="prenom" type="text" value="{{old('prenom') ?? $contactToEdit->prenom }}" class="form-control" id="prénom" placeholder="Votre Prénom ?" pattern="[A-z]{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input name="nom" type="text" value="{{old('nom') ?? $contactToEdit->nom }}" class="form-control" id="nom" placeholder="Votre Nom ?"pattern="[A-z]{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input name="email" type="email" value="{{old('email') ?? $contactToEdit->email }}" class="form-control" id="email" placeholder="Votre E-mail ?" data-parsley-error-message="Veuillez saisir un valid E-mail !" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tel">Téléphone fixe :</label>
                <input name="telephone_fixe" type="text" value="{{old('telephone_fixe') ?? $contactToEdit->telephone_fixe }}" class="form-control" id="tel" placeholder="Votre Téléphone ?" pattern="[0-9]+" data-parsley-error-message="Veuillez saisir un numéro valide !" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fonction">Fonction</label>
                <input name="fonction" type="text" value="{{old('fonction') ?? $contactToEdit->fonction }}" class="form-control" id="fonction" placeholder="Votre Fonction ?" pattern="[^A-z]*{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="service">Service</label>
                <input name="service" type="text" value="{{old('service') ?? $contactToEdit->service }}" class="form-control" id="service" placeholder="Votre Service ?" pattern="[^A-z]*{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="org_name">Entreprise</label>
                <input name="org_name" type="text" id="org_name" class="form-control" value="{{old('org_name') ?? $contactToEdit->organisation->nom}}" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" class="custom-select" id="statut">
                <option value="{{ old('statut') ??$contactToEdit->organisation->statut}}" selected>{{$contactToEdit->organisation->statut}}</option>
                  <option value="PROSPECT">PROSPECT</option>
                  <option value="CLIENT">CLIENT</option>
                  <option value="LEAD">LEAD</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <textarea name="adresse" class="form-control" id="adresse" rows="3" placeholder="{{old('adresse') ?? $contactToEdit->organisation->adresse}}" required >{{old('adresse') ?? $contactToEdit->organisation->adresse}}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="code_postal">Code Postal</label>
                <input name="code_postal" type="text" class="form-control" id="code_postal" value="{{ $contactToEdit->organisation->code_postal ??  old('code_postal') }}" placeholder="Code postal ?" />
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="ville">Ville</label>
                <input name="ville" type="text" class="form-control" id="ville" value="{{ $contactToEdit->organisation->ville  ?? old('ville') }}" placeholder="La ville ?" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Valider le changement</button>
</form>
</div>
@endsection
