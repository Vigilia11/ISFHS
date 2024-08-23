$(window).ready(function(){
    
    $(formDecline).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formDecline).attr('method'),
            url: $(formDecline).attr('action'),
            data: new FormData(formDecline),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                $('#modalDecline').modal('hide');
                $('div.account-status-display').text("Account Status: Declined");
            }
        })
    })
});
var account_id =$('#account_id').val();

function approve(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'account_id': $('#hidden_account_id').val(),
        'status': "Approved",
    }
    $.ajax({
        type: 'post',
        url: '/approveAccount',
        data: formData,
        dataType: 'json',
        success: function(response){
            //console.log(response.message);
            $('div.account-status-display').text("Account Status: Approved");
        }
    })
}

function decline(){
    var user_id=$('#hidden_user_id').val();
    var account_id=$('#hidden_account_id').val();
    $('#modalDecline').modal('show');

    $('#formDecline').find('#user_id').val(user_id);

    $('#formDecline').find('#account_id').val(account_id);
    
}

function block(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //alert($('#hidden_account_id').val());
    var formData ={
        'account_id': $('#hidden_account_id').val(),
        'status': "Blocked",
    }

    $.ajax({
        type: 'post',
        url: '/blockAccount',
        data: formData,
        dataType: 'json',
        success: function(response){
            console.log(response.message);
            $('#modalBlock').modal('hide');
            $('div.account-status-display').text("Account Status: Blocked");

        }
    })
}