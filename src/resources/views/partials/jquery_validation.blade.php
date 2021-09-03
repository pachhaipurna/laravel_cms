<script type="text/javascript">
    /**
     * custom jquery validation methods
     */

    $.validator.addMethod("email", function (value, element) {
        return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[a-zA-Z]{2,3})+$/.test(value);
    }, "Please provide a valid email address.");

    $.validator.addMethod("is_address", function (value, element) {
        return this.optional(element) || /^[a-z0-9\-.,()'"\s]+$/i.test(value);
    }, "Please provide a valid address.");

    $.validator.addMethod("is_city", function (value, element) {
        return this.optional(element) || /^[a-z0-9\-.,()'"\s]+$/i.test(value);
    }, "Please provide a valid city name.");

    $.validator.addMethod("is_state", function (value, element) {
        return this.optional(element) || /^[a-z\-.,()'"\s]+$/i.test(value);
    }, "Please provide a valid state name.");


    $.validator.addMethod("alphaspace", function (value, element) {
        return this.optional(element) || /^[a-zA-z ]+$/i.test(value);
    }, "Letters and spaces only please");

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
    }, "Letters only please");


    $.validator.addMethod("regexCheck", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Please Enter a valid data.");

    $.validator.addMethod('phone', function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, '');
        return this.optional(element) || phone_number.length > 6 &&
            phone_number.match(/^([0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/) && phone_number.length < 15 ;
    }, 'Please enter a valid phone number.');

    $.validator.addMethod('filesize', function (value, element, param) {
        // console.log(element);
        return this.optional(element) || (element.files[0].size <= (param * 1024));
    }, 'File size must be less than {0} KB');



    $.validator.addMethod("separated_emails", function(value, element) {
    if (this.optional(element)) {
        return true;
    }

    var mails = value.split(/,|;/);
    for(var i = 0; i < mails.length; i++) {
        // taken from the jquery validation internals
        if (!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(mails[i])) {
            return false;
        }
    }

    return true;
}, "Please specify a email address or a comma separated list of addresses");

</script>

<script>
    /**
     * rules by class
     */
    $.validator.addClassRules("password", {

    });

</script>


<script>
    /**
     * default rules, can be override in specific view blades.
     */
    var rules = {
        email: {
            email: true
        },
        password_val:{
            minlength:6
        },
        contact:{
            phone:true
        },
        director_name:{
            alphaspace:true
        },
        password:{
            minlength:6
        },
        password_confirmation: {
            equalTo: "#password"
        }

    };

    /**
     * default validation configs, can be override in specifc view blades
     */
    $.validator.setDefaults({
        errorClass: 'help-block with-errors',
        errorElement: 'div',
        onkeyup: function (element) {
            $(element).valid();
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        highlight: function (element, errorClass, validClass) {
            //console.log('hee');
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').find('.help-block').hide();
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
        },
        rules: rules
    });
</script>

