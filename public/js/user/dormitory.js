$(window).ready(function(){
    fetchDormitory();

    function fetchDormitory(){
        $.ajax({
            type: 'get',
            url: '/fetchDormitory',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.dormitories);
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                    var star;

                    if(dormitory.avgRate >= 1 && dormitory.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 2 && dormitory.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 3 && dormitory.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 4 && dormitory.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate == 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }

                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
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

                //alert(response.dormitory);
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                    
                    var star;

                    if(dormitory.avgRate >= 1 && dormitory.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 2 && dormitory.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 3 && dormitory.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 4 && dormitory.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate == 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    });
})

//filter
function filterRates(evt){
    if (evt.target.value === "1 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch1starDormitory',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i> <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    }

    if (evt.target.value === "2 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch2starDormitory',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i> <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    }

    if (evt.target.value === "3 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch3starDormitory',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i> <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    }

    if (evt.target.value === "4 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch4starDormitory',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\ <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    }
    if (evt.target.value === "5 star") {
        
        $.ajax({
            type: 'get',
            url: '/fetch5starDormitory',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\ <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })
            }
        })
    }
}

function filterDate(evt){
    if (evt.target.value === "Ascending") {
        
        $.ajax({
            type: 'get',
            url: '/fetchDormitoryDateAscending',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                    var star;

                    if(dormitory.avgRate >= 1 && dormitory.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 2 && dormitory.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 3 && dormitory.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 4 && dormitory.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate == 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })

            }
        })
    }
    if (evt.target.value === "Descending") {
        $.ajax({
            type: 'get',
            url: '/fetchDormitoryDateDescending',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.dormitories, function(key,dormitory){
                    var star;

                    if(dormitory.avgRate >= 1 && dormitory.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 2 && dormitory.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 3 && dormitory.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate >= 4 && dormitory.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(dormitory.avgRate == 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ dormitory.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ dormitory.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ dormitory.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })

            }
        })
    }
}