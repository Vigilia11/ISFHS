$(window).ready(function(){
    fetchInformationForViewFacility();

    function fetchInformationForViewFacility(){
        var id = $('#hidden_facility_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchOwnedFacility/'+ id,
            success: function(response){
                //console.log(response.dormitory);
                $('div.certificates').html('');
                $.each(response.certificates, function(key, certificate){
                    $('div.certificates').append('\
                        <div class="col-md-3">\
                            <h6>'+ certificate.name +'</h6>\
                            <div class="col-md-9 certificate bg-blue-100 overflow-hidden">\
                                <a href="/images/facility/permit/'+ certificate.picture +'" target="_blank">\
                                    <img src="/images/facility/permit/'+ certificate.picture +'" class="w-100 h-100">\
                                </a>\
                            </div>\
                            <div class="col-md-9 py-1 text-center permit-button">\
                                <button type="button" class="button button-sm btn-slate" onclick="editPermit('+ certificate.id +')">change</button>\
                            </div>\
                        </div>\
                    ');
                });

                $('.facility-address').html('');
                $.each(response.facility, function(key, fty){
                    $('.facility-picture').find('img').attr('src', '/images/facility/'+fty.facility_picture);
                    $('.facility-info').find('h2').text(fty.name);
                    $('.facility-address').append(fty.street + ', '+ fty.barangay +', <br>'+ fty.city +', '+fty.province);
                    
                    if(fty.status == 'Pending')
                    {
                        $('div.permit-button').show();
                        $('button.button-facility-info').show();
                    }
                });
                
                $('#features').html('');
                $.each(response.features, function(key, feature){
                    $('#features').append('\
                        <li class="inline-flex feature">'+ feature.feature +'</li>\
                    ');
                });

                

                $('#facility_pictures').html('');
                $.each(response.pictures, function(key, picture){
                    //console.log(picture.image);
                    $('#facility_pictures').append('\
                        <div class="col-md-4">\
                            <div class="w-100 overflow-hidden position-relative" style="height:130px">\
                                <div class="p-1 text-center position-absolute top-0 end-0">\
                                    <i for="btnShowDeleteModal" onclick="deleteFacilityPicture('+ picture.id +')" class="fa fa-trash delete-icon " aria-hidden="true" ></i>\
                                </div>\
                                <a href="/images/facility/'+ picture.image +'" target="_blank" class="w-100 h-100">\
                                    <img src="/images/facility/'+ picture.image +'" class="w-100 h-100" alt="">\
                                </a>\
                                <div class="p-1 text-center position-absolute bottom-0 description">'+ picture.description +'</div>\
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
                //console.log(response.message);
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
                    //console.log(comment);

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
                                    '+ comment.comment +'<br>\
                                    <div class="w-100 text-end pt-2"><small class="">'+ comment.created_at +'</small></div>\
                                </div>\
                                <div class="w-100 text-end gap-4 px-2 date-reply">\
                                    <button type="button" class="btn-reply" onclick="reply('+ comment.id +')" data-bs-toggle="collapse" data-bs-target="#divFormReply'+ comment.id +'" aria-expanded="false" aria-controls="divFormReply'+ comment.id +'">Reply</span>\
                                    <button type="button" class="btn-delete" onclick="deleteComment('+ comment.id +')">Delete</span>\
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
                //console.log(response.message);
                fetchComments();
            }
        })
    })

    $('#formEditFacilityInfo').on('submit', function(e){
        e.preventDefault();

        var id = $('#hidden_facility_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $formData ={
            'facility_name': $('#formEditFacilityInfo').find('#facility_name').val(),
            'street': $('#formEditFacilityInfo').find('#street').val(),
            'barangay': $('#formEditFacilityInfo').find('#barangay').val(),
            'city': $('#formEditFacilityInfo').find('#city').val(),
            'province': $('#formEditFacilityInfo').find('#province').val(),
        }

        $.ajax({
            type: 'put',
            url: '/updateFacilityInfo/'+ id,
            data: $formData,
            dataType: 'json',
            success: function(response){
                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        $('#formEditFacilityInfo').find('span.'+name+'_error').text(error);
                    });
                }
                else{
                    $('#formEditFacilityInfo').find('input').val('');
                    $('#formEditFacilityInfo').find('span.error').text('');
                    $('#modalFacilityInfo').modal('hide');

                    fetchInformationForViewFacility();
                }
                
            }
        })
    });

    $(form_feature).on('submit', function(e){
        e.preventDefault();

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_feature).attr('method'),
            url: $(form_feature).attr('action'),
            data: new FormData(form_feature),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == '404'){
                    $.each(response.errors, function(name, error){
                        $('#form_feature').find('span.'+name+'_error').text(error)
                    })
                    
                }
                else{
                    $('#form_feature').find('input').val('');
                    $('#form_feature').find('span.error').text('')
                    $('#modalFeature').modal('hide');
                    fetchInformationForViewFacility();
                }
            }

        })
    })

    $(document).on('click', '#btnDeleteFeature', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var arr = [];
        $("input[type=checkbox]").each(function () {
            var self = $(this);
            if (self.is(':checked')) {
                arr.push(self.attr("value"));
            }
        });
        //console.log(arr);
        var formData ={
            'id': arr,
        }
        $.ajax({
            type: 'post',
            url: '/deleteFeature',
            data: formData,
            dataType: 'json',
            success: function(response){
                console.log(response.status);
                $('#modalDeleteFeature').modal('hide');;
                fetchInformationForViewFacility();
            }
        })
    })

    $(formDeletePicture).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        
        $.ajax({
            type: $(formDeletePicture).attr('method'),
            url: $(formDeletePicture).attr('action'),
            data: new FormData(formDeletePicture),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                $('#formDeletePicture').find('#picture_id').val("");
                $('#formDeletePicture').find('p.delete-confirmation-message').text("");
                $('#formDeletePicture').find('img.delete-confirmation-picture').attr("src", "");
                $('#modalDeletePicture').modal('hide');
                fetchInformationForViewFacility();
                
            }
        })
    })

    $(formAddPicture).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formAddPicture).attr('method'),
            url:  $(formAddPicture).attr('action'),
            data: new FormData(formAddPicture),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(response.errors, function(key, error){
                        $('p.'+key+'-error').show();
                        $('p.'+key+'-error').text(error);
                    });
                    
                }
                else{
                    $('#formAddPicture').find('p.error').text("");
                    $('#formAddPicture').find('input.input').val("");
                    $('#formAddPicture').find('#preview').html('');
                    $('#modalAddPicture').modal('hide');
                    fetchInformationForViewFacility();
                    //console.log(response.message);
                }
                
            }
        })
    })

    $(formUpdateFacilityPicture).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formUpdateFacilityPicture).attr('method'),
            url:  $(formUpdateFacilityPicture).attr('action'),
            data: new FormData(formUpdateFacilityPicture),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(response.errors, function(key, error){
                        $('span.'+key+'_error').text(error);
                    });
                    
                }
                else{
                    $('#formUpdateFacilityPicture').find('span.error').text("");
                    $('#formUpdateFacilityPicture').find('input.input').val("");
                    $('#modalUpdateFacilityPicture').modal('hide');
                    fetchInformationForViewFacility();
                    //console.log(response.message);
                }
                
            }
        })
    });

    $(formUpdateCertificate).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formUpdateCertificate).attr('method'),
            url:  $(formUpdateCertificate).attr('action'),
            data: new FormData(formUpdateCertificate),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    $.each(response.errors, function(key, error){
                        $('span.'+key+'_error').text(error);
                    });
                    
                }
                else{
                    $('#formUpdateCertificate').find('span.error').text("");
                    $('#formUpdateCertificate').find('input.input').val("");
                    $('#formUpdateCertificate').find('#permit_preview_img').attr('src', '');
                    $('#modalChangePermit').modal('hide');
                    fetchInformationForViewFacility();
                    //console.log(response.message);
                }
                
            }
        })
    });

    $(formDeleteComment).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formDeleteComment).attr('method'),
            url: $(formDeleteComment).attr('action'),
            data: new FormData(formDeleteComment),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                $('#modalDeleteComment').modal('hide');
                $('#formDeleteComment').find('#comment_id').val('');
                fetchComments();
            }
        })
    })

    $(formDeleteReply).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formDeleteReply).attr('method'),
            url: $(formDeleteReply).attr('action'),
            data: new FormData(formDeleteReply),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                $('#modalDeleteReply').modal('hide');
                $('#formDeleteReply').find('#reply_id').val('');
                fetchComments();
            }
        })
    })

});
///////////////////////////////////////////////////////////////////////////////////////////////////////
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
                //console.log(response.replies);
                
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
                                    <div class="w-100 text-end">\
                                        <button type="button" class="btn-delete" onclick="deleteReply('+ reply.id +')">Delete</span>\
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

