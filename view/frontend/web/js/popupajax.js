define([
    'jquery'
], function ($) {
    'use strict';
    return function (config) {
        var $dialog = $(this);
        $('#btnadd').on('click',function (e){
            var pageURL = $(location).attr("href");
            var zipcode = $('input[name=zip_code]').val();
            if(zipcode==''){
                alert('Please Enter Zipcode');
            }else{
                $.ajax({
                    type:'POST',
                    url :BASE_URL+"milkman/milkman/popupaction",
                    data: { id: zipcode, cid: config.myCurId},
                    beforeSend: function(){
                        $(".popup-loader").removeClass("hide");
                    },
                    success: function(data) {
                        var zip_data= $.parseJSON(data);
                        if(zip_data.success){
                            setCookie_zip('zipcode', zipcode, 'true');
                            setCookie(config.cookie_name, 'true');
                            window.location.reload();
                        }else{
                            $('.milkman_main').hide();
                            $('.milkman_sub').show();
                            $(".milkman_sub").removeClass("hide");
                            $('#milkman_btn').hide();
                            $('#popup_back').hide();
                            $('#zip_data').hide();
                            $('#btnadd').hide();
                            $("#btn_allbeverage").removeClass("hide");
                            delete_cookie(config.cookie_name);
                            delete_cookie('zipcode');
                        }
                    },
                    complete:function(data){
                        // Hide image container
                        $(".popup-loader").addClass("hide");
                    },
                    error:function(exception, textStatus){
                       console.log('Exeption:'+$.makeArray(exception));
                       console.log(textStatus);
                    }
                });
            }
        });

        function validateZipcode(zipcode){

        }

        var setCookie_zip = function (name, value, flag){
            var date = new Date(),
            expires = 'expires=';
            date.setTime(date.getTime() + (24*60*60*1000));
            expires += date.toGMTString();
            document.cookie = name + '=' + value + '; ' + expires + '; path=/';
        }

        var setCookie = function (name, value) {
            var date = new Date(),
            expires = 'expires=';
            date.setTime(date.getTime() + (24*60*60*1000));
            expires += date.toGMTString();
            document.cookie = name + '=' + value + '; ' + expires + '; path=/';
        }

        var getCookie = function (name) {
            var allCookies = document.cookie.split(';'),
            cookieCounter = 0,
            currentCookie = '';
            for (cookieCounter = 0; cookieCounter < allCookies.length; cookieCounter++) {
                currentCookie = allCookies[cookieCounter];
                while (currentCookie.charAt(0) === ' ') {
                    currentCookie = currentCookie.substring(1, currentCookie.length);
                }
                if (currentCookie.indexOf(name + '=') === 0) {
                    return currentCookie.substring(name.length + 1, currentCookie.length);
                }
            }
            return false;
        }

        var delete_cookie = function(name) {
            $.cookie(name, null, { path: '/' });
        };

        $('#zipcode_change').on('click',function (e){
            var zipcode=$('input[name=zipcode]').val();
            if(zipcode.trim()==''){
                alert('Please Enter Zipcode');
            }else{
                $('#zip_data').val(zipcode);
                delete_cookie(config.cookie_name);
                setCookie_zip('zipcode', zipcode, 'true');
                $('#zipcode-popup-btn').click();
                $('#btnadd').click();
            }
        });

        $('#zipcode_change_code').on('click',function (e){
            var zipcode_data=$('input[name=zipcode]').val();
            if(zipcode_data!=''){
                $('#zip_data').val(zipcode_data);
                delete_cookie(config.cookie_name);
                setCookie_zip('zipcode', zipcode_data, 'true');
                window.location.reload();
            }
        });

        $('#popup_back').on('click',function (e){
            window.location.href=BASE_URL;
        });

        $('#btn_allbeverage').on('click',function (e){
            window.location.href=BASE_URL+'all-beverages';
        });
    }
});