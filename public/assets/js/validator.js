function select_box() {
    $("select.val").change(function(){
        $(this).find("option:selected").each(function(){
            if ($(this).attr("value")==="QUICK"){
                $(".box").not(".quick").hide();
                $(".quick").show();
            }
            else if ($(this).attr("value")==="FULL"){
                $(".box").not(".sellout").hide();
                $(".sellout").show();
            } else {
                $(".box").hide();
            }
            if ($(this).attr("value")==="SELLOUT"){
                $(".box").not(".sellout").hide();
                $(".sellout").show();
            } else {
                $(".box").hide();
            }
            if ($(this).attr("value")==="x"){
                $(".box").not(".x").hide();
                $(".x").show();
            }
            else if ($(this).attr("value")==="y"){
                $(".box").not(".y").hide();
                $(".y").show();
            } else {
                $(".box").hide();
            }
        });
    }).change();
    $("select.val2").change(function(){
        $(this).find("option:selected").each(function(){
            if ($(this).attr("value")==="a"){
                $(".box2").not(".a").hide();
                $(".a").show();
            }
            else if ($(this).attr("value")==="b"){
                $(".box2").not(".b").hide();
                $(".b").show();
            } else {
                $(".box2").hide();
            }
        });
    }).change();
    $("select.val_payment").change(function(){
        $(this).find("option:selected").each(function(){
            if ($(this).attr("value")==="CASH"){
                $(".payment_box").not(".a").hide();
                $(".a").show();
            }
            else if ($(this).attr("value")==="INSTALLMENT"){
                $(".payment_box").not(".b").hide();
                $(".b").show();
            } else {
                $(".payment_box").hide();
            }
        });
    }).change();
    $("select.val_asset_type").change(function(){
        $(this).find("option:selected").each(function(){
            if ($(this).attr("value")==="1"){
                $(".box").not(".a").hide();
                $(".a").show();
            }
            else if ($(this).attr("value")==="2"){
                $(".box").not(".b").hide();
                $(".b").show();
            } else {
                $(".box").hide();
            }
        });
    }).change();
}

$(document).ready(function () {

    select_box();

    $("select.selectpicker").focus(function () {
        $(this).next(".bootstrap-select").find('.selectpicker').focus();
    });

    //CALLING FROM NOD.JS
    var Validator = nod();

    //SETTINGS
    Validator.configure({
        //delay: 1,
        jQuery: $,
        submit: '.submit',
        disableSubmit: true
    });

    //SET FUNCTIONS
    function mustBeEven(callback, value) {
        var result = +value % 2 === 0;

        callback(result);
    }

    //START OF VALIDATOR
    Validator.add([{
        selector: '.required',
        validate: 'presence',
        errorMessage: 'This field is required so don\'t leave me empty.',
        defaultStatus: 'invalid'
    }, {
        selector: '.email',
        validate: ['presence', 'email'],
        errorMessage: ['Email was empty', 'Duh? That is not an valid email format.'],
        defaultStatus: 'invalid'
    }, {
        selector: '.admin-name',
        validate: ['presence', 'between-length:5:30', 'username'],
        errorMessage: ['Username was empty.', 'Username should be at least 5-30 characters long!', 'OOPS! Invalid Username!'],
        defaultStatus: 'invalid'
    }, {
        selector: '.admin-password',
        validate: ['presence', 'between-length:5:30'],
        errorMessage: ['Password was empty.', 'Password should be at least 5-30 characters long!'],
        defaultStatus: 'invalid'
    }, {
        selector: '.username-email',
        validate: ['presence', 'between-length:8:30'],
        errorMessage: ['This field was empty.', 'This field should be at least 8-30 characters long!']
    }, {
        selector: '.username-email5',
        validate: ['presence', 'between-length:5:30'],
        errorMessage: ['This field was empty.', 'This field should be at least 5-30 characters long!']
    }, {
        selector: '.username',
        validate: ['presence', 'between-length:8:30', 'username'],
        errorMessage: ['Username was empty.', 'Username should be at least 8-30 characters long!', 'OOPS! Invalid Username!'],
        defaultStatus: 'invalid'
    }, {
        selector: '.password',
        validate: ['presence', 'between-length:8:30'],
        errorMessage: ['Password was empty.', 'Password should be at least 8-30 characters long!'],
        defaultStatus: 'invalid'
    }, {
        selector: '.password-repeat',
        validate: 'same-as:.password',
        errorMessage: 'Password does not match!',
        defaultStatus: 'invalid'
    }]);
});