$(document).ready(function(){

    $(".tab-content").hide(1);
    $("#tab1").show(1);



    $(document).on("click",".tablink",function(){
        let tab = $(this).attr("data-target");

        $(".tablink").css("background","");
        $(this).css("background","#e3e5f0");

        $(".tab-content").hide();
        $(tab).show();


        if(tab == "#tab2"){
            $.ajax({
                url : "includes/getTrack.php",
                method: "POST",
                data: {},
                success:function(data){
                    $(tab).html(data);
                }
            })
        }
        
    });



    $(document).on("click","#submit",function(){

        $("#modal .modal-title").html('Sending...');
        $("#modal .modal-body").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
        $("#modal").modal('show');

        let userEmail = $("#userEmail").val();
        let subject = $("#subject").val();
        let fileName = $("#fileName").val();
        let message = $("#message").val().replaceAll("\n","<br>");;
        let senderEmail = $("#senderEmail").val();
        let senderName = $("#senderName").val();
        $.ajax({
            url : "includes/sendEmail.php",
            method: "POST",
            data: {
                userEmail : userEmail,
                subject : subject,
                fileName : fileName,
                message : message,
                senderEmail : senderEmail,
                senderName : senderName
            },
            success:function(data){
                $("#modal").modal('show');
                $("#modal .modal-body").html(data);
            }
        })
    });


    $(document).on("change","#fileName",function(){
    
        messageEnableDisable();
        
    });


    function loadSelect(){
        $.ajax({
            url : "includes/fetchSelect.php",
            method: "POST",
            data: {},
            success:function(data){
                $("#fileName").html(data);
                messageEnableDisable();
            }
        });

    }

    function messageEnableDisable(){
        let isSelectText = $("#fileName").val();

        if(isSelectText == "text"){
            $("#message").prop("disabled", false );
        }else{
            $("#message").prop("disabled", true );
        }
    }
    loadSelect();

    $(document).on("click",".icon-area, .content-wrapper",function(){
        $(".content-area").toggle("slide");
        $(".content-wrapper").toggle();
        let fileName = $("#fileName").val();
        if(fileName != "text"){
            $(".content-area").html('<iframe src="email/'+fileName+'"></iframe>');
        }else{
            let message = $("#message").val().replaceAll("\n","<br>");
            $(".content-area").html(message);
        }
    });

});