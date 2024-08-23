$(window).ready(function(){

    fetchFacilities();

    function fetchFacilities(){
        $.ajax({
            type: 'get',
            url: '/fetchFacilities',
            processData: false,
            contentType: false,
            success: function(response){
                //console.log(response.facilities);

                $.each(response.facilities, function(key, facility){
                    $('div.facilities-container').append('\
                        <div class="col-md-3">\
                            <div class="w-100 rounded shadow overflow-hidden">\
                                <img src="/images/facility/'+ facility.facilityPicture +'" class="w-100 img-facility" alt="facility picture">\
                                <div class="p-2" style="color: #4b5563;line-height:1.4">\
                                    <label class="fw-bold text-black">'+ facility.facilityName +'</label><br>\
                                    '+ facility.facilityType +'\
                                    <div id="starRate">\
                                        <i class="'+key+'-star1"></i>\
                                        <i class="'+key+'-star2"></i>\
                                        <i class="'+key+'-star3"></i>\
                                        <i class="'+key+'-star4"></i>\
                                        <i class="'+key+'-star5"></i>\
                                        <span class="'+key+'-average-rate">Average Rate</span>\
                                    </div>\
                                    <a href="/viewFacility/'+ facility.facilityId +'">view</a>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    var r = facility.totalRate / facility.totalPerson;
                    var averageRate = (facility.totalRate / facility.totalPerson)+" reviews.";
                    $('.'+key+'-average-rate').text(averageRate);
                    //console.log(r);

                    if(r >= 1 && r < 2){
                        $('i.'+key+'-star1').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star2').addClass('fa-star fa-regular');
                        $('i.'+key+'-star3').addClass('fa-star fa-regular');
                        $('i.'+key+'-star4').addClass('fa-star fa-regular');
                        $('i.'+key+'-star5').addClass('fa-star fa-regular');
                    }
                    else if(r >= 2 && r < 3){
                        $('i.'+key+'-star1').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star2').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star3').addClass('fa-star fa-regular');
                        $('i.'+key+'-star4').addClass('fa-star fa-regular');
                        $('i.'+key+'-star5').addClass('fa-star fa-regular');
                    }
                    else if(r >= 3 && r < 4){
                        $('i.'+key+'-star1').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star2').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star3').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star4').addClass('fa-star fa-regular');
                        $('i.'+key+'-star5').addClass('fa-star fa-regular');
                    }
                    else if(r >= 4 && r < 5){
                        $('i.'+key+'-star1').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star2').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star3').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star4').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star5').addClass('fa-star fa-regular');
                    }
                    else if(r == 5){
                        $('i.'+key+'-star1').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star2').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star3').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star4').addClass('checked fa-solid fa-star');
                        $('i.'+key+'-star5').addClass('fa-star fa-solid checked');
                    }
                    else{
                        $('i.'+key+'-star1').removeClass('checked fa-regular');
                        $('i.'+key+'-star2').removeClass('checked fa-regular');
                        $('i.'+key+'-star3').removeClass('checked fa-regular');
                        $('i.'+key+'-star4').removeClass('checked fa-regular');
                        $('i.'+key+'-star5').removeClass('checked fa-regular');
                    }
                })
            }
        })
    }
})