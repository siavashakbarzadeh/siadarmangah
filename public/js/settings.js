//STUDY GROUPS
$("#add_study_group").on('click',function(e){
    e.preventDefault();
    let study_group = $("[name='study_group']").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/study-group/settings/add/",
        type:"POST",
        data:{
            study_group:study_group
        },
        success:function(response){
            if(response == 1){
                location.reload();
            }
        },
        error: function(response) {

        },
    });
});

$(".delete_study_group").on('click',function(e){
    e.preventDefault();
    let study_group_id = $(this).data("id");
    Swal.fire({
        title: 'Confermi di voler eliminare questo gruppo di studio?',
        showDenyButton: true,
        confirmButtonText: 'Conferma',
        denyButtonText: `Annulla`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/study-group/settings/delete/",
                type:"POST",
                data:{
                    study_group_id:study_group_id
                },
                success:function(response){
                    if(response == 1){
                        location.reload();
                    }
                },
                error: function(response) {

                },
            });
        } else if (result.isDenied) {
            Swal.fire('Operazione annullata', '', 'info')
        }
    })
});


//REGIONS
$("#add_region").on('click',function(e){
    e.preventDefault();
    let region = $("[name='region']").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/region/add/",
        type:"POST",
        data:{
            region:region
        },
        success:function(response){
            if(response == 1){
                location.reload();
            }
        },
        error: function(response) {

        },
    });
});

$(".delete_region").on('click',function(e){
    e.preventDefault();
    let region_id = $(this).data("id");
    Swal.fire({
        title: 'Confermi di voler eliminare questa regione?',
        showDenyButton: true,
        confirmButtonText: 'Conferma',
        denyButtonText: `Annulla`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/region/delete/",
                type:"POST",
                data:{
                    region_id:region_id
                },
                success:function(response){
                    if(response == 1){
                        location.reload();
                    }
                },
                error: function(response) {

                },
            });
        } else if (result.isDenied) {
            Swal.fire('Operazione annullata', '', 'info')
        }
    })
});



$("#add_role").on('click',function(e){
    e.preventDefault();
    let user_id = $("#user").val();
    let role = $("#role").val();
    Swal.fire({
        title: 'Vuoi assegnare un nuovo ruolo a questo utente?',
        showDenyButton: true,
        confirmButtonText: 'Conferma',
        denyButtonText: `Annulla`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/role/add/",
                type:"POST",
                data:{
                    user_id:user_id,
                    role:role
                },
                success:function(response){
                    if(response.id == user_id){
                        Swal.fire('Ruolo aggiunto con successo')
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Non è stato possibile aggiungere il ruolo a questo utente'
                        })
                    }
                },
                error: function(response) {

                },
            });
        } else if (result.isDenied) {
            Swal.fire('Operazione annullata', '', 'info')
        }
    })
});



$("#add_user").on('click',function(e){
    e.preventDefault();
    let user_name = $("#user_name").val();
    let user_surname = $("#user_surname").val();
    let user_email = $("#user_email").val();
    let user_password = $("#user_password").val();
    Swal.fire({
        title: 'Vuoi aggiungere un nuovo utente?',
        showDenyButton: true,
        confirmButtonText: 'Conferma',
        denyButtonText: `Annulla`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/user/add/",
                type:"POST",
                data:{
                    user_name:user_name,
                    user_surname:user_surname,
                    email:user_email,
                    user_password:user_password
                },
                success:function(response){
                    if(response.email == user_email){
                        Swal.fire('Utente aggiunto con successo')
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.email
                        })
                    }
                },
                error: function(response) {

                },
            });
        } else if (result.isDenied) {
            Swal.fire('Operazione annullata', '', 'info')
        }
    })
});
