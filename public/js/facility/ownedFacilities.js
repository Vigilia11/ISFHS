$(document).ready(function(){
    fetchOwnedFacility();

    function fetchOwnedFacility(){
        $.ajax({
            type: 'get',
            url: '/fetchOwnedFacilities',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.facility);
                $('#facility').html('');
                $.each(response.facility, function(key, facility){
                    $('#facility').append('\
                    <div class="col-md-6 p-3">\
                        <div class="facility-card w-100 bg-white shadow" style="border:1px solid #e5e7eb">\
                            <div class="row h-100">\
                                <div class="col-md-6 h-100">\
                                    <img src="/images/facility/'+ facility.facility_picture +'" class="h-100 w-100" alt="facility picture">\
                                </div>\
                                <div class="col-md-6 p-3 position-relative">\
                                    <h3>'+ facility.name +'</h3>\
                                    <h5>'+ facility.first_name +' '+ facility.last_name +'</h5>\
                                    '+ facility.mobile_number +'<br>\
                                    '+ facility.street +', '+ facility.barangay +'<br>\
                                    '+ facility.city +', '+ facility.province +'<br>\
                                    <div class="position-absolute bottom-0 end-0 mx-4 my-3">\
                                        <a href="/view/facility/'+ facility.id +'" class="text-blue-500 fw-bold" style="cursor:pointer">View</a>\
                                        <span class="text-red-500 fw-bold ms-3" style="cursor:pointer" onclick="deleteFacility('+ facility.id +')">Delete</span>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ');
                });
                
            }
        })
    }

    $(document).on('click', '#ModalDeleteButtonYes', function(e){
        e.preventDefault();
        var fid = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: 'delete',
            url: '/deleteFacility/'+ fid,
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.message);
                
                $('#ModalDelete').modal('hide');
                fetchOwnedFacility();
                $('#toast').show().delay(5000).fadeOut();
                $('.toast-body').text(response.message);
                
            }
        });
    })

    
});

function deleteFacility(fid){
    $('#ModalDelete').modal('show');
    $('#ModalDeleteButtonYes').val(fid);
}