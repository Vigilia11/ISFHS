$(window).ready(function(){
    
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
                
                $('#users').html('');
                
                console.log(response.users);
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>\
                    ');
                })
            } 
        })
    })
})

function filter(evt){
    var user ={
        'userType': $('#userType').val(),
    }

    if (evt.target.value === "Pending") {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/fetchPendingAccount',
            data: user,
            dataType: 'json',
            success: function(response){
                
                $('#users').html('');
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/fetchApprovedAccount',
            data: user,
            dataType: 'json',
            success: function(response){
                //console.log(response.users)
                 $('#users').html('');
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/fetchDeclinedAccount',
            data: user,
            dataType: 'json',
            success: function(response){
                //console.log(response.users)
                $('#users').html('');
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/fetchBlockedAccount',
            data: user,
            dataType: 'json',
            success: function(response){
                //console.log(response.users)
                $('#users').html('');
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/fetchAllAccount',
            data: user,
            dataType: 'json',
            success: function(response){
                //console.log(response.users)
                $('#users').html('');
                $.each(response.users, function(key, user){
                    $('#users').append('\
                        <div class="col-md-3 p-2" style="height:260px">\
                            <a href="/viewFacilitator/'+ user.id +'" style="text-decoration:none;">\
                                <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">\
                                    <div class="w-100 d-flex justify-content-center">\
                                        <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">\
                                            <img src="images/user/'+ user.picture +'" class="w-100 h-100" alt="">\
                                        </div>\
                                    </div>\
                                    <div class="w-100 text-center mt-2" style="color:#374151;">\
                                        <b>'+ user.first_name +' '+ user.last_name +'</b> <br>\
                                        <span style="color:#6b7280;">'+ user.status +'</span>\
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