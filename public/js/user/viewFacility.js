$(window).ready(function(){
    fetchInformationForViewDormitory();

    function fetchInformationForViewDormitory(){
        let id = $('#hidden_facility_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchInformationForViewDormitory/'+ id,
            success: function(response){
                //console.log(response.dormitory);
                $.each(response.dormitory, function(key, dorm){
                    $('.facility-picture').find('img').attr('src', '/images/facility/'+dorm.facilityPicture);
                    $('.facility-info').find('h2').text(dorm.facilityName);
                    $('.facilitator').find('img').attr('src', '/images/user/'+dorm.profilePicture);
                    $('.facilitator-info').append(dorm.firstName + ' '+ dorm.lastName +'<br>'+ dorm.mobileNumber);
                    $('.facility-address').append(dorm.street + ', '+ dorm.barangay +', <br>'+ dorm.city +', '+dorm.province);
                    
                });
                
                $.each(response.features, function(key, feature){
                    $('#features').append('\
                        <li class="inline-flex">'+ feature.feature +'</li>\
                    ');
                });

                $.each(response.pictures, function(key, picture){
                    //console.log(picture.image);
                    $('#facility_pictures').append('\
                        <div class="col-md-4">\
                            <div class="w-100 overflow-hidden rounded" style="height:130px">\
                                <a href="/images/facility/'+ picture.image +'" target="_blank" class="w-100 h-100">\
                                    <img src="/images/facility/'+ picture.image +'" class="w-100 h-100" alt="">\
                                </a>\
                            </div>\
                        </div>\
                    ');
                })
            }
        })
    }

    fetchRates()
    function fetchRates(){
        let id = $('#hidden_facility_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchRates/'+ id,
            processData: false,
            contentType: false,
            success: function(response){
                $.each(response.rates, function(key, rate){
                    var avgRate = (rate.totalRate / rate.totalPerson);
                    if(avgRate >= 1 && avgRate < 2)
                    {
                        $('div.star').html('<i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>');
                    }
                    if(avgRate >= 1 && avgRate < 2)
                    {
                        $('div.star').html('<i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>');
                    }
                    if(avgRate >= 2 && avgRate < 3)
                    {
                        $('div.star').html('\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>\
                        ');
                    }
                    if(avgRate >= 3 && avgRate < 4)
                    {
                        $('div.star').html('\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>\
                        ');
                    }
                    if(avgRate >= 4 && avgRate < 5)
                    {
                        $('div.star').html('\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>\
                        ');
                    }
                    if(avgRate == 5)
                    {
                        $('div.star').html('\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <i class="fa fa-star checked" aria-hidden="true"></i>\
                        <small class="" style="display: inline-block;">'+ avgRate +' reviews</small>\
                        ');
                    }
                })
            }
        })
    }

    $(formRate).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formRate).attr('method'),
            url: $(formRate).attr('action'),
            data: new FormData(formRate),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                console.log(response.message);
                $('#ModalRate').modal('hide');
                //$('#RateToast').show().delay(5000).fadeOut();
                //$('#RateToastBody').text(response.message);
                fetchRates()
            }
        })
    });

    $(formComment).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formComment).attr('method'),
            url: $(formComment).attr('action'),
            data: new FormData(formComment),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404){
                    $.each(response.errors, function(name, err){
                        $('#formComment').find('label.'+ name +'-error').text(err);
                        $('#formComment').find('label.'+ name +'-error').show();
                    })
                }else{
                    $('#comment_textarea').val('');
                    $('#formComment').find('label.comment-error').text('');
                    $('#formComment').find('textarea.comment').text('');

                    fetchComments();
                }
            }
        })
    });

    fetchComments();
    function fetchComments(){
        let id = $('#hidden_facility_id').val();


        $('#commentContainer').html('');
        
        $.ajax({
            type: 'get',
            url: '/fetchComments/'+ id,
            success: function(response){
                $.each(response.comments, function(key, comment){
                    console.log(comment);

                    var replyCount;
                    if(comment.totalReply == 1){ replyCount="reply"; }
                    if(comment.totalReply > 1){ replyCount="replies"; }
                    var replies ='<a class="" id="toggleReplies'+ comment.id +'" onclick="fetchReplies('+ comment.id +')" type="button" data-bs-toggle="collapse" data-bs-target="#replyForComment'+ comment.id +'" aria-expanded="false" aria-controls="replyForComment'+ comment.id +'">\
                                    '+ comment.totalReply +' '+ replyCount +'\
                                  </a>';

                    $('#commentContainer').append('\
                        <div class="w-100 d-flex mb-2">\
                            <div class="comment-img-container">\
                                <div class="w-100 comment-img overflow-hidden">\
                                    <img src="/images/user/'+ comment.profile_picture +'" class=" w-100 h-100" alt="">\
                                </div>\
                            </div>\
                            <div class="comment-message-container ps-2">\
                                <div class="comment-message p-2 rounded" >\
                                    <span class="fw-bold">'+ comment.first_name +' '+ comment.last_name +'</span><br>\
                                    '+ comment.comment +'\
                                </div>\
                                <div class="w-100 d-flex gap-4 px-2 date-reply">\
                                    <span class="inline-flex">'+ comment.created_at +'</span>\
                                    <button type="button" class="inline-flex btn-reply" onclick="reply('+ comment.id +')" data-bs-toggle="collapse" data-bs-target="#divFormReply'+ comment.id +'" aria-expanded="false" aria-controls="divFormReply'+ comment.id +'">Reply</span>\
                                </div>\
                                <div class="w-100 replies">\
                                    '+ replies +'\
                                    <div class="collapse" id="replyForComment'+ comment.id +'"></div>\
                                    <div class="collapse" id="divFormReply'+ comment.id +'"></div>\
                                </div>\
                            </div>\
                        </div>\
                    ');

                    if(comment.totalReply == 0)
                    {
                        $('#toggleReplies'+ comment.id).hide();
                    }

                    
                });
            }
        })
    }

    $(document).on('click', '#btnSubmitReply', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var cid =$('#reply_comment_id').val();

        var formData ={
            'comment_id': $('#reply_comment_id').val(),
            'reply': $('#reply_textarea').val(),
        }

        $.ajax({
            type: 'post',
            url: '/submitReply',
            data: formData,
            dataType: 'json',
            success: function(response){
                console.log(response.message);
                fetchComments();
            }
        })
    })

});

