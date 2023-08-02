<script>
    toastr.options.timeOut = 30000;
    @if(Session::has('success'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.success('{{ Session::get('success') }}');

    @elseif(Session::has('deleted'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.warning('{{ Session::get('deleted') }}');

    @elseif(Session::has('failed_on_creation_confirm'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.danger('{{ Session::get('failed_on_creation_confirm') }}');

    @elseif(Session::has('not_deleted'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.error('{{ Session::get('not_deleted') }}');

    @elseif(Session::has('not_updated'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.danger('{{ Session::get('not_updated') }}');

    @elseif(Session::has('updated'))
    toastr.options = {
    "closeButton" : true,
    "progressBar" : true,
    };
    toastr.info('{{ Session::get('updated') }}');

    @endif

    // Double of contact
    @if(Session::has('failed_on_creation_contact'))
        Swal.fire({
        title: 'Doublon !',
        html: '<h5>Un contact existe déjà avec le même prénom et le même nom. Ëtes-vous sûr de vouloir ajouter ce contact ?</h5>',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Oui',
        denyButtonText: `Non`,
        }).then((result) => {
        if (result.isConfirmed) {
            var nom = "{{ Session::get('nom') }}";
            var prenom = "{{ Session::get('prenom') }}";
            var email = "{{ Session::get('email') }}";
            var telephone_fixe = "{{Session::get('telephone_fixe')}}";
            var fonction = "{{Session::get('fonction')}}";
            var service = "{{Session::get('service')}}";
            var org_name = "{{Session::get('org_name')}}";
            var adresse = "{{Session::get('adresse')}}";
            var code_postal = "{{Session::get('code_postal')}}";
            var ville = "{{Session::get('ville')}}";
            var statut = "{{Session::get('statut')}}";
            var url = '{{ URL::to("/add_contact_action_on_confirm") }}/'+nom+'/'+prenom+'/'+email+'/'+telephone_fixe+'/'+fonction+'/'+service+'/'+org_name+'/'+adresse+'/'+code_postal+'/'+ville+'/'+statut;
            $.ajax({
            type:'GET',
            url: url,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:() => {
                Swal.fire('Le contact | ' +nom+ ' | bien ajouté !', '', 'success').then(() => {
                location.reload();
                });
            },
            });
        } else if (result.isDenied) {
            Swal.fire('L\ajout du contact est annulé !', '', 'info').then(() =>{
                location.href = "/add_contact";
            });
        }
        });
    @endif

    // Double of org
    @if(Session::has('failed_on_creation_org'))
        Swal.fire({
        title: 'Doublon !',
        html: '<h5>Une entreprise existe déjà avec le même nom ! </h5>',
        showDenyButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        denyButtonText: `Retourner`,
        }).then((result) => {
        if (result.isDenied) {
            location.href = "/add_contact";
        }
        });
    @endif

    // Double of org & contact in the same form
    @if(Session::has('failed_on_creation_contact_org'))
        Swal.fire({
        title: 'Doublon !',
        html: '<h5>Une entreprise existe déjà avec le même nom ! Le Nom ou le Prénom du contact déjà existe !</h5>',
        showDenyButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        denyButtonText: `Retourner`,
        }).then((result) => {
        if (result.isDenied) {
            location.href = "/add_contact";
        }
        });
    @endif

    // Double of contact in edition
    @if(Session::has('failed_on_edit_contact'))
        Swal.fire({
            title: 'Doublon !',
            html: '<h5>Le Nom ou le Prénom du contact déjà existe !</h5>',
            showDenyButton: false,
            showCancelButton: false,
            showConfirmButton: true,
        });
    @endif

    @if($errors->any())
        @foreach($errors->all() as $err)
            Swal.fire({
            icon: 'error',
            text: '{{ $err }}',
            });
        @endforeach
    @endif

</script>