function editFacilityInfo(){
    var id = $('#hidden_facility_id').val();

    $.ajax({
        type: 'get',
        url: '/editFacilityInfo/'+ id,
        success: function(response){
            //console.log(response.facility);
            $.each(response.facility, function(key, item){
                $('#formEditFacilityInfo').find('#facility_name').val(item.name);
                $('#formEditFacilityInfo').find('#street').val(item.street);
                $('#formEditFacilityInfo').find('#barangay').val(item.barangay);
                $('#formEditFacilityInfo').find('#city').val(item.city);
                $('#formEditFacilityInfo').find('#province').val(item.province);
            })
            
            $('#modalFacilityInfo').modal('show');
        }
    })

}

function deleteFeatures(){
    var id = $('#hidden_facility_id').val();
    //$('#features').html('');
    $('#featuresContainer').html('');

    $('#modalDeleteFeature').modal('show');
    $.ajax({
        type: 'get',
        url: '/fetchFeatures/' + id,
        proccessData: false,
        contentType: false,
        success: function(response){
            //console.log(response.features);
            $.each(response.features, function(key, feature){
                $('#featuresContainer').append('\
                    <div class="form-check">\
                        <input class="form-check-input" type="checkbox" name="feature" value="'+ feature.id +'" id="'+ feature.id +'">\
                        <label class="form-check-label" for="'+ feature.feature +'">\
                            '+ feature.feature + ' \
                        </label>\
                    </div>\
                ');
            })
        }
    })
}

