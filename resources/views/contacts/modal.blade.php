<div class="modal fade" id="exampleModal{{$c->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Détails du contact</h5>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/edit_data_modal/'.$c->id.'/'.$c->organisation->id) }}" method="post" data-parsley-validate id="form">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" name="id" id="id" />
                <div class="row mb-2">
                  <div class="col">
                    <label for="prénom">Prénom</label>
                    <input name="prenom" type="text" id="prenom" class="form-control" value="{{$c->prenom}}" placeholder="{{$c->prenom}}" pattern="[A-z]{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
                  </div>
                  <div class="col">
                    <label for="nom">Nom</label>
                    <input name="nom" type="text" id="nom" class="form-control" value="{{$c->nom}}" placeholder="{{$c->nom}}" pattern="[A-z]{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
                  </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                      <label for="email">E-mail</label>
                      <input name="email" type="email" id="email" class="form-control" value="{{$c->email}}" placeholder="{{$c->email}}" data-parsley-error-message="Veuillez saisir un valid E-mail !" required />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                      <label for="organisation_id">Entreprise</label>
                      <input name="organisation_id" type="text" id="email" class="form-control" value="{{$c->organisation->nom}}" disabled required />
                    </div>
                </div>
                {{-- <div class="row mb-2">
                    <div class="col">
                      <label for="entreprise">Entreprise</label>
                      <select name="organisation_id" class="custom-select" id="org">
                        <option value="{{$c->organisation->id}}" selected>{{$c->organisation->nom}}</option>
                        @foreach($orgs as $o)
                            <option value="{{$o->id}}">{{$o->nom}}</option>
                        @endforeach
                    </select>
                    </div>
                </div> --}}
                <div class="row mb-2">
                    <div class="col">
                      <label for="adresse">Adresse</label>
                      <textarea name="adresse" class="form-control" id="adresse" rows="3" placeholder="{{$c->organisation->adresse}}" required data-parsley-error-message="Ce champ est obligatoire !">{{$c->organisation->adresse}}</textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                      <label for="code">Code postal</label>
                      <input name="code_postal" type="text" id="code" class="form-control" value="{{$c->organisation->code_postal}}" placeholder="{{$c->organisation->code_postal}}" pattern="[0-9]+" data-parsley-error-message="Veuillez saisir un code postal valide !" required />
                    </div>
                    <div class="col">
                        <label for="ville">La ville</label>
                        <input name="ville" type="text" id="ville" class="form-control" value="{{$c->organisation->ville}}" placeholder="{{$c->organisation->ville}}" pattern="[A-z]{1,20}" data-parsley-error-message="Ce champ est obligatoire !" required />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8">
                      <label for="statut">Statut</label>
                      <select name="statut" class="custom-select" id="statut">
                        <option value="{{$c->organisation->statut}}" selected>{{$c->organisation->statut}}</option>
                        <option value="CLIENT">CLIENT</option>
                        <option value="LEAD">LEAD</option>
                        <option value="PROSPECT">PROSPECT</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
