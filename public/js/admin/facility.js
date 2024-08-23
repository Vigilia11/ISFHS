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
                $('#modalDecline').modal('hide');
                $('div.facility-status').text("Declined");
                //console.log(response.message);
            }
        })
    })
    
})

function approve(){
    let fid = $('#hidden_facility_id').val();

    var formData ={
        'facility_id': $('#hidden_facility_id').val(),
        'status': "Approved",
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'put',
        url: '/updateFacilityStatus/'+ fid,
        data: formData,
        dataType: 'json',
        success: function(response){
            $('div.facility-status').text("Approved");
            //console.log(response.message);
        }
    })
}
function decline(){
    $('#formDecline').find('#user_id').val($('#hidden_user_id').val());
    $('#formDecline').find('#facility_id').val($('#hidden_facility_id').val());
    $('#modalDecline').modal('show');
}

function block(){
    let fid = $('#hidden_facility_id').val();

    var formData ={
        'facility_id': $('#hidden_facility_id').val(),
        'status': "Blocked",
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'put',
        url: '/updateFacilityStatus/'+fid,
        data: formData,
        dataType: 'json',
        success: function(response){
            $('#modalBlock').modal('hide');
            $('div.facility-status').text("Blocked");
            //console.log(response.message);
        }
    })
}