var cid;

function reply(cid){
    $('#divFormReply'+cid).html('');

    $('#divFormReply'+cid).append('\
        <div class="form-reply" id="">\
            <input type="hidden" id="reply_comment_id" name="reply_comment_id" value="'+ cid +'">\
            <div class="input-group w-100 mb-1">\
                <textarea name="reply" class="py-2 px-3 reply" placeholder="Write reply" id="reply_textarea"\
                oninput="auto_grow(this)" required></textarea>\
            </div>\
            <div class="w-100 text-end">\
                <button type="button" class="btn-submit-reply px-3" id="btnSubmitReply">Reply</button>\
            </div>\
            <label for="" class="reply-error text-red-500 pt-2" style="display:none"></label>\
        </div>\
    ');
}
    function fetchReplies(cid){
        $('#replyForComment'+cid).html('');
        
        $.ajax({
            type: 'get',
            url: '/fetchReplyforComment/' + cid,
            success: function(response){
                console.log(response.replies);
                
                $.each(response.replies, function(key, reply){
                    $('#replyForComment'+reply.comment_id).append('\
                            <div class="w-100 d-flex mb-2">\
                                <div class="reply-img-container">\
                                    <div class="w-100 reply-img overflow-hidden">\
                                        <img src="/images/user/'+ reply.picture +'" class=" w-100 h-100" alt="">\
                                    </div>\
                                </div>\
                                <div class="reply-message-container ps-2">\
                                    <div class="reply-message p-2 rounded" >\
                                        <span class="fw-bold">'+ reply.first_name +' '+ reply.last_name +'</span><br>\
                                        '+ reply.reply +'\
                                    </div>\
                                </div>\
                            </div>\
                    ');
                })
            }
        })
    }

function rate(){
    //let id = $('#hidden_facility_id').val();
    $('#formRate').find('#facility_id').val($('#hidden_facility_id').val());
    $('#ModalRate').modal('show');
}

function clearRate(){
    $('#rate1Label').removeClass('checked');
    $('#rate2Label').removeClass('checked');
    $('#rate3Label').removeClass('checked');
    $('#rate4Label').removeClass('checked');
    $('#rate5Label').removeClass('checked');
}

function rate1(){
    $('#rate1Label').addClass('checked');
    $('#rate2Label').removeClass('checked');
    $('#rate3Label').removeClass('checked');
    $('#rate4Label').removeClass('checked');
    $('#rate5Label').removeClass('checked');
}
function rate2(){
    $('#rate1Label').addClass('checked');
    $('#rate2Label').addClass('checked');
    $('#rate3Label').removeClass('checked');
    $('#rate4Label').removeClass('checked');
    $('#rate5Label').removeClass('checked');
}
function rate3(){
    $('#rate1Label').addClass('checked');
    $('#rate2Label').addClass('checked');
    $('#rate3Label').addClass('checked');
    $('#rate4Label').removeClass('checked');
    $('#rate5Label').removeClass('checked');
}
function rate4(){
    $('#rate1Label').addClass('checked');
    $('#rate2Label').addClass('checked');
    $('#rate3Label').addClass('checked');
    $('#rate4Label').addClass('checked');
    $('#rate5Label').removeClass('checked');
}
function rate5(){
    $('#rate1Label').addClass('checked');
    $('#rate2Label').addClass('checked');
    $('#rate3Label').addClass('checked');
    $('#rate4Label').addClass('checked');
    $('#rate5Label').addClass('checked');
}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}