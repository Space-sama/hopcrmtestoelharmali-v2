<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index() {
        $orgs = Organisation::all();
        $contacts = Contact::with('organisation')->get();
        return view('home', compact('contacts', 'orgs'));
    }

    // get Contact creation page
    public function createOneContact() {
        $orgs = Organisation::all();
        return view('contacts.create', compact('orgs'));
    }

    // Create duplicate contact after confirming by YES
    public function createOnConfirm($nom, $prenom, $email, $telephone_fixe, $fonction, $service, $org_name, $adresse, $code_postal, $ville, $statut){
        $randomString_contact = Str::random(30);
        $randomString_org = Str::random(30);
        $orgToCreate = Organisation::create(array_merge(
        [
            'nom' => $org_name,
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'ville' => $ville,
            'cle' => $randomString_org,
            'statut' => $statut,
        ]));
        $contactToCreate = Contact::create(array_merge(
        [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => Str::lower($email),
            'telephone_fixe' => $telephone_fixe,
            'fonction' => $fonction,
            'service' => $service,
            'organisation_id' => $orgToCreate->id,
            'cle' => $randomString_contact
        ]));
        // dd($contactToCreate);
        if($contactToCreate){
            // Forget sessions
            Session::forget('nom');
            Session::forget('prenom');
            Session::forget('email');
            Session::forget('telephone_fixe');
            Session::forget('service');
            Session::forget('fonction');
            Session::forget('org_name');
            Session::forget('adresse');
            Session::forget('code_postal');
            Session::forget('ville');
            Session::forget('statut');
            Session::forget('correction');
            return back()->with('success', 'Le contact à été bien ajouté');
        }else{
            return redirect('/')->with('failed_on_creation_confirm', 'Un problème est survenu lors du traitement, merci de ressayez !');
        }

    }
    // Create new contact
    public function createOneContactAction(Request $request){
        $request->validate([
            'nom' => 'required|min:4',
            'prenom' => 'required|min:4',
            'email' => 'email:rfc,dns',
            'telephone_fixe' => 'required|regex:/[0-9]{9}/',
            'fonction' => 'required|min:4',
            'service' => 'required|min:4',
            'org_name' => 'required|min:4',
            'adresse' => 'required|min:10',
            'code_postal' => 'required|numeric',
            'ville' => 'required|min:4',
        ],
        [


            'nom.min' => 'Le champ Nom doit avoir quatre caractères au minimum !',
            'nom.required' => 'Le champ Nom est obligatoire !',

            'prenom.required' => 'Le champ Prénom est obligatoire !',
            'prenom.min' => 'Le champ Prénom doit avoir quatre caractères au minimum !',

            'email.email' => 'Veuillez saisir un valide E-mail !',

            'telephone_fixe.required' => 'Le champ Téléphone est obligatoire !',
            'telephone_fixe.regex' => 'Veuillez saisissez un numéro valide !',

            'fonction.required' => 'Le champ Fonction est obligatoire !',
            'fonction.min' => 'Le champ Fonction doit avoir quatre caractères au minimum !',

            'ville.required' => 'Le champ Ville est obligatoire !',
            'ville.min' => 'Le champ Ville doit avoir quatre caractères au minimum !',

            'code_postal.required' => 'Le champ Code Postal est obligatoire !',
            'code_postal.numeric' => 'Le champ Code Postal doit être au format numérique !',

            'adresse.required' => 'Le champ Adresse est obligatoire !',
            'adresse.min' => 'Le champ Adresse doit avoir 10 caractères au minimum !',

            'org_name.required' => 'Le champ Entreprise est obligatoire !',
            'org_name.min' => 'Le champ Entreprise doit avoir quatre caractères au minimum !',

            'service.required' => 'Le champ Service est obligatoire !',
            'service.min' => 'Le champ Service doit avoir quatre caractères au minimum !',
        ],
    );
        $data = $request->all();
        $if_exist_fname = Contact::where('nom', $data['nom'])
        ->where('prenom', $data['prenom'])->first();
        $if_exist_organiastion = Organisation::where('nom', $data['org_name'])->first();
        // dd($if_exist_organiastion);
        // dd($if_exist_fname);
        if(!$if_exist_fname && !$if_exist_organiastion){
            // Forget sessions
            Session::forget('nom');
            Session::forget('prenom');
            Session::forget('email');
            Session::forget('telephone_fixe');
            Session::forget('service');
            Session::forget('fonction');
            Session::forget('org_name');
            Session::forget('adresse');
            Session::forget('code_postal');
            Session::forget('ville');
            Session::forget('statut');
            Session::forget('correction');
            $randomString_contact = Str::random(30);
            $randomString_org = Str::random(30);
            $org = Organisation::create(array_merge([
                'cle' => $randomString_org,
                'nom' => $data['org_name'],
                'adresse' => $data['adresse'],
                'code_postal' => $data['code_postal'],
                'ville' => $data['ville'],
                'statut' => $data['statut'],
            ]));
            Contact::create(array_merge([
                'cle' => $randomString_contact,
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => Str::lower($data['email']),
                'telephone_fixe' => $data['telephone_fixe'],
                'service' => $data['service'],
                'fonction' => $data['fonction'],
                'organisation_id' => $org->id,
            ]));

            return redirect('/')->with('success', 'Le contact à été bien ajouté');
        }
        // case : if organisation already exists.
        if(!$if_exist_fname && $if_exist_organiastion){
            // Push new sessions
            Session::put('nom', $data['nom']);
            Session::put('prenom', $data['prenom']);
            Session::put('email', $data['email']);
            Session::put('telephone_fixe', $data['telephone_fixe']);
            Session::put('fonction', $data['fonction']);
            Session::put('service', $data['service']);
            Session::put('org_name', $data['org_name']);
            Session::put('adresse', $data['adresse']);
            Session::put('code_postal', $data['code_postal']);
            Session::put('ville', $data['ville']);
            Session::put('statut', $data['statut']);
            Session::put('correction', 'Cette entreprise déjà existe, veuillez saisir une entreprise unique.');
            return redirect('/')->with('failed_on_creation_org', 'Une entreprise existe déjà avec le même nom');
        }
        // case : if contact already exists.
        if($if_exist_fname && !$if_exist_organiastion){
            // Push new sessions
            Session::put('nom', $data['nom']);
            Session::put('prenom', $data['prenom']);
            Session::put('email', $data['email']);
            Session::put('telephone_fixe', $data['telephone_fixe']);
            Session::put('fonction', $data['fonction']);
            Session::put('service', $data['service']);
            Session::put('org_name', $data['org_name']);
            Session::put('adresse', $data['adresse']);
            Session::put('code_postal', $data['code_postal']);
            Session::put('ville', $data['ville']);
            Session::put('statut', $data['statut']);
            Session::put('correction', 'Veuillez entrez un nom et un prènom unique.');
            return redirect('/')->with('failed_on_creation_contact', 'Un contact existe déjà avec le même prénom et le même nom / org');
        }

    }

    // Rendering to the contact edit page
    public function editContact($contact) {
        $orgs = Organisation::all();
        $contactToEdit = contact::find($contact);
        return view('contacts.edit', compact('contactToEdit', 'orgs'));
    }

    // Update a contact
    public function editOneContactAction(Request $request, $contact) {
        $request->validate([
            'nom' => 'required|min:4',
            'prenom' => 'required|min:4',
            'email' => 'email:rfc,dns',
            'telephone_fixe' => 'required|regex:/[0-9]{9}/',
            'fonction' => 'required|min:4',
            'service' => 'required|min:4',

        ],
        [
            'nom.min' => 'Le champ Nom doit avoir quatre caractères au minimum !',
            'nom.required' => 'Le champ Nom est obligatoire !',

            'prenom.required' => 'Le champ Prénom est obligatoire !',
            'prenom.min' => 'Le champ Prénom doit avoir quatre caractères au minimum !',

            'email.email' => 'Veuillez saisir un valide E-mail !',

            'telephone_fixe.required' => 'Le champ Téléphone est obligatoire !',
            'telephone_fixe.regex' => 'Veuillez saisissez un numéro valide !',

            'fonction.required' => 'Le champ Fonction est obligatoire !',
            'fonction.min' => 'Le champ Fonction doit avoir quatre caractères au minimum !',

            'service.required' => 'Le champ Service est obligatoire !',
            'service.min' => 'Le champ Service doit avoir quatre caractères au minimum !',
        ],
    );
        $data = $request->all();
        $contact = Contact::find($contact);
        $contact->nom = $data['nom'];
        $contact->prenom = $data['prenom'];
        $contact->email = $data['email'];
        $contact->telephone_fixe = $data['telephone_fixe'];
        $contact->fonction = $data['fonction'];
        $contact->service = $data['service'];
        // $contact->organisation_id = $data['organisation_id'];
        if(!$contact){
            return back()->with('not_updated', 'Un problème est survenu lors du traitement, merci de ressayez !');
        }else{
            $contact->save();
            return redirect('/')->with('updated', 'Le contact à été bien modifié');
        }
    }


    // Get infos of desired contact to edit on the pop up
    public function edit_data($contact, $org) {
        $contactToFind = Contact::find($contact);
        $orga = Organisation::find($org);

        return response()->json([
            'status'=> 200,
            'contact' => $contactToFind,
            'org' => $orga,
        ]);
    }

    // Edit one contact with his organisation
    public function editDataModal(Request $request, $contact, $org) {
        $contactToFind = Contact::find($contact);
        $orga = Organisation::find($org);
        $data = $request->all();
        $contactToFind->nom = $data['nom'];
        $contactToFind->prenom = $data['prenom'];
        $contactToFind->email = $data['email'];
        // $contactToFind->organisation_id = $data['organisation_id'];
        $orga->adresse = $data['adresse'];
        $orga->code_postal = $data['code_postal'];
        $orga->ville = $data['ville'];
        $orga->statut = $data['statut'];

        if($contactToFind && $orga){
            $contactToFind->save();
            $orga->save();
            return back()->with('updated', 'Le contact à été bien modifié');

        }else{
            return back()->with('not_updated', 'Un problème est survenu lors du traitement, merci de ressayez !');
        }

    }

    // Display all data of contacts
    public function showContact($contact) {
        $orgs = Organisation::all();
        $contactToShow = contact::find($contact);
        return view('welcome', compact('contactToShow', 'orgs'));
    }

    // Delete one contact
    public function deleteContact($contact){
        $contactToDelete = Contact::find($contact)->delete();
        // dd($contactToDelete);
        if(!$contactToDelete){
            return back()->with('not_deleted', 'Un problème est survenu lors du traitement, merci de ressayez plus tard');
        }else{
            return back()->with('deleted', 'Le contact à été bien résilié');
        }
    }


}
