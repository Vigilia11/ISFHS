$(window).ready(function(){
    fetchAccountStatus();
    fetchStudent();
    fetchFacilitator();
    fetchFacilityStatus();
    fetchDormitory();
    fetchCanteen();

    function fetchFacilityStatus(){
      $.ajax({
        type: 'get',
        url: '/fetchFacilityStatus',
        processData: false,
        contentType: false,
        success: function(response){
          $('h4.facility-pending-number').text(response.facilityPending);
          $('h4.facility-approved-number').text(response.facilityApproved);
          $('h4.facility-declined-number').text(response.facilityDeclined);
          $('h4.facility-blocked-number').text(response.facilityBlocked);
        }
      })
    }

    function fetchDormitory(){
      $.ajax({
        type: 'get',
        url: '/fetchDormitory',
        processData: false,
        contentType: false,
        success: function(response){
          $('#pendingDormitory').text(response.pendingDormitory);
          $('#approvedDormitory').text(response.approvedDormitory);
          $('#declinedDormitory').text(response.declinedDormitory);
          $('#blockedDormitory').text(response.blockedDormitory);
          $('#totalDormitory').text(response.totalDormitory);
        }
      })
    }

    function fetchCanteen(){
      $.ajax({
        type: 'get',
        url: '/fetchCanteen',
        processData: false,
        contentType: false,
        success: function(response){
          $('#pendingCanteen').text(response.pendingCanteen);
          $('#approvedCanteen').text(response.approvedCanteen);
          $('#declinedCanteen').text(response.declinedCanteen);
          $('#blockedCanteen').text(response.blockedCanteen);
          $('#totalCanteen').text(response.totalCanteen);
        }
      })
    }

    function fetchAccountStatus(){
        $.ajax({
            type: 'get',
            url: '/fetchAccountStatus',
            processData: false,
            contentType: false,
            success: function(response){
                
                $('h4.pending-number').text(response.accountPending);
                $('h4.approved-number').text(response.accountApproved);
                $('h4.declined-number').text(response.accountDeclined);
                $('h4.blocked-number').text(response.accountBlocked);
                
            }
        })
    }

    function fetchStudent(){
      $.ajax({
        type: "get",
        url: "/fetchStudent",
        processData: false,
        contentType: false,
        success: function(response){
          $.each(response.pendingStudent, function(key, pending){
            $('#pendingStudent').text(pending.pendingStudent);        
          })
          
          $.each(response.approvedStudent, function(key, approved){
            $('#approvedStudent').text(approved.approvedStudent);        
          })

          $.each(response.declinedStudent, function(key, declined){
            $('#declinedStudent').text(declined.declinedStudent);        
          })

          $.each(response.blockedStudent, function(key, blocked){
            $('#blockedStudent').text(blocked.blockedStudent);        
          })
          
          $.each(response.totalStudent, function(key, total){
            $('#totalStudent').text(total.totalStudent);        
          })
        }
        
      })
    }

    function fetchFacilitator(){
      $.ajax({
        type: "get",
        url: "/fetchFacilitator",
        processData: false,
        contentType: false,
        success: function(response){
          $.each(response.pendingFacilitator, function(key, pending){
            $('#pendingFacilitator').text(pending.pendingFacilitator);        
          })
          
          $.each(response.approvedFacilitator, function(key, approved){
            $('#approvedFacilitator').text(approved.approvedFacilitator);        
          })

          $.each(response.declinedFacilitator, function(key, declined){
            $('#declinedFacilitator').text(declined.declinedFacilitator);        
          })

          $.each(response.blockedFacilitator, function(key, blocked){
            $('#blockedFacilitator').text(blocked.blockedFacilitator);        
          })
          
          $.each(response.totalFacilitator, function(key, total){
            $('#totalFacilitator').text(total.totalFacilitator);        
          })
        }
        
      })
    }
})