var picture_id;
function deleteFacilityPicture(picture_id){
    $('#modalDeletePicture').modal('show');
    
    $.ajax({
        type: 'get',
        url: '/deleteFacilityPicture/'+ picture_id,
        success: function(response){
            $.each(response.picture, function(key, item){
                $('#formDeletePicture').find('#picture_id').val(item.id);
                $('#formDeletePicture').find('#picture_path').val("images/facility/"+item.image);
                $('#formDeletePicture').find('p.delete-confirmation-message').text("Are you sure you want to delete "+item.description);
                $('#formDeletePicture').find('img.delete-confirmation-picture').attr("src", "/images/facility/"+item.image);
            })
            
        }
    })
}

var permit_id;
function editPermit(permit_id){
    //alert(permit_id);
    
    $.ajax({
        type: 'get',
        url: '/editCertificate/'+ permit_id,
        processData: false,
        contentType: false,
        success: function(response){
            $.each(response.certificate, function(key, item){
                $('#modalPermitName').text(item.name);
                $('#formUpdateCertificate').find('#permit_id').val(item.id);
            })
            
            $('#modalChangePermit').modal('show');
        }
    });
    
}

function deleteComment(cid){
    $('#formDeleteComment').find('#comment_id').val(cid);
    $('#modalDeleteComment').modal('show');
}

var reply_id;
function deleteReply(reply_id){
    $('#formDeleteReply').find('#reply_id').val(reply_id);
    $('#modalDeleteReply').modal('show');
}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

//image preview
facility_picture.onchange = evt => {
    const [file] = facility_picture.files
    if (file) {
        facility_picture_preview.src = URL.createObjectURL(file)
        //$('#img_add_preview').show();
    }
}

permit.onchange = evt => {
    const [file] = permit.files
    if (file) {
        permit_preview_img.src = URL.createObjectURL(file)
        //$('#img_add_preview').show();
    }
}