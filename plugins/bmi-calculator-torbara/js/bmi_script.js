jQuery(document).ready(function() {
    jQuery(".ak-bmicalc-submit").click(function (e) {
        e.preventDefault();
        if(jQuery(".year_birthday").val()=="0" || jQuery(".weight-bmi").val()=="0" || jQuery(".height").val()=="0"){
            alert("The form is not filled out completely!");
        }else{
            jQuery.post( 
                    "/wp-content/plugins/bmi-calculator-torbara/mod_your_fitness_bmi_calculator_ajax.php", 
                    jQuery( this ).parent().serialize(),
                    function( data ) {
                        jQuery(".ak-bmi-result").html(
                            "<p class='yoor-result'>your result</p>"+ "<p class='result-bmi'>"
                        +data.result+" <font style='font-size: 18pt;'>kg/m<sup style='vertical-align: super; font-weight: bold; font-family: Roboto;'>2</sup></font></p>" 
                        +"<p class='text-bmi'>"+data.result_text+"</p>" + 
                        "<p class='text-bmi-next'>Relative height, weight and age of the person: <br/>"+data.message+"</p>"+"<a href='"+consultation_url+"' class='bmi-link' style='padding-left: 10px;'>Get  Free  Consultation</a>"
    + "<p class='text-bmi-next'>This is the World Health Organization's<br /> (WHO) recommended body weight based on<br /> BMI values for adults. It is used for both men<br /> and women, age 18 or older.</p>"); 
                         
                    },
                    "json" 
            );
        }
    });
});

