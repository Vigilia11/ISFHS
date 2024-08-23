$(window).ready(function(){
    fetchAllFacilities();

    function fetchAllFacilities(){
        let facilityType = $('#facilityType').val();

        $.ajax({
            type:'get',
            url: '/fetchAllFacilities/' +  facilityType,
            success: function(response){
                //console.log(response.facilities);
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>\
                    ');
                })
            }
        })
    }

    $(formSearch).on('submit', function(e){
        e.preventDefault();

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formSearch).attr('method'),
            url: $(formSearch).attr('action'),
            data: new FormData(formSearch),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                });
            }
        })
    })
})

function filterFacilityStatus(evt){
    let facilityType = $('#facilityType').val();

    if (evt.target.value === "Pending") {
        
        $.ajax({
            type: 'get',
            url: '/fetchPendingFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "Approved") {
        
        $.ajax({
            type: 'get',
            url: '/fetchApprovedFacilities/'+ facilityType,            
            success: function(response){
                //console.log(response.facilities)
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "Declined") {
        
        $.ajax({
            type: 'get',
            url: '/fetchDeclinedFacilities/'+ facilityType,            
            success: function(response){
                //console.log(response.facilities)
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "Blocked") {
        
        $.ajax({
            type: 'get',
            url: '/fetchBlockedFacilities/'+ facilityType,            
            success: function(response){
                //console.log(response.facilities)
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "All") {
        
        $.ajax({
            type:'get',
            url: '/fetchAllFacilities/' +  facilityType,
            success: function(response){
                //console.log(response.facilities);
                $('#facilities').html('');
                $.each(response.facilities, function(key, facility){

                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }
    
}

function filterRates(evt){
    let facilityType = $('#facilityType').val();

    if (evt.target.value === "1 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch1starFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                        </div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "2 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch2starFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                        </div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "3 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch3starFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                        </div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "4 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch4starFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star" aria-hidden="true"></i>\
                                        </div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }

    if (evt.target.value === "5 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch5starFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                            <i class="fa fa-star checked" aria-hidden="true"></i>\
                                        </div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }
}

function filterDate(evt){
    let facilityType = $('#facilityType').val();

    if (evt.target.value === "Ascending") {
        $.ajax({
            type: 'get',
            url: '/fetchFacilitiesDateAscending/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })

            }
        })
    }

    if (evt.target.value === "Descending") {
        
        $.ajax({
            type: 'get',
            url: '/fetchAllFacilities/'+ facilityType,            
            success: function(response){
                
                $('#facilities').html('');

                $.each(response.facilities, function(key, facility){
                    var averageRate = facility.totalRate / facility.totalPerson;                    
                    
                    var rate;
                    if(averageRate >= 1 && averageRate < 2)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 2 && averageRate < 3)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 3 && averageRate < 4)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate >= 4 && averageRate < 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    else if(averageRate == 5)
                    {
                        rate = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    else
                    {
                        rate = '<i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>\
                                <i class="fa fa-star" aria-hidden="true"></i>';
                    }

                    $('#facilities').append('\
                        <div class="col-md-2">\
                            <a href="/viewFacility/'+ facility.facilityId +'" class="w-100">\
                                <div class="w-100 facility-card bg-white shadow py-2">\
                                    <div class="row mb-2 px-2">\
                                        <div class="col-md-1">\
                                            <img src="/images/user/'+ facility.profilePicture +'" alt="" class="img-profile-facilitator">\
                                        </div>\
                                        <div class="col-md-10 name">\
                                            <span class="fw-bold">'+ facility.firstName +' '+ facility.lastName +'</span>\
                                        </div>\
                                    </div>\
                                    <div class="px-2 w-100">\
                                        <img src="/images/facility/'+ facility.facilityPicture +'" alt="" class="w-100 img-facility rounded">\
                                    </div>\
                                    <div class="p-2 w-100">\
                                        <span class="fw-bold">'+ facility.facilityName +'</span>\
                                        <div class="w-100">'+ rate +'</div>\
                                        <span>'+ facility.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })

            }
        })
    }
}