$(document).ready(function() {
    var themeStyle = $("input[name='themeStyle']:checked").val();
    
    colorDiv(themeStyle);

    $('input[type=radio][name=themeStyle]').change(function() {
        colorDiv(this.value);
    });

    changePreview( $('#gradientColor1').val() , $('#gradientColor2').val() )
    function colorDiv(type){
        if(type == 'Gradient')
        {
            $(".GradientColor").removeClass('d-none');
            $(".CustomColor").addClass('d-none');
            changePreview( $('#gradientColor1').val() , $('#gradientColor2').val() )
        }else if(type == 'Custom'){
            $(".CustomColor").removeClass('d-none');
            $(".GradientColor").addClass('d-none');
        }else{
            $(".CustomColor").addClass('d-none');
            $(".GradientColor").addClass('d-none');
        }
    }

    $('#gradientColor1').change(function () {
        var color1 = $('#gradientColor1').val();
        var color2 =$('#gradientColor2').val();
        changePreview(color1,color2)
    })

    $('#gradientColor2').change(function () {
        color1 = $('#gradientColor1').val();
        color2 = $('#gradientColor2').val();
        changePreview(color1,color2)
    })

    function changePreview(color1,color2){
        $('.preview_gradient').css('background', 'linear-gradient( to bottom right, ' + color1 + ', ' + color2 + ' )');
    }

    $('#change_password').prop('disabled', true);
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#confirm_pass_message').html('');
            $('#change_password').prop('disabled', false);
        } else {
            $('#change_password').prop('disabled', true);
            $('#confirm_pass_message').html('Password and confirm password not same').css('color', 'red');
        }
    });

    var floating_button = $("input[name='is_floating_button']:checked").val();
    checkFloatingButton(floating_button)

    $('input[type=radio][name=is_floating_button]').change(function() {
        checkFloatingButton(this.value);
    });
    function checkFloatingButton(floating_button)
    {
        if(floating_button === 'true'){
            $('.floating_button').removeClass('d-none');
        }else{
            $('.floating_button').addClass('d-none');
        }
    }

    var navigation_style = $('select[name=navigationStyle]').val();
    checkTabStyle(navigation_style);

    $("#navigationStyle").change(function() {
        checkTabStyle(this.value)
    });

    function checkTabStyle(tab_style)
    {
        if(tab_style === 'tabs' || tab_style === 'sidedrawer_tabs'){
            $('.tab_style').removeClass('d-none');
            $('.bottom_navigation').addClass('d-none');
        }else if(tab_style === 'bottom_navigation' || tab_style === 'sidedrawer_bottom_navigation'){
            $('.bottom_navigation').removeClass('d-none');
            $('.tab_style').addClass('d-none');
        }else if(tab_style !== 'bottom_navigation' && tab_style !== 'tabs' ){
            $('.bottom_navigation').addClass('d-none');
            $('.tab_style').addClass('d-none');
        }else{
            $('.tab_style').addClass('d-none');
        }
    }
    
    var walkthrough_style = $("input[name='is_walkthrough']:checked").val();
    checkWalkThrough(walkthrough_style)

    $('input[type=radio][name=is_walkthrough]').change(function() {
        checkWalkThrough(this.value);
    });
    function checkWalkThrough(walkthrough)
    {
        if(walkthrough === 'true'){
            $('.walkthrough_style').removeClass('d-none');
        }else{
            $('.walkthrough_style').addClass('d-none');
        }
    }

    var enable_title = $("input[name='enable_title']").prop('checked');
    checkEnableSplashOption('title',enable_title);

    $('#enable_title').change(function(){
        value = $(this).prop('checked') == true ? true : false;
        checkEnableSplashOption('title',value);
    });

    var enable_logo = $("input[name='enable_logo']").prop('checked');
    checkEnableSplashOption('logo',enable_logo);
    $('#enable_logo').change(function(){
        value = $(this).prop('checked') == true ? true : false;
        checkEnableSplashOption('logo',value);
    });

    var enable_background = $("input[name='enable_background']").prop('checked');
    checkEnableSplashOption('background',enable_background);

    $('#enable_background').change(function(){
        value = $(this).prop('checked') == true ? true : false;
        checkEnableSplashOption('background',value);
    });

    var progressbar_style = $("input[name='is_progressbar']:checked").val();
    checkprogressbar(progressbar_style)

    $('input[type=radio][name=is_progressbar]').change(function() {
        checkprogressbar(this.value);
    });

    var enable_image = $("input[name='enable_image']").prop('checked');
    checkExitPopupImage(enable_image);
    $('#enable_image').change(function(){
        value = $(this).prop('checked') == true ? true : false;
        checkExitPopupImage(value);
    });
    function checkExitPopupImage(value){
        if(value == true){
            $('#exitpopup_image').removeClass('d-none');
        }else{
            $('#exitpopup_image').addClass('d-none');
        }
        
    }
    function checkprogressbar(progressbar)
    {
        if(progressbar === 'true'){
            $('.progressbar_style').removeClass('d-none');
        }else{
            $('.progressbar_style').addClass('d-none');
        }
    }
    function checkEnableSplashOption(target,value)
    {
        if(value == true){
            $('#'+target+'_div').removeClass('d-none');
        }else{
            $('#'+target+'_div').addClass('d-none');
        }
        
        if(target == 'title'){
            if(value == true){
                $('#splash_preview_title').removeClass('d-none');
                $('#title_color_div').removeClass('d-none');
                splash_title = $('#splash_title').val();
                splash_title_color = $('#title_color').val();
                $('#preview_title_text').text(splash_title)
                $('#preview_title_text').css('color',splash_title_color);
            } else {
                $('#preview_title_text').text('');
                $('#splash_preview_title').addClass('d-none');
                $('#title_color_div').addClass('d-none');
                
            }
        }

        if(target == 'logo'){
            if(value == true){
                $('#splash_preview_logo').removeClass('d-none');
                $('.splash_preview_logo').removeClass('d-none');
            } else {
                $('#splash_preview_logo').addClass('d-none');
                $('.splash_preview_logo').addClass('d-none');
            }
        }
        if(target == 'background'){
            if(value == true){
               splash_background_preview = $('.splash_background_url_preview').attr('src');
               $('.splash_preview').css("background-image", "url("+splash_background_preview+")");
           } else {
               first_color = $('#first_color').val();
               second_color = $('#second_color').val();
               $('.splash_preview').css('background', 'linear-gradient( to bottom right, ' + first_color + ', ' + second_color + ' )');
           }
        }
    }
    /*
    $(document).on('change','#splash_logo_url',function(){
        readURL(this,'splash_logo_preview');
    });

    $(document).on('change','#splash_background_url',function(){
        readURL(this,'splash_background_preview');
    });
    */
    $("#splash_title").keyup(function(){
        $('#preview_title_text').text(this.value)
    });
    $("#title_color").change(function(){
        $('#preview_title_text').css('color',this.value);
    });
    $("#first_color").change(function(){
        colorConfigrutions()
    });
    $("#second_color").change(function(){
        colorConfigrutions()
    });

    /*$(document).on('change','#exit_image_url',function(){
        readURL(this,'image_preview');
    });*/
    
    $(document).on('change', '.custom-file-input', function() {       
        field_name = $(this).attr('name');
        readURL(this, field_name+'_preview');
    })

    function getExtension(filename) {
        var parts = filename.split('.');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'ico':
                return true;
        }
        return false;
    }

    function readURL(input,className) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var res = isImage(input.files[0].name);
            if(res == false){
                var msg = 'Image should be png/PNG, jpg/JPG & jpeg/JPG.';
                
                $(input).val("");
                return false;
            }
            reader.onload = function(e){
                $(document).find('img.'+className).attr('src', e.target.result);
                $(document).find("label."+className).text((input.files[0].name));
                if(className == 'splash_background_url_preview'){
                    $('.splash_preview').css("background-image", "url("+e.target.result+")");
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function colorConfigrutions(){
        value = $("input[name='enable_background']").prop('checked');
        if(value == false){
            first_color = $('#first_color').val();
            second_color = $('#second_color').val();
            $('.splash_preview').css('background', 'linear-gradient( to bottom right, ' + first_color + ', ' + second_color + ' )');
        }
    }

    if ($('.menu_style').length > 0) {
        var menu_style = $('select[name=type]').val();
        parentMenuOption(menu_style);

        $(".menu_style").change(function() {
            parentMenuOption(this.value)
        });

        function parentMenuOption(style) {
            if(style == 'sidedrawer') {
                $('.parent_menu_id').removeClass('d-none');
            } else {
                $('.parent_menu_id').addClass('d-none');
            }
        }
    }

    if($('.ads_type').length > 0 )
    {
        var ads_type = $("input[name='ads_type']:checked").val();
    
        adsDiv(ads_type);

        $('input[type=radio][name=ads_type]').change(function() {
            adsDiv(this.value);
        });

        function adsDiv(type){
            if(type == 'none')
            {
                $('#admob_div').addClass('d-none');
                $('#facebook_div').addClass('d-none');
            }else if(type == 'facebook'){
                $('#admob_div').addClass('d-none');
                $('#facebook_div').removeClass('d-none');
            }else{
                $('#admob_div').removeClass('d-none');
                $('#facebook_div').addClass('d-none');
            }
        }
    }

});