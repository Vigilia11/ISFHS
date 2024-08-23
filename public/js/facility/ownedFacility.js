$(document).ready(function(){
    fetchFacility();

    function fetchFacility(){

        var facility_id = $('#facility_id').val();

        $.ajax({
            type: 'get',
            url: '/fetchOwnedFacility/'+ facility_id,
            success: function(response){
                //console.log(response.features);
                $('#facility_info').html('');
                $.each(response.facility, function(key, facility){
                    $('#img-facility').attr('src','/images/facility/'+ facility.facility_picture);
                    $('#facility_info').append('\
                    <h2>' + facility.name + '</h2>\
                        <h4>' + facility.type + '</h4>\
                        <div id="facilitator-info">\
                        </div>\
                        <p class="facility-info">\
                        ' + facility.street + ', ' + facility.barangay + ', <br>\
                        ' + facility.city + ', ' + facility.province + '</p>\
                    ');
                });

                $.each(response.facilitator, function(key, facilitator){
                    $('#facilitator-info').append('\
                        <div>\
                            <img src="/images/user/facilitator.png" id="facilitator_picture" alt="">\
                            <label>'+ facilitator.first_name +' '+ facilitator.last_name +'</label>\
                        </div>\
                        <label>'+ facilitator.contact +'</label>\
                    ');
                });

                $('#features').html('');
                $.each(response.features, function(key, features){
                    $('#features').append('\
                        <li>'+ features.feature +'</li>\
                    ');
                });

            }
        });
    }

    deleteFeatures();

    function deleteFeatures(){
        var id = $('#facility_id').val();
        $('#features').html('');

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
                    $.each(response.error, function(key, err){
                        $('#form_feature').find('p.'+name+'error').text(err)
                        $('#form_feature').find('p.'+name+'error').show()
                    })
                    
                }
                else{
                    $('#modalFeature').modal('hide');
                    //console.log(response.message);
                    $('#modal_feature').find('#feature').val('');
                    $('#modal_feature').find('.feature_error').text('');
                    $('#modal_feature').find('.feature_error').hide();

                    $('#toastFeaturesBody').text(response.message);
                    $('#toast').show().delay(5000).fadeOut();
                    fetchFacility();
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
            //type: $(formDeleteFeature).attr('method'),
            //url: $(formDeleteFeature).attr('action'),
            //data: new FormData(formDeleteFeature),
            type: 'post',
            url: '/deleteFeature',
            data: formData,
            dataType: 'json',
            success: function(response){
                console.log(response.status);
                $('#modalDeleteFeature').modal('hide');
                $('#toastFeaturesBody').text(response.message);
                $('#toast').show().delay(5000).fadeOut();
                fetchFacility();
                deleteFeatures();
            }
        })
    })

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
                $('#RateToast').show().delay(5000).fadeOut();
                $('#RateToastBody').text(response.message);
                fetchRates();
            }
        })
    })

    fetchRates()
    function fetchRates(){
        var facility_id = $('#facility_id').val();

        $('#star1').removeClass();
        $('#star2').removeClass();
        $('#star3').removeClass();
        $('#star4').removeClass();
        $('#star5').removeClass();

        $('.5star-total').text();
        $('.4star-total').text();
        $('.3star-total').text();
        $('.2star-total').text();
        $('.1star-total').text();

        $('.bar').css({width: '0%'});
        $('.average-rate').text('');

        $.ajax({
            type: 'get',
            url: '/fetchRates/'+ facility_id,
            processData: false,
            contentType: false,
            success: function(response){
                $.each(response.rates, function(key, item){
                    var rated0 = 0, rated1 = 0, rated2 = 0,rated3 = 0,rated4 = 0,rated5 = 0;
                    var percentage5, percentage4, percentage3, percentage2, percentage1;
                    if(item.rate == 5){
                        rated5++;
                    }
                    else if(item.rate == 4){
                        rated4++;
                    }
                    else if(item.rate == 3){
                        rated3++;
                    }
                    else if(item.rate == 2){
                        rated2++;
                    }
                    else if(item.rate == 1){
                        rated1++;
                    }
                    else{
                        rated0;
                    }
                    percentage5 = ((rated5/item.totalPerson) * 100 )+'%';
                    percentage4 = ((rated4/item.totalPerson) * 100 )+'%';
                    percentage3 = ((rated3/item.totalPerson) * 100 )+'%';
                    percentage2 = ((rated2/item.totalPerson) * 100 )+'%'
                    percentage1 = ((rated1/item.totalPerson) * 100 )+'%';

                    var averageRate = (item.totalRate / item.totalPerson)+ " average based on "+ item.totalPerson +" reviews.";
                    $('.average-rate').text(averageRate);
                    
                    $('.bar-5').css({width: ''+ percentage5+''});
                    $('.bar-4').css({width: ''+ percentage4+''});
                    $('.bar-3').css({width: ''+ percentage3+''});
                    $('.bar-2').css({width: ''+ percentage2+''});
                    $('.bar-1').css({width: ''+ percentage1+''});

                    $('.5star-total').text(rated5);
                    $('.4star-total').text(rated4);
                    $('.3star-total').text(rated3);
                    $('.2star-total').text(rated2);
                    $('.1star-total').text(rated1);

                    var r = item.totalRate / item.totalPerson;
                    //console.log(r);
                    if(r >= 1 && r < 2){
                        rate1();
                    }
                    else if(r >= 2 && r < 3){
                        rate2();
                    }
                    else if(r >= 3 && r < 4){
                        rate3();
                    }
                    else if(r >= 4 && r < 5){
                        rate4();
                    }
                    else if(r == 5){
                        rate5();
                    }
                    else{
                        rate0();
                    }
                })
            }
        })
    }
    function rate0(){
        $('#star1').removeClass('checked fa-regular');
        $('#star2').removeClass('checked fa-regular');
        $('#star3').removeClass('checked fa-regular');
        $('#star4').removeClass('checked fa-regular');
        $('#star5').removeClass('checked fa-regular');
    }

    function rate1(){
        $('#star1').addClass('checked fa-solid fa-star');
        $('#star2').addClass('fa-star fa-regular');
        $('#star3').addClass('fa-star fa-regular');
        $('#star4').addClass('fa-star fa-regular');
        $('#star5').addClass('fa-star fa-regular');
    }
    function rate2(){
        $('#star1').addClass('checked fa-solid fa-star');
        $('#star2').addClass('checked fa-solid fa-star');
        $('#star3').addClass('fa-star fa-regular');
        $('#star4').addClass('fa-star fa-regular');
        $('#star5').addClass('fa-star fa-regular');
    }
    function rate3(){
        $('#star1').addClass('checked fa-solid fa-star');
        $('#star2').addClass('checked fa-solid fa-star');
        $('#star3').addClass('checked fa-solid fa-star');
        $('#star4').addClass('fa-star fa-regular');
        $('#star5').addClass('fa-star fa-regular');
    }
    function rate4(){
        $('#star1').addClass('checked fa-solid fa-star');
        $('#star2').addClass('checked fa-solid fa-star');
        $('#star3').addClass('checked fa-solid fa-star');
        $('#star4').addClass('checked fa-solid fa-star');
        $('#star5').addClass('fa-star fa-regular');
    }
    function rate5(){
        $('#star1').addClass('checked fa-solid fa-star');
        $('#star2').addClass('checked fa-solid fa-star');
        $('#star3').addClass('checked fa-solid fa-star');
        $('#star4').addClass('checked fa-solid fa-star');
        $('#star5').addClass('checked fa-solid fa-star');
    }

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
                    $('#toast_comment').show().delay(5000).fadeOut();
                    $('#toastCommentBody').text(response.message);

                    fetchComments();
                }
            }
        })
    });

    fetchComments();
    function fetchComments(){
        var facility_id = $('#facility_id').val();


        $('#commentContainer').html('');

        $.ajax({
            type: 'get',
            url: '/fetchComments/'+ facility_id,
            success: function(response){
                $.each(response.comments, function(key, comment){
                    //console.log(comment);
                    var reply=0;
                    if(comment.totalReply == 0)
                    {
                        reply = "reply";
                    }
                    else if(comment.totalReply == 1)
                    {
                        reply = "1 reply";
                    }
                    else{
                        reply = comment.totalReply +"replies";
                    }
                    
                    $('#commentContainer').append('\
                        <div class="comment-box p-2">\
                            <div class="commentor position-relative">\
                                <div class="d-flex gap-3">\
                                    <img src="/images/user/facilitator.png" style="width:20px; height:20px; border-radius:100%" alt="muka ng aso">\
                                    <span class="my-auto">'+ comment.first_name +' '+ comment.last_name +'</span>\
                                </div>\
                                <div class="position-absolute top-0 end-0"><small>'+ comment.created_at +'</small></div>\
                            </div>\
                            <div class="comment mx-2 pt-1" id="comment">'+ comment.comment +'</div>\
                            <div class="d-flex justify-content-between">\
                                <small onclick="fetchReply('+ comment.id +')" style="cursor:pointer;">'+ reply +'</small>\
                                <button type="button" class="btn btn-danger btn-sm d-none" id="btnShowDeleteModal">Delete</button>\
                                <label for="btnShowDeleteModal" onclick="showModalDelete('+comment.id+')" style="cursor:pointer; color: red; display:none;" class="fa fa-trash delete-icon user-id-'+ comment.commentor +'" aria-hidden="true" ></label>\
                            </div>\
                        </div>\
                    ');
                    if(response.authID == comment.user_id)
                    {
                        $('.delete-icon').show();
                    }
                    else
                    {
                        $('.delete-icon').hide();
                    }
                    
                    if(response.authID == comment.commentor)
                    {
                        $('.user-id-' + response.authID).show();
                    }
                });
            }
        })
    }
    
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
                $('#toastCommentBody').text(response.message);
                $('#toast_comment').show().delay(5000).hide();

                fetchComments();
            }
        })
    })

    $(formReply).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(formReply).attr('method'),
            url: $(formReply).attr('action'),
            data: new FormData(formReply),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    
                    $.each(response.errors, function(err, error){
                        $('#formReply').find('.'+err+'-error').text(error);
                        $('#formReply').find('.'+err+'-error').show();
                    })
                }
                else{
                    $('#formReply').find('.reply-error').text('');
                    $('#formReply').find('.reply-error').hide();
                    $('#modalReply').modal('hide');
                    fetchComments();
                }
            }
        })
    })

    $('#btnRefreshComment').on('click', function(e){
        e.preventDefault();
        fetchComments();
    })

    $('#btnShowAddPictureModal').on('click', function(e){
        e.preventDefault();
        $('modalAddPicture').modal('show');
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
                    $('#modalAddPicture').modal('hide');
                    fetchFacilityPicture();
                    $('#pictureToastBody').text(response.message);
                    $('#toastPicture').show().delay(5000).fadeOut();
                    //console.log(response.message);
                }
                
            }
        })
    })

    fetchFacilityPicture();
    function fetchFacilityPicture(){
        var facility_id = $('#facility_id').val();

        $('.facility-picture-div').remove();
        $.ajax({
            type: 'get',
            url: '/fetchFacilityPicture/'+ facility_id,
            contentType: false,
            processData: false,
            success: function(response){
                $.each(response.pictures, function(key, picture){
                    
                    $('#facilityPictureContainer').append('\
                        <div class="col-md-4 p-1 facility-picture-div">\
                            <div class="w-100 shadow" style="height:200px;">\
                                <img src="/images/facility/'+ picture.image +'" class="h-100 w-100" alt="">\
                            </div>\
                            <div class="w-100 d-flex justify-content-between mt-2">\
                                <span>'+ picture.description +'</span>\
                                <div>\
                                    <i class="fa fa-trash-o picture-delete-icon" onclick="deleteFacilityPicture('+ picture.id +')" style="cursor:pointer; display:none" aria-hidden="true"></i>\
                                </div>\
                            </div>\
                        </div>\
                    ');
                    
                    if(response.deletable == "true")
                    {
                        $('.picture-delete-icon').show();
                    }
                    else
                    {
                        $('.picture-delete-icon').hide();
                    }
                })
            }
        })
    }
    
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
                fetchFacilityPicture();
                $('#pictureToastBody').text(response.message);
                $('#toastPicture').show().delay(5000).fadeOut();
                
                //console.log(response.message);
                //$('#modalReply').modal('hide');
                //location.reload();
                //document.getElementById('btnRefreshComment').click();
            }
        })
    })
})
//outside
var reply_id;
var cid;
var comment_id;
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

