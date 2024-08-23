$(window).ready(function(){
    fetchOwnedAccount();

    function fetchOwnedAccount(){
        $('label.account-status').text('');
        $('img.profile-picture').attr('src', '');
        $('label.name').text('');
        $('label.email').text('');
        $('div.biodata').html('');
        $('a.front-id-link').attr('href', '');
        $('a.back-id-link').attr('href', '');
        $('img.front-id').attr('src', '');
        $('img.back-id').attr('src', '');

        $.ajax({
            type: 'get',
            url: '/fetchOwnedAccount',
            success: function(response){
                $.each(response.account, function(key, item){
                    $('label.account-status').text(item.account_status);
                    $('img.profile-picture').attr('src', '/images/user/'+item.profile_picture);
                    $('label.name').text(item.first_name + " " + item.last_name);
                    $('label.email').text(item.email);
                    $('div.biodata').html('\
                        '+ item.mobile_number +' <br>\
                        '+ item.sex +' <br>\
                        '+ item.birthdate +' <br>\
                        '+ item.barangay +', '+ item.city +', '+ item.province +'\
                    ');
                    $('a.front-id-link').attr('href', '/images/id/'+item.front_id);
                    $('a.back-id-link').attr('href', '/images/id/'+item.back_id);
                    $('img.front-id').attr('src', '/images/id/'+item.front_id);
                    $('img.back-id').attr('src', '/images/id/'+item.back_id);

                    $('#formEditProfileInfo').find('#first_name').val(item.first_name);
                    $('#formEditProfileInfo').find('#last_name').val(item.last_name);
                    $('#formEditProfileInfo').find('#mobile_number').val(item.mobile_number);
                    $('#formEditProfileInfo').find('#birthdate').val(item.birthdate);
                    $('#formEditProfileInfo').find('#barangay').val(item.barangay);
                    $('#formEditProfileInfo').find('#city').val(item.city);
                    $('#formEditProfileInfo').find('#province').val(item.province);
                    
                    if(item.sex == "Male")
                    {
                        $('#formEditProfileInfo').find('#male').prop('checked',true);
                    }
                    if(item.sex == "Female")
                    {
                        $('#formEditProfileInfo').find('#female').prop('checked',true);
                    }
                    
                    
                });
            }
        })
    }

    $(updateProfilePicture).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(updateProfilePicture).attr('method'),
            url: $(updateProfilePicture).attr('action'),
            data: new FormData(updateProfilePicture),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(reponse.errors, function(name, error){
                        $('#updateProfilePicture').find('span.'+name+'_error').text(error);
                    })
                }
                else
                {
                    $('#updateProfilePicture').find('img.profile-picture-preview').attr('src', '');
                    $('#updateProfilePicture').find('span.error').text('');
                    $('#updateProfilePicture').find('#profile_picture').val('');
                    $('#modalProfilePicture').modal('hide');
                    fetchOwnedAccount();
                }
                
            }
        })
    });

    $(formEditProfileInfo).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formEditProfileInfo).attr('method'),
            url: $(formEditProfileInfo).attr('action'),
            data: new FormData(formEditProfileInfo),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        console.log(error)
                        $('#formEditProfileInfo').find('span.err_'+name+'').text(error);
                    })
                }
                else
                {
                    //$('#formEditProfileInfo').find('input').val('');
                    $('#formEditProfileInfo').find('span.error').text('');
                    $('#modalEditProfileInfo').modal('hide');
                    fetchOwnedAccount();
                }
                
            }
        })
    });

    $(updateId).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(updateId).attr('method'),
            url: $(updateId).attr('action'),
            data: new FormData(updateId),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(reponse.errors, function(name, error){
                        $('#updateId').find('span.'+name+'_error').text(error);
                    })
                }
                else
                {
                    $('#updateId').find('img.front-id-preview').attr('src', '');
                    $('#updateId').find('img.back-id-preview').attr('src', '');
                    $('#updateId').find('span.error').text('');
                    $('#updateId').find('#front_id').val('');
                    $('#updateId').find('#back_id').val('');
                    $('#modalChangeId').modal('hide');
                    fetchOwnedAccount();
                }
                
            }
        })
    })
})

profile_picture.onchange = evt => {
    const [file] = profile_picture.files
    if (file) {
        profile_picture_preview.src = URL.createObjectURL(file)
        //$('#img_add_preview').show();
    }
}

front_id.onchange = evt => {
    const [file] = front_id.files
    if (file) {
        front_id_preview.src = URL.createObjectURL(file)
        $('#img_add_preview').show();
    }
}
back_id.onchange = evt => {
    const [file] = back_id.files
    if (file) {
        back_id_preview.src = URL.createObjectURL(file)
        $('#img_add_preview').show();
    }
}