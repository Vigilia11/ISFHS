$(window).ready(function(){
    fetchCanteen();

    function fetchCanteen(){
        $.ajax({
            type: 'get',
            url: '/fetchCanteen',
            contentType: false,
            processData: false,
            success: function(response){
                //console.log(response.dormitories);
                $("#facilities").html('');
                
                $.each(response.canteens, function(key,canteen){
                    let star;

                    if(canteen.avgRate >= 1 && canteen.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 2 && canteen.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 3 && canteen.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 4 && canteen.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate == 5)
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
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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

                //alert(response.canteens);
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                    
                    let star;

                    if(canteen.avgRate >= 1 && canteen.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 2 && canteen.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 3 && canteen.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 4 && canteen.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate == 5)
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
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetch1starCanteen',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i> <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetch2starCanteen',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\ <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetch3starCanteen',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\ <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetch4starCanteen',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                            <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\ <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetch5starCanteen',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                                        
                    $("#facilities").append('\
                        <div class="col-md-2">\
                        <div class="w-100 bg-white overflow-hidden shadow rounded">\
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\
                                    <i class="fa fa-star checked" aria-hidden="true"></i>\  <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetchCanteenDateAscending',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                    let star;

                    if(canteen.avgRate >= 1 && canteen.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 2 && canteen.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 3 && canteen.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 4 && canteen.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate == 5)
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
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
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
            url: '/fetchCanteenDateDescending',            
            success: function(response){
                
                $("#facilities").html('');
                $.each(response.canteens, function(key,canteen){
                    let star;

                    if(canteen.avgRate >= 1 && canteen.avgRate < 2)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 2 && canteen.avgRate < 3)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 3 && canteen.avgRate < 4)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate >= 4 && canteen.avgRate < 5)
                    {
                        star = '<i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>\
                                <i class="fa fa-star checked" aria-hidden="true"></i>';
                    }
                    if(canteen.avgRate == 5)
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
                                <img src="/images/facility/'+ canteen.facilityPicture +'" alt="" class="facility w-100">\
                                <div class="w-100 facility-content p-2">\
                                    <b>'+ canteen.facilityName +' </b><br>\
                                    '+ star +' <br>\
                                    <a href="/viewDormitory/'+ canteen.facilityId +'" class="nav-link view-details"><small>View Details</a></small>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                })

            }
        })
    }
}