function fetchReply(comment_id){
        $('#modalReply').modal('show');
        $('#formReply').find('#comment_id').val(comment_id);

        $('#modalCommentContainer').html('');
        $('#repliesContainer').html('');
        $.ajax({
            type: 'get',
            url: '/fetchReply/' + comment_id,
            processData: false,
            contentType: false,
            success: function(response){
                //console.log(response.replies);
                $.each(response.comment, function(key, comment){
                    $('#modalCommentContainer').append('\
                        <div class="mb-3" style="border-bottom:1px solid gray">\
                            <div class="d-flex gap-3">\
                                <img src="/images/user/facilitator.png" style="width:20px; height:20px; border-radius:100%" alt="muka ng aso">\
                                <span class="my-auto">'+ comment.first_name +' '+ comment.last_name +'</span>\
                            </div>\
                            <div class="mb-2">\
                            '+ comment.comment +'\
                            </div>\
                            <div class="">\
                                <small>'+ comment.created_at +'</small>\
                            </div>\
                        </div>\
                    ');
                });

                $.each(response.replies, function(key, reply){
                    $('#repliesContainer').append('\
                        <div class="mb-3" style="border-bottom:1px solid #9ca3af">\
                            <div class="d-flex gap-3">\
                                <img src="/images/user/facilitator.png" style="width:20px; height:20px; border-radius:100%" alt="muka ng aso">\
                                <span class="my-auto">'+ reply.first_name +' '+ reply.last_name +'</span>\
                            </div>\
                            <div class="mb-2">\
                            '+ reply.reply +'\
                            </div>\
                            <div class="d-flex justify-content-between">\
                                <small>'+ reply.created_at +'</small>\
                                <button type="button" class="d-none" onclick="deleteReply('+ reply.id +')" id="btnDeleteReply">Delete Reply</button>\
                                <label for="btnDeleteReply" style="cursor:pointer; color: red; display:none;" class="fa fa-trash reply-delete-icon reply-user-id-'+ reply.user_id +'" aria-hidden="true" ></label>\
                            </div>\
                        </div>\
                    ');
                    
                    if(response.authID == reply.user_id)
                    {
                        $('.reply-user-id-' + response.authID).show();
                    }
                    if(response.authID == reply.facilitator)
                    {
                        $('.reply-delete-icon').show();
                    }
                });
                
            }
        })
    
}



function deleteReply(reply_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteReply/'+ reply_id,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response.message);
            $('#modalReply').modal('hide');
            //location.reload();
            document.getElementById('btnRefreshComment').click();
        }
    })
}


function showModalDelete(cid){
    $('#comment_id').val(cid);
    $('#modalDeleteComment').modal('show');
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


