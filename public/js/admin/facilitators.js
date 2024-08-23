$(window).ready(function(){

    fetchFacilitators();

    function fetchFacilitators(){
        $.ajax({
            type: 'get',
            url: '/fetchFacilitators',
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response.facilitators);
                $.each(response.facilitators, function(key, facilitator){
                    $('#facilitators').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="" style="text-decoration:none;">\
                            <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                <div class="w-100 d-flex justify-content-center">\
                                    <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                        <img src="/images/user/'+ facilitator.picture +'" class="w-100 h-100" alt="">\
                                    </div>\
                                </div>\
                                <div class="w-100 text-center mt-2" style="color:#374151;">\
                                    <b>'+ facilitator.first_name +' '+ facilitator.last_name +'</b> <br>\
                                    <span style="color:#6b7280;">'+ facilitator.status +'</span>\
                                </div>\
                            </div>\
                            </a>\
                        </div>\
                    ');
                })
            }
        })
    }
})