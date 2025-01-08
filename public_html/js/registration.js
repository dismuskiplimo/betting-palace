jQuery(document).ready(function(){
    jQuery('.step-1-button').on('click', function(){
        if(checkFilled(jQuery(this))){
            removeActiveSteps();

            jQuery('.registration-step.step-1').addClass('active');

            jQuery('#myTab a[href="#step-1"]').tab('show');
        }
    });

    jQuery('.step-2-button').on('click', function(){
        if(jQuery('#photo-file').val()){                                
            if(checkFilled(jQuery(this))){
                removeActiveSteps();

                jQuery('.registration-step.step-1').addClass('active');
                jQuery('.registration-step.step-2').addClass('active');

                jQuery('#myTab a[href="#step-2"]').tab('show');
            }
        }else{
            alert("Please attach passport photo");
        }
    });

    jQuery('.step-3-button').on('click', function(){
        if(checkFilled(jQuery(this))){
            removeActiveSteps();

            jQuery('.registration-step.step-1').addClass('active');
            jQuery('.registration-step.step-2').addClass('active');
            jQuery('.registration-step.step-3').addClass('active');
            
            jQuery('#myTab a[href="#step-3"]').tab('show');
        }
    });

    jQuery('.step-4-button').on('click', function(){
        if(checkFilled(jQuery(this))){
            removeActiveSteps();

            jQuery('.registration-step.step-1').addClass('active');
            jQuery('.registration-step.step-2').addClass('active');
            jQuery('.registration-step.step-3').addClass('active');
            jQuery('.registration-step.step-4').addClass('active');
            
            jQuery('#myTab a[href="#step-4"]').tab('show');
        }
    });

    jQuery('.step-5-button').on('click', function(){
        if(jQuery('#cv').val()){                                
            if(checkFilled(jQuery(this))){
                removeActiveSteps();

                jQuery('.registration-step.step-1').addClass('active');
                jQuery('.registration-step.step-2').addClass('active');
                jQuery('.registration-step.step-3').addClass('active');
                jQuery('.registration-step.step-4').addClass('active');
                jQuery('.registration-step.step-5').addClass('active');
                
                jQuery('#myTab a[href="#step-5"]').tab('show');
            }
        }else{
            alert("Please attach CV");
        }
    });

    jQuery('#registration-form').on('submit', function(e){
        
        if(!jQuery("input[name=consent]").prop("checked")){
            alert("You must accept the terms");
            e.preventDefault();
        }
    });

    jQuery("#photo-button").on('click', function(){
        jQuery("#photo-file").click();
    });

    jQuery("#photo-file").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                jQuery('#photo-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function checkFilled(element){
        var is_valid = true;

        element.parentsUntil('.tab-pane').find('input, select, textarea').each(function(index,e){
            var el = jQuery(e);

            if(el.prop("required")){
                if(jQuery.trim(el.val()) == ""){
                    el.css('border', "1px solid red");
                    is_valid = false;
                }else{
                    el.css('border', "1px solid #ced4da");
                }
            }
        });

        return is_valid;
    }

    function removeActiveSteps(){
        jQuery('.steps').find('.registration-step').each(function(index, el){
            jQuery(el).removeClass('active');
        });
    }
});