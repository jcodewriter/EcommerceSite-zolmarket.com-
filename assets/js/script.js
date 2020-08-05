// global variables
var oldmenu = undefined;

//update token
$("form").submit(function () {
    $("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});

if ($(window).width() < 900) {
    // $('.scrollup').attr('href', 'https://www.zolmarket.com/contact');
    // $('.scrollup').html('<img src="https://www.zolmarket.com/uploads/profile/ezdze4554754444444441247_chat-removebg-preview.png" style="width: 45px;">');
}
var back_bubttin_search = false;
if ((window.location.pathname == "/" || window.location.pathname == "/ar/") && $(window).width() < 900) {
    $(".mobile-menu").css("display", "table")
}
if ((window.location.pathname == "/messages" || window.location.pathname == "/messages/" || window.location.pathname.indexOf("/messages") == 3) && $(window).width() < 900) {
    $('.mobile-menu').hide();
    // $('#wrapper').css({"padding-top": "90px"});
    $('#footer').before("<br><br><br><br><br><br><br><br>");
    $("#footer").hide();
}
if ((window.location.pathname == "/sell-now" || window.location.pathname == "/sell-now/" || window.location.pathname.indexOf("/sell-now") == 3) && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.page_title_hidden_on_mobile').hide();
    // $('#wrapper').css({"padding-top": "90px"});
}
var custom_path = (window.location).toString().split('/');
if ((custom_path[3] == "sell-now" && custom_path[4] == "product-details") && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.page_title_hidden_on_mobile').hide();
    // $('#wrapper').css({"padding-top": "90px"});
}
if ((custom_path[3] == "sell-now" && custom_path[4] == "edit-product") && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.page_title_hidden_on_mobile').hide();
    // $('#wrapper').css({"padding-top": "90px"});
}
if ((window.location.pathname.indexOf("/conversation/") == 9 || window.location.pathname.indexOf("/conversation/") == 12) && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('#wrapper').css({"padding-top": "80px"});
    $('#wrapper').css({ "padding-bottom": "80px" });
    $("#footer").hide();
    $('.scrollup').hide();
}
if (window.location.pathname.indexOf("/profile/") == 0 && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.hkm_messages_navCatDownMobile').show();
    // $('#wrapper').css({"padding-top": "50px"});
}

if (window.location.pathname.indexOf("/account/") == 0 && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.hkm_messages_navCatDownMobile').show();
    // $('#wrapper').css({"padding-top": "60px"});
}

if (window.location.pathname.indexOf("/notifications") == 0 && $(window).width() < 900) {
    $('.mobile-menu').hide();
    $('.hkm_messages_navCatDownMobile').show();
    // $('#wrapper').css({"padding-top": "60px"});
}

$('.hkm_messages_navCatDownMobile .container .col-3').on('click', function () {
    $(this).addClass("acteieive").siblings().removeClass('acteieive');

    if ($('#hkm_msg_all').hasClass("acteieive")) {
        $("#hkm_msg_all_content").show();
        $("#hkm_msg_unread_content").hide();
        $("#hkm_block_users_content").hide();
        $("#hkm_msg_myads_content").hide();
        $("#footer").hide();
        $(".hkm_messages_navCatDownMobile #marker").animate({ 'left': '0%' });
    } else if ($('#hkm_msg_myads').hasClass("acteieive")) {
        $("#hkm_msg_myads_content").show();
        $("#hkm_block_users_content").hide();
        $("#hkm_msg_all_content").hide();
        $("#hkm_msg_unread_content").hide();
        $("#footer").hide();
        $(".hkm_messages_navCatDownMobile #marker").animate({ 'left': '25%' });
    } else if ($('#hkm_msg_unread').hasClass("acteieive")) {
        $("#hkm_msg_unread_content").show();
        $("#hkm_msg_all_content").hide();
        $("#hkm_block_users_content").hide();
        $("#hkm_msg_myads_content").hide();
        $("#footer").hide();
        $(".hkm_messages_navCatDownMobile #marker").animate({ 'left': '50%' });
    } else if ($('#hkm_msg_block').hasClass("acteieive")) {
        $("#hkm_block_users_content").show();
        $("#hkm_msg_all_content").hide();
        $("#hkm_msg_unread_content").hide();
        $("#hkm_msg_myads_content").hide();
        $("#footer").hide();
        $(".hkm_messages_navCatDownMobile #marker").animate({ 'left': '75%' });
    }

});

$('.row_disktop_headr_chat ol li').on('click', function () {
    $(this).addClass("activeee").siblings().removeClass('activeee');
    if ($('#eafara_all').hasClass("activeee")) {
        $(".row_disktop_headr_chat #marker").animate({ 'left': '0%' });
        $("#oop_descto_alll").show();
        $("#oop_descto_block").hide();
        $("#oop_descto_unread").hide();
        $("#oop_descto_myads").hide();
    } else if ($('#eafara_myads').hasClass("activeee")) {
        $(".row_disktop_headr_chat #marker").animate({ 'left': '25%' })
        $("#oop_descto_myads").show();
        $("#oop_descto_unread").hide();
        $("#oop_descto_block").hide();
        $("#oop_descto_alll").hide();
        ;
    } else if ($('#eafara_unread').hasClass("activeee")) {
        $(".row_disktop_headr_chat #marker").animate({ 'left': '50%' })
        $("#oop_descto_unread").show();
        $("#oop_descto_block").hide();
        $("#oop_descto_alll").hide();
        $("#oop_descto_myads").hide();
    } else if ($('#eafara_block').hasClass("activeee")) {
        $(".row_disktop_headr_chat #marker").animate({ 'left': '75%' });
        $("#oop_descto_block").show();
        $("#oop_descto_unread").hide();
        $("#oop_descto_alll").hide();
        $("#oop_descto_myads").hide();
    }

});

$(".nav-mobile .btn-back-mobile-nav").on('click', function () {
    if (localStorage.getItem("profil_settingss_hkm_post") == 'yes') {
        localStorage.setItem("profil_settingss_hkm_post", null);
        localStorage.setItem("profil_settingss_hkm", null);
    }
});

var scrollPos = '';
// $(".profile-tabs .nav .nav-item .nav-link").on('click', function (event) {

//     event.preventDefault();
//     /* aaaaaa  */
//     if ($('.mobile-profile-form.cat-header').css('display') != 'none' && $(window).width() < 991) {
//         let items = (new Array("hkmprofileupdate","hkmchangepassword","hkmshopsettings","hkmshippingadresse","hkmcontactinformation","hkmproducts", "hkmpending_products", "hkmhidden_products", "hkmdrafts", "hkmfavorites", "hkmdownloads", "hkmfollowers", "hkmfollowing", "hkmreviews","hkmorders","hkmorders_active","hkmorders_completed","hkmsales","hkmsales_active","hkmsales_completed","hkmearnings","hkmearnings_hkmearnings","hkmearnings_payouts","hkmearnings_setpayoutaccount","hkmquoterequests","hkmquoterequests_recieved","hkmquoterequests_sent"));
//         // hkm_products
//         if (items.includes($(this).attr('id'))) {
//             localStorage.setItem("profil_settingss_hkm", $(this).attr('id'));
//             let attr = '.navCatDownMobile.' + $(this).attr('id');
//             $(attr).css('margin-left', "100%");

//             if (oldmenu != undefined) {
//                 oldmenu.css("z-index", "1");
//             }

//             $(attr).css("z-index", 2);
//             oldmenu = $(attr);
//             setTimeout(function () {
//                 $(attr).css('margin-left', "0%");
//                 $('html,body').addClass('disable-body-scroll');
//             }, 50);
//         } else {
//             window.location.href = $(this).attr('href');
//         }
//     } else {
//         window.location.href = $(this).attr('href');
//     }
// });

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgadshoww').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function app_suggest_hide() {
    $('.deep-linked').css('display', 'none');
}
function app_suggest_show() {
    $('.deep-linked').css('display', 'table');
}

$("#imgUploader").change(function () { readURL(this); });

$(document).ready(function () {
    // $("html, body").animate({scrollTop: 0}, 700);
    if (localStorage.getItem("app-suggest") == null && (window.location.pathname == '/' || window.location.pathname == '/ar/') && $(window).width() < 900) {
        app_suggest_show()
    }
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (localStorage.getItem("app-suggest") == null) {
            if (scroll >= 80 && $(this).width() < 769) {
                $(".mobile-menu").addClass("header-fixed-top");
                $(".top-search-bar").addClass("search-bar-fixed-top");
            } else {
                $(".mobile-menu").removeClass('header-fixed-top');
                $(".top-search-bar").removeClass('search-bar-fixed-top');
            }
        }else {
            if (scroll >= 10 && $(this).width() < 769) {
                $(".mobile-menu").addClass("header-fixed-top");
                $(".top-search-bar").addClass("search-bar-fixed-top");
            } else {
                $(".mobile-menu").removeClass('header-fixed-top');
                $(".top-search-bar").removeClass('search-bar-fixed-top');
            }
        }
    });
    //     if ((window.location.pathname == '/' || window.location.pathname == '/ar/') && $(window).width() < 900) {
    //         $(window).scroll(function () {
    //             var scroll = $(window).scrollTop();
    //             if ($(this).width() < 769) {
    //                 $(".mobile-menu").addClass("header-fixed-top");
    //                 $(".top-search-bar").addClass("search-bar-fixed-top");
    //             } else {
    //                 $(".mobile-menu").removeClass('header-fixed-top');
    //                 $(".top-search-bar").removeClass('search-bar-fixed-top');
    //             }
    //         });
    //     }
    // }

    $('.deep-linked').click(function () {
        localStorage.setItem("app-suggest", (new Date()).valueOf());
        app_suggest_hide();
    })

    $('.app-close').click(function () {
        app_suggest_hide();
    })

    // intelTelListContainer
    let input = document.querySelector("#intl_phone_number");
    if (input != null) {
        window.intlTelInput(input, {
            preferredCountries: ['sd', 'ru'],
        });
    }

    $("[name=current-link]").click(function () {
        let visible = $(this).attr("show-product");
        let link = $(this).attr("location-link");
        let backType = $(this).attr("back-type");
        let locationType = $(this).attr("location-type");
        let locationData = $(this).attr("location-data");
        let form_data = new FormData();
        form_data.append("visible", visible);
        form_data.append("link_type", "location");
        form_data.append("back_type", backType);
        form_data.append("location_type", locationType);
        form_data.append("location_data", locationData);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
        $.ajax({
            type: "POST",
            url: base_url + "Product_controller/set_link_session",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                location.href = link;
            }
        });
    })

    $("[name=category-link]").click(function () {
        let link = $(this).attr("category-link");
        let visible = $(this).attr("show-product");
        let actionType = $(this).attr("action-type");

        let form_data = new FormData();
        form_data.append("visible", visible);
        form_data.append("link_type", "category");
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        // set localstorage
        let url = decodeURIComponent($(location).attr("href"));
        let categoryUrlString = localStorage.getItem("category_url");
        let categoryUrlObject = JSON.parse(categoryUrlString);
        if (categoryUrlObject == null) {
            let categoryUrl = { 0: url };
            localStorage.setItem("category_url", JSON.stringify(categoryUrl))
        } else {
            let objLength = Object.keys(categoryUrlObject).length
            if (actionType == "button")
                categoryUrlObject[actionType] = url;
            else
                categoryUrlObject[objLength] = url;
            localStorage.setItem("category_url", JSON.stringify(categoryUrlObject))
        }

        $.ajax({
            type: "POST",
            url: base_url + "Product_controller/set_link_session",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                location.href = link;
            }
        });
    })

    $("[name=category-back-link]").click(function () {
        let categoryUrlString = localStorage.getItem("category_url");
        let categoryUrlObject = JSON.parse(categoryUrlString);
        let link = "";
        let visible = 0;
        if (categoryUrlObject == null) {
            link = lang_base_url;
        } else {
            if (!Object.keys(categoryUrlObject).length) {
                link = lang_base_url;
            } else {
                let objKeys = Object.keys(categoryUrlObject);
                let objLength = objKeys.length
                let objKey = objKeys[objLength - 1];
                if (categoryUrlObject[objLength - 1] == undefined) {
                    visible = 1;
                    link = categoryUrlObject[objKey];
                    delete categoryUrlObject[objKey];
                } else {
                    link = categoryUrlObject[objLength - 1];
                    delete categoryUrlObject[objLength - 1];
                }

                localStorage.setItem("category_url", JSON.stringify(categoryUrlObject))
            }
        }

        let form_data = new FormData();
        form_data.append("visible", visible);
        form_data.append("link_type", "category");
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            type: "POST",
            url: base_url + "Product_controller/set_link_session",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                location.href = link;
            }
        });
    })




    $("a[name=ads_link]").click(function () {
        localStorage.setItem("view_link", $(this).attr("view_link"));
        let url = decodeURIComponent($(location).attr("href"));
        let adsUrlString = localStorage.getItem("ads_url");
        let adsUrlObject = JSON.parse(adsUrlString);
        if (adsUrlObject == null) {
            let adsUrl = { 0: url };
            localStorage.setItem("ads_url", JSON.stringify(adsUrl))
        } else {
            let objLength = Object.keys(adsUrlObject).length
            adsUrlObject[objLength] = url;
            localStorage.setItem("ads_url", JSON.stringify(adsUrlObject))
        }
    })
    $(".ads_preview_btn").click(function () {
        localStorage.removeItem("view_link");
        let adsUrlString = localStorage.getItem("ads_url");
        let adsUrlObject = JSON.parse(adsUrlString);
        if (adsUrlObject == null) {
            window.location.href = lang_base_url;
        } else {
            if (!Object.keys(adsUrlObject).length) {
                window.location.href = lang_base_url;
            } else {
                let objLength = Object.keys(adsUrlObject).length
                window.location.href = adsUrlObject[objLength - 1];
                delete adsUrlObject[objLength - 1];
                localStorage.setItem("ads_url", JSON.stringify(adsUrlObject))
            }

        }
    })

    $("a[name=product_edit]").on("click", function () {
        localStorage.setItem("product_link", $(this).attr("product_edit"));
    })

    /* hkm */
    $(".comment-link").on("click", function () {
        if ($(window).width() < 900)
            $("html, body").animate({ scrollTop: 1050 }, 700);
        else
            $("html, body").animate({ scrollTop: 200 }, 700);
        $(".comment-nav-link").trigger("click")
    });
    $(".review-link").on("click", function () {
        if ($(window).width() < 900)
            $("html, body").animate({ scrollTop: 1050 }, 700);
        else
            $("html, body").animate({ scrollTop: 200 }, 700);
        $(".review-nav-link").trigger("click")
    });

    $('button[type="submit"]').on('click', function () {
        localStorage.setItem("profil_settingss_hkm_post", 'yes');
    });

    if (localStorage.getItem('email')) {
        $('input[name=email]').val(localStorage.getItem('email'));
        $('input[name=password]').val(localStorage.getItem('password'));
        $('input[name=remember_me]').attr('checked', true);
    }
    $('.mobile-footer a').click(function () {
        localStorage.setItem("profil_settingss_hkm", null);
        localStorage.setItem('chat_profile_url', "yes");
        localStorage.removeItem("ads_url");
        localStorage.removeItem("category_url");
        localStorage.removeItem("view_link");
    })
    // for chat
    $('.btn-back-mobile-nav').click(function (e) {
        if (localStorage.getItem('chat_profile_url') != "yes" && localStorage.getItem('chat_profile_url') != null) {
            e.preventDefault()
            window.location.href = localStorage.getItem('chat_profile_url');
            localStorage.setItem('chat_profile_url', "yes");
        }
    })

    if (localStorage.getItem("profil_settingss_hkm") != null && $(window).width() < 991) {
        let items = (new Array("hkmprofileupdate", "hkmchangepassword", "hkmshopsettings", "hkmshippingadresse", "hkmcontactinformation", "hkmproducts", "hkmpending_products", "hkmhidden_products", "hkmdrafts", "hkmfavorites", "hkmdownloads", "hkmfollowers", "hkmfollowing", "hkmreviews"));
        if (!items.includes(localStorage.getItem("profil_settingss_hkm")) && localStorage.getItem("profil_settingss_hkm") != null) {
            if (document.getElementById(localStorage.getItem("profil_settingss_hkm")) != null) {
                document.getElementById(localStorage.getItem("profil_settingss_hkm")).click();
            }
        }
    }

    $('.nav-mobile .btn-back-mobile-nav').on('click', function () {
        localStorage.setItem("profil_settingss_hkm", null);
        localStorage.setItem("profil_settingss_hkm_post", null);
    });

    $('.header-favorites').on('click', function () {
        $('.hkmfavorites').css('margin-left', '0%')
        $('html,body').addClass('disable-body-scroll');
    })


    $.extend({
        getUrlVars: function () {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        getUrlVar: function (name) {
            return $.getUrlVars()[name];
        }
    });
    if ($.getUrlVar("page") != null) {
        // hkm_products
        $('.hkm_navCatDownMobile.hkm_mb_products').css({
            "z-index": "9",
            "margin-left": "0%", "display": "block",
        });
        // $('#wrapper').css({"padding-top": "0",});
        $(".hkm_none_userinfo").hide();
        $(".hkm_none_tabs").hide();
        $(".profile-tabs ul.nav").hide();
        $(".mobile-menu").hide();
        $("html, body").animate({ scrollTop: 0 });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            const fileType = input.files[0].type;
            if (validImageTypes.includes(fileType)) {
                reader.onload = function (e) {
                    // mobile
                    $('#img_showw').show();
                    $('.btn_sendd_image').show();
                    $('#remove_immdage').show();
                    $('#img_showw').attr('src', e.target.result);
                    $('.message-reply .form-group textarea').hide();
                    $('.form-group_uplado_images').hide();
                    $('.btn_imogi').hide();

                    // disktop
                    $('.hkm_desctopok_uaieua  #img_showw').show();
                    $('.hkm_desctopok_uaieua  .btn_sendd_image').show();
                    $('.hkm_desctopok_uaieua  #remove_immdage').show();
                    $('.hkm_desctopok_uaieua  #img_showw').attr('src', e.target.result);
                    $('.hkm_desctopok_uaieua  .message-reply .form-group textarea').hide();
                    $('.hkm_desctopok_uaieua  .form-group_uplado_images').hide();
                    $('.hkm_desctopok_uaieua #form_validate').css('height', '390px');
                    $('.hkm_desctopok_uaieua .form-group .btn_uploadd').hide();
                    $('.hkm_desctopok_uaieua .form-group button.btn_send').hide();
                    $('.btn_imogi').hide();
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                $('.file_uplaod_inuptt').val('');
                $('.hkm_desctopok_uaieua .file_uplaod_inuptt').val('');
            }
        }
    }

    //imgUploadd on change
    $("#image_file_mobile").change(function () {
        readURL(this);
    });
    //imgUploadd on change
    $(".hkm_desctopok_uaieua  #image_file_desktop").change(function () {
        readURL(this);
    });

    // remove imge preveiw : mobile
    $('#remove_immdage').on('click', function () {

        $('.file_uplaod_inuptt').val('');
        $('#img_showw').hide();
        $('.btn_sendd_image').hide();
        $('#remove_immdage').hide();
        $('.message-reply .form-group textarea').show();
        $('.form-group_uplado_images').show();
        $('.btn_imogi').show();


    });
    //remove imge preveiw : desktop
    $('.hkm_desctopok_uaieua #remove_immdage').on('click', function () {
        $('.hkm_desctopok_uaieua  .file_uplaod_inuptt').val('');
        $('.hkm_desctopok_uaieua  #img_showw').hide();
        $('.hkm_desctopok_uaieua  .btn_sendd_image').hide();
        $('.hkm_desctopok_uaieua  #remove_immdage').hide();
        $('.hkm_desctopok_uaieua  .message-reply .form-group textarea').show();
        $('.hkm_desctopok_uaieua  .form-group_uplado_images').show();
        $('.hkm_desctopok_uaieua #form_validate').css('height', '77px');
        $('.hkm_desctopok_uaieua .form-group .btn_uploadd').show();
        $('.hkm_desctopok_uaieua .form-group button.btn_send').show();
        $('.btn_imogi').show();
    });

    // send image in chat : descktop ******************************
    $(document).on('click', '#btn_sendd_imagee', function (e) {

        e.preventDefault();
        let form_data = new FormData();
        let files = $('#image_file_desktop')[0].files[0];
        let name = files.name;
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert('ملف  غير معروف');
            return false;
        }
        form_data.append("userfile", $('#image_file_desktop')[0].files[0]);
        form_data.append("conversation_id", $(".hkm_desctopok_uaieua input[name ='conversation_id']").val());
        form_data.append("sender_id", $(".hkm_desctopok_uaieua input[name ='sender_id']").val());
        form_data.append("receiver_id", $(".hkm_desctopok_uaieua input[name ='receiver_id']").val());

        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
        $.ajax({
            type: "POST",
            url: base_url + "Message_controller/send_image_chat",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".hkm_desctopok_uaieua #btn_sendd_imagee").attr('disabled', true);
                $(".hkm_desctopok_uaieua #btn_sendd_imagee").html('....جاري الارسال');
                $(".hkm_desctopok_uaieua #btn_sendd_imagee").css('cursor', 'progress');
            },
            success: function (response) {
                location.reload();
            }
        });

    });

    // send image in chat : mobile **************************
    $(document).on('click', '#btn_sendd_imagee_mobile', function (e) {
        e.preventDefault();
        let form_data = new FormData();
        let files = $('#image_file_mobile')[0].files[0];
        let name = files.name;
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert('ملف  غير معروف');
            return false;
        }
        form_data.append("userfile_mobile", $('#image_file_mobile')[0].files[0]);
        form_data.append("conversation_id", $(".groupemodileuplaodimagtz input[name ='conversation_id']").val());
        form_data.append("sender_id", $(".groupemodileuplaodimagtz input[name ='sender_id']").val());
        form_data.append("receiver_id", $(".groupemodileuplaodimagtz input[name ='receiver_id']").val());

        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
        $.ajax({
            type: "POST",
            url: base_url + "Message_controller/send_image_chat_mobile",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".groupemodileuplaodimagtz #btn_sendd_imagee_mobile").attr('disabled', true);
                $(".groupemodileuplaodimagtz #btn_sendd_imagee_mobile").html('....جاري الارسال');
                $(".groupemodileuplaodimagtz #btn_sendd_imagee_mobile").css('cursor', 'progress');
            },
            success: function (response) {
                location.reload();
            }
        });

    });


    /*==== end send  ==== */

    //main slider
    $("#main-slider").owlCarousel({
        autoplay: true,
        loop: $(".owl-carousel > .item").length <= 2 ? false : true,
        lazyLoad: true,
        slideSpeed: 3000,
        paginationSpeed: 1000,
        items: 1,
        dots: true,
        nav: true,
        navText: ["<i class='icon-arrow-slider-left random-arrow-prev' aria-hidden='true'></i>", "<i class='icon-arrow-slider-right random-arrow-next' aria-hidden='true'></i>"],
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
    });
    $("#product-slider").owlCarousel({
        items: 1,
        autoplay: false,
        nav: true,
        autoHeight: true,
        touchDrag: false,
        mouseDrag: false,
        loop: $(".owl-carousel > .item").length <= 2 ? false : true,
        navText: ["<i class='icon-arrow-slider-left random-arrow-prev' aria-hidden='true'></i>", "<i class='icon-arrow-slider-right random-arrow-next' aria-hidden='true'></i>"],
        dotsContainer: '.dots-container',
    });
    //blog slider
    $("#blog-slider").owlCarousel({
        autoplay: true,
        loop: $(".owl-carousel > .item").length <= 2 ? false : true,
        margin: 20,
        nav: true,
        lazyLoad: true,
        navText: ["<i class='icon-arrow-slider-left random-arrow-prev' aria-hidden='true'></i>", "<i class='icon-arrow-slider-right random-arrow-next' aria-hidden='true'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    //rate product
    $(document).on('click', '.rating-stars .label-star', function () {
        $('#user_rating').val($(this).attr('data-star'));
    });

    //mobile memu
    $(document).on('click', '.btn-open-mobile-nav', function () {
        document.getElementById("navMobile").style.width = "100%";
        $('html').addClass('disable-body-scroll');
        $('body').addClass('disable-body-scroll');
    });


    $(document).on('click', '.btn-close-mobile-nav', function () {
        document.getElementById("navMobile").style.width = "0";
        $('html').removeClass('disable-body-scroll');
        $('body').removeClass('disable-body-scroll');
    });

    var menuFirstAppear = true;
    $(document).on('click', '.btn-back-mobile-nav', function () {
        var back = $(this).data('back');
        var id = $(this).data('ajax');
        var text = $(this).data('text');        
        var type = $(this).data('type');
        var url = $(this).data('url');
        var queryv = $(this).data('query');
        var element = $(this);
        if (windowsearchOpen == undefined)
            switch (back) {
                case "ajax":

                    if ($("#" + type + id).length == 0) {
                        var data = { parent: id, type: type, back: true, lang_base_url: lang_base_url, query: queryv };
                        data[csfr_token_name] = $.cookie(csfr_cookie_name);
                        $.ajax({
                            type: "POST",
                            url: base_url + "ajax_controller/" + url,
                            data: data,
                            success: function (response) {
                                var Modelmenu = $("#MenuMobileModel").clone();
                                Modelmenu.attr('id', type + id);
                                Modelmenu.find(".navbar-nav").html(response);
                                Modelmenu.css('margin-left', "-105%");
                                if (Modelmenu.find("#btn-back-mobile-nav" + id).length > 0) {
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('ajax', Modelmenu.find("#btn-back-mobile-nav" + id).data("ajax"));
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('text', Modelmenu.find("#btn-back-mobile-nav" + id).data("text"));
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('url', Modelmenu.find("#btn-back-mobile-nav" + id).data("url"));
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('query', Modelmenu.find("#btn-back-mobile-nav" + id).data("query"));
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('back', "ajax");
                                    Modelmenu.find("#btn-back-mobile-nav" + id).remove();
                                } else {
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('back', "url");
                                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('url', lang_base_url);
                                }

                                if (oldmenu != undefined) {
                                    oldmenu.css("z-index", "1");
                                    oldmenu.css('margin-left', "105%");
                                }
                                Modelmenu.css("z-index", 1);
                                oldmenu = Modelmenu;

                                Modelmenu.find(".textcat-header").text(text);
                                Modelmenu.find(".btn-back-mobile-nav").data('type', type);
                                $('.ajax-filter-menu').prepend(Modelmenu);
                                if (menuFirstAppear) {
                                    setTimeout(function () {
                                        $("#" + type + id).css('margin-left', "0%");
                                        $('html,body').addClass('disable-body-scroll');
                                    }, 50);
                                    menuFirstAppear = false
                                }
                                else {
                                    $("#" + type + id).css('margin-left', "0%");
                                    $('html,body').addClass('disable-body-scroll');

                                }

                            }
                        });
                    } else {

                        $("#" + type + id).css('margin-left', "105%");

                        if (oldmenu != undefined) {
                            oldmenu.css("z-index", "1");
                            oldmenu.css('margin-left', "105%");
                        }

                        $("#" + type + id).css("z-index", 1);
                        oldmenu = $("#" + type + id);

                        // setTimeout(function () {
                        $("#" + type + id).css('margin-left', "0%");

                        $('html,body').addClass('disable-body-scroll');
                        // }, 50);


                    }
                    break;
                case "normal":
                    $(this).parents('.navCatDownMobile').css('margin-left', "105%");
                    $('html').removeClass('disable-body-scroll');
                    $('body').removeClass('disable-body-scroll');
                    break;
                case "url":
                    window.location.href = url;
                    break;
            }
        else {

            windowsearchOpen.css('margin-left', "100%");
            windowsearchOpen.css('z-index', "1");
            windowsearchOpen = undefined;
        }
    });


    $(document).on('click', '.close-mobile-nav', function () {
        document.getElementById("navMobile").style.width = "0";
    });
    $(document).on('click', '.has-menu', function () {
        var id = $(this).data('ajax');
        var customCountryId = $(this).attr('data-ajax');
        var url = $(this).data('url');
        var type = $(this).data('type');
        var text = $(this).attr('header-text')
        if (!text) {
            var text = $(this).text().trim();
        }
        var queryv = $(this).data('query');
        // $(this).css("border", "1px solid #e8e8e8")

        if ($("#" + type + id).length == 0) {
            var data = { parent: id, type: type, text: text, lang_base_url: lang_base_url, query: queryv, custom_country_id: customCountryId, other_text: $(this).text().trim() };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "ajax_controller/" + url,
                data: data,
                success: function (response) {
                    var Modelmenu = $("#MenuMobileModel").clone();
                    Modelmenu.attr('id', type + id);
                    Modelmenu.find(".navbar-nav").html(response);
                    Modelmenu.find(".btn-back-mobile-nav").data('ajax', id);
                    Modelmenu.find(".textcat-header").text(text);
                    Modelmenu.find(".btn-back-mobile-nav").data('type', type);
                    Modelmenu.find(".btn-back-mobile-nav").eq(0).data('back', "normal");
                    $('.ajax-filter-menu').append(Modelmenu);

                    if (oldmenu != undefined) {
                        oldmenu.css("z-index", "1");
                    }
                    Modelmenu.css("z-index", 2);
                    oldmenu = Modelmenu;
                    setTimeout(function () {
                        if (typeof data.back != "undefined" && data.back == true)
                            $("#" + type + id).css('margin-left', "105%");
                        else
                            $("#" + type + id).css('margin-left', "0%");
                        $('html,body').addClass('disable-body-scroll');
                    }, 50);
                }
            });
        } else {
            console.log('type: ' + type + ' :id ' + id);
            $("#" + type + id).css('margin-left', "100%");

            if (oldmenu != undefined) {
                oldmenu.css({ "z-index": '1 !important' });
            }

            $("#" + type + id).css({ "z-index": '2 !important' });
            oldmenu = $("#" + type + id);

            setTimeout(function () {
                $("#" + type + id).css('margin-left', "0%");
                $('html,body').addClass('disable-body-scroll');
            }, 50);
        }
    });
    $(document).on('click', '.has-event', function () {
        let href = $(this).attr('href');
        let data_id = $(this).attr('data-ajax');
        let text = $(this).attr('data-text');
        $('.catgegory-name').text(text)
        $('.ajax-filter-menu').find('.navCatDownMobile.nav-mobile').slice(1, 10).remove();
        $('html,body').removeClass('disable-body-scroll');
        let form_data = new FormData();
        form_data.append("id", data_id);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
        $('form').attr('action', href)
        $.ajax({
            type: "POST",
            url: base_url + "Product_controller/custom_field_data",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('.custom-field-container').children().detach()
                let jsonData = JSON.parse(response);
                console.log(jsonData);
                for (let i in jsonData) {
                    let html = `<div class="row d-block text-left m-b-15">
                                <h4 class="col-md-12 title">${jsonData[i].name}</h4>
                                <div class="col-md-12 filter-list-container">`;

                    if (jsonData[i].field_type == 'dropdown') {
                        let data = jsonData[i].data;
                        html += `<div class="mobile-filter-list">
                                    <div class="selectdiv">
                                    <select id="${jsonData[i].product_filter_key}" name="${jsonData[i].product_filter_key}" class="form-control">
                                    <option value="">Select an option</option>`;
                        for (let j in data) {
                            html += `<option value="${data[j].field_option}">${data[j].field_option}</option>`;
                        }
                        html += `</select></div>`;
                    } else if (jsonData[i].field_type == 'radio_button') {
                        let data = jsonData[i].data;
                        for (let j in data) {
                            html += `<div class="mobile-filter-list">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="${jsonData[i].product_filter_key}" id="filter_option_${jsonData[i].id}-${data[j].id}" value="${data[j].field_option}" class="custom-control-input">
                                            <label for="filter_option_${jsonData[i].id}-${data[j].id}" class="custom-control-label">${data[j].field_option}</label>
                                        </div>
                                    </div>`;
                        }
                    } else if (jsonData[i].field_type == 'popup') {
                        html += `<div class="mobile-filter-list">
                                    <div class="mobile_selectdiv" style="width: 100%">
                                        <button class="filter-btn text-truncate has-menu d-flex" type="button" data-ajax="0" data-type="${jsonData[i].product_filter_key}" data-query="field_id=${jsonData[i].id}&input" data-url="mobile_filter" style="height:50px;padding: 0 10px 0 10px" >
                                            <img src="https://image.flaticon.com/icons/svg/95/95090.svg" class="align-self-center mr-1 ml-1" alt="Menu" style="width: 15px; filter:invert(47%) sepia(1%) saturate(8%) hue-rotate(87deg) brightness(119%) contrast(119%);">
                                            <div class="titre  m-0 flex-fill  h-100 text-truncate  text-left special-cagetory" style="padding-left:5px">
                                                <span name="${jsonData[i].product_filter_key}">${jsonData[i].name}</span>
                                            </div>
                                            <i class="icon-arrow-right"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="${jsonData[i].product_filter_key}" />
                                </div>`;
                    } else {
                        let data = jsonData[i].data;
                        for (let j in data) {
                            html += `<div class="mobile-filter-list">
                                        <div class="custom-control custom-checkbox">
                                            <input type="radio" name="${jsonData[i].product_filter_key}" id="filter_option_${jsonData[i].id}-${data[j].id}" value="${data[j].field_option}" class="custom-control-input">
                                            <label for="filter_option_${jsonData[i].id}-${data[j].id}" class="custom-control-label"></label>
                                        </div>
                                    </div>`;
                        }
                    }
                    html += `</div></div>`;
                    $('.custom-field-container').append(html);
                }
            }
        });
    })

    $(document).on('click', '.remove-menu', function () {
        var category_id = $(this).attr('category_id')
        var category_name = $(this).attr('category_name')

        $('html').removeClass('disable-body-scroll');
        $('body').removeClass('disable-body-scroll');

        $(".ajax-filter-menu").children().each(function (key) {
            if (key > 1) {
                $(this).remove()
            }
        });
        $('.special-cagetory').text(category_name)
        $('#category_id').val(category_id)
    })

    var windowsearchOpen = undefined;

    $('.has-search-product').focus(function () {
        $('html,body').addClass('disable-body-scroll');
    });

    $('.has-search-product').blur(function () {
        // $('.clearable-content').html('');
        // $('.clearable-content').css('display', 'none');
        // $('html,body').removeClass('disable-body-scroll');
    });


    var timeoutsearchproduct;
    $('.has-search-product').on('input', function () {
        var winPoint = $(this)
        setTimeout(function(){
            var url = winPoint.data('url');
            var text = winPoint.text().trim();
            var queryv = winPoint.data('query');
            var val = winPoint.val();
            var data = { search: winPoint.val(), lang_base_url: lang_base_url, query: queryv };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            //kill the request
            if (timeoutsearchproduct)
                timeoutsearchproduct.abort()
            //clearTimeout(timeoutsearchproduct);
            if (val != "") {
                timeoutsearchproduct = $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/" + url,
                    data: data,
                    success: function (response) {
                        $('html,body').addClass('disable-body-scroll');
                        $('.clearable-content').css('display', 'block');
                        $('.clearable-content').html(response);
                    }
                });
            } else {
                $('.clearable-content').html('');
                $('.clearable-content').css('display', 'none');
                $('html,body').removeClass('disable-body-scroll');
            }
        }, 200)

    });

    $("#loginModal").on("hidden.bs.modal", function () {
        if ($('body').hasClass('disable-body-scroll')) {
            $('html').removeClass('disable-body-scroll');
            $('body').removeClass('disable-body-scroll');
        }
    });

});

/*
$(function () {
	$(".search-results-location").niceScroll({ cursorcolor: "#c2c2c2" });
	$(".slider-custom-scrollbar").niceScroll({ cursorcolor: "transparent", cursorborder: '0' });
	$(".filter-custom-scrollbar").niceScroll({ cursorcolor: "#c2c2c2", autohidemode: false });
	$(".messages-sidebar").niceScroll({ cursorcolor: "#c2c2c2", autohidemode: false });
});
if ($('.message-custom-scrollbar').length > 0) {
	$(".message-custom-scrollbar").niceScroll({ cursorcolor: "#c2c2c2", autohidemode: false });
	$(".message-custom-scrollbar").scrollTop($('.message-custom-scrollbar').get(0).scrollHeight, -1);
}
*/

//magnific popup
$(document).ready(function () {
    $(".product-slider-container .swiper-slide").on('click', function () {
        $("#imageModal").modal("show");
        setTimeout(function () {
            let modalSwiper = new Swiper('.image-modal-content .swiper-container', {
                pagination: {
                    el: '.swiper-pagination',
                    type: 'fraction',
                },
                loop: true,
                zoom: {
                    maxRatio: 5,
                },
            });

            modalSwiper.slideTo(swiper.activeIndex, 0);
            modalSwiper.on('touchMoveOpposite', function () {
                $("#imageModal").modal("hide");
            })
        }, 500)
    })
    $(".image-preview-close").on("click", function () {
        $("#imageModal").modal("hide");
    })
});

/*mega menu*/
$(".mega-menu .nav-item").hover(function () {
    var menu_id = $(this).attr('data-category-id');
    $("#mega_menu_content_" + menu_id).show();
    $(".large-menu-item").removeClass('active');
    $(".large-menu-item-first").addClass('active');
    $(".large-menu-content-first").addClass('active');
}, function () {
    var menu_id = $(this).attr('data-category-id');
    $("#mega_menu_content_" + menu_id).hide();
});

$(".mega-menu .dropdown-menu").hover(function () {
    $(this).show();
}, function () {
});

$(".large-menu-item").hover(function () {
    var menu_id = $(this).attr('data-subcategory-id');
    $(".large-menu-item").removeClass('active');
    $(this).addClass('active');
    $(".large-menu-content").removeClass('active');
    $("#large_menu_content_" + menu_id).addClass('active');
}, function () {
});


//scrollup
$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        if ((window.location.pathname.indexOf("/conversation/") == 9 || window.location.pathname.indexOf("/conversation/") == 12) && $(window).width() < 900) {
            $('.scrollup').fadeOut();
        } else if ((window.location.pathname == "/sell-now" || window.location.pathname == "/sell-now/" || window.location.pathname.indexOf("/sell-now") == 3) && $(window).width() < 900) {
            $('.scrollup').fadeOut();
        } else if ((window.location.pathname == "/contact" || window.location.pathname == "/contact/" || window.location.pathname.indexOf("/contact") == 3) && $(window).width() < 900) {
            $('.scrollup').fadeOut();
        } else if ((window.location.pathname == "/messages" || window.location.pathname == "/messages/" || window.location.pathname.indexOf("/messages") == 3) && $(window).width() < 900) {
            $('.scrollup').fadeOut();
        } else {
            $(".scrollup").fadeIn();
        }
    } else {
        $(".scrollup").fadeOut();
    }
});
$(".scrollup").click(function () { /*hkm*/
    // if ($(window).width() > 900) {
    $("html, body").animate({ scrollTop: 0 }, 700);
    // } else {
    //     return true;
    // }
    // return false
});

$(function () {
    $(".search-select a").click(function () {
        $(".search-select .btn").text($(this).text());
        $(".search-select .btn").val($(this).text());
        $(".search_type_input").val($(this).attr("data-value"));
    });
});

$(document).on('click', '.quantity-select-product .dropdown-menu .dropdown-item', function () {
    $(".quantity-select-product .btn span").text($(this).text());
    $("input[name='product_quantity']").val($(this).text());
});

//set default location
function set_default_location(location_id) {
    var data = {
        location_id: location_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "home_controller/set_default_location",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
}

//show phone number
$(document).on('click', '#show_phone_number', function () {
    $(this).hide();
    $("#phone_number").show();
});
//show phone number
$(document).on('click', '#show_phone_number2', function () {
    $(this).hide();
    $("#phone_number2").show();
});

/*
 *------------------------------------------------------------------------------------------
 * AUTH FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//login
$(document).ready(function () {
    $("#form_login").submit(function (event) {
        // event.preventDefault()
        var form = $(this);
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            var inputs = form.find("input, select, button, textarea");
            var serializedData = form.serializeArray();
            serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
            if (serializedData[2].name == 'remember_me') {
                localStorage.setItem('email', serializedData[0].value)
                localStorage.setItem('password', serializedData[1].value)
            } else {
                var u_email = localStorage.getItem('email');
                if (u_email == serializedData[0].value) {
                    localStorage.setItem('email', "")
                    localStorage.setItem('password', "")
                }
            }
            $.ajax({
                url: base_url + "auth_controller/login_post",
                type: "post",
                data: serializedData,
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        location.reload();
                    } else if (obj.result == 0) {
                        document.getElementById("result-login").innerHTML = obj.error_message;
                    }
                }
            });
        }
        form[0].classList.add('was-validated');
    });

    // language hkm  */
    if (window.location.pathname.indexOf("/ar") == 0) {
        set_site_language(2);
    } else {
        set_site_language(1);
    }
});

//send activation email
function send_activation_email(id, token) {
    $('#result-login').empty();
    $('.spinner-activation-login').show();
    var data = {
        'id': id,
        'token': token,
        'type': 'login'
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $('#submit_review').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: base_url + "auth_controller/send_activation_email_post",
        data: data,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                $('.spinner-activation-login').hide();
                document.getElementById("result-login").innerHTML = obj.success_message;
            } else {
                location.reload();
            }
        }
    });
}

//send activation email register
function send_activation_email_register(id, token) {
    $('#result-register').empty();
    $('.spinner-activation-register').show();
    var data = {
        'id': id,
        'token': token,
        'type': 'register'
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $('#submit_review').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: base_url + "auth_controller/send_activation_email_post",
        data: data,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                $('.spinner-activation-register').hide();
                document.getElementById("result-register").innerHTML = obj.success_message;
            } else {
                location.reload();
            }
        }
    });
}

/*
 *------------------------------------------------------------------------------------------
 * REVIEW FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//make review
$(document).on('click', '#submit_review', function () {
    var user_rating = $.trim($('#user_rating').val());
    var user_review = $.trim($('#user_review').val());
    var product_id = $.trim($('#review_product_id').val());
    var limit = parseInt($("#product_review_limit").val());
    if (!user_rating) {
        $('.rating-stars').addClass('invalid-rating');
        return false;
    } else {
        $('.rating-stars').removeClass('invalid-rating');
    }
    var data = {
        "review": user_review,
        "rating": user_rating,
        "product_id": product_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $('#submit_review').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/make_review",
        data: data,
        success: function (response) {
            $('#submit_review').prop("disabled", false);
            if (response == "voted_error") {
                $('.error-reviewed').show();
            } else if (response == "error_own_product") {
                $('.error-own-product').show();
            } else {
                document.getElementById("review-result").innerHTML = response;
            }
        }
    });
});

//load more review
function load_more_review(product_id) {
    var limit = parseInt($("#product_review_limit").val());
    var data = {
        "product_id": product_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#load_review_spinner").show();
    $.ajax({
        method: "POST",
        url: base_url + "product_controller/load_more_review",
        data: data
    })
        .done(function (response) {
            setTimeout(function () {
                $("#load_review_spinner").hide();
                document.getElementById("review-result").innerHTML = response
            }, 1000);
        })
}

//delete review
function delete_review(review_id, product_id, user_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var limit = parseInt($("#product_review_limit").val());
            var data = {
                "id": review_id,
                "product_id": product_id,
                "user_id": user_id,
                "limit": limit,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "product_controller/delete_review",
                data: data
            })
                .done(function (response) {
                    document.getElementById("review-result").innerHTML = response;
                })
        }
    });
}


/*
*------------------------------------------------------------------------------------------
* USER REVIEW FUNCTIONS
*------------------------------------------------------------------------------------------
*/

//add user review
$(document).on('click', '#submit_user_review', function () {
    var user_rating = $.trim($('#user_rating').val());
    var user_review = $.trim($('#user_review').val());
    var seller_id = $.trim($('#review_seller_id').val());
    var limit = parseInt($("#user_review_limit").val());

    if (!user_rating) {
        $('.rating-stars').addClass('invalid-rating');
        return false;
    } else {
        $('.rating-stars').removeClass('invalid-rating');
    }
    var data = {
        "review": user_review,
        "rating": user_rating,
        "seller_id": seller_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $('#submit_user_review').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/add_user_review",
        data: data,
        success: function (response) {
            $('#submit_user_review').prop("disabled", false);
            if (response == "voted_error") {
                $('.error-reviewed').show();
            } else {
                location.reload();
            }
        }
    });
});

//load more user review
function load_more_user_review(seller_id) {
    var limit = parseInt($("#user_review_limit").val());
    var data = {
        "seller_id": seller_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#load_review_spinner").show();
    $.ajax({
        method: "POST",
        url: base_url + "ajax_controller/load_more_user_review",
        data: data
    })
        .done(function (response) {
            setTimeout(function () {
                $("#load_review_spinner").hide();
                document.getElementById("user-review-result").innerHTML = response
            }, 1000);
        })
}

//delete user review
function delete_user_review(review_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "review_id": review_id,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "ajax_controller/delete_user_review",
                data: data
            })
                .done(function (response) {
                    location.reload();
                })
        }
    });
}


/*
 *------------------------------------------------------------------------------------------
 * BLOG COMMENTS FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//make blog comment
$(document).ready(function () {
    var request;
    //make registered comment
    $("#make_blog_comment_registered").submit(function (event) {
        event.preventDefault();
        var comment_text = $.trim($('#comment_text').val());
        if (comment_text.length < 1) {
            $('#comment_text').addClass("is-invalid");
            return false;
        } else {
            $('#comment_text').removeClass("is-invalid");
        }
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var limit = parseInt($("#blog_comment_limit").val());

        var serializedData = $form.serializeArray();
        serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
        serializedData.push({ name: "lang_folder", value: lang_folder });
        serializedData.push({ name: "limit", value: limit });
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: base_url + "home_controller/add_comment_post",
            type: "post",
            data: serializedData,
        });
        request.done(function (response) {
            $inputs.prop("disabled", false);
            document.getElementById("comment-result").innerHTML = response;
            $("#make_blog_comment_registered")[0].reset();
        });

    });

    //make comment
    $("#make_blog_comment").submit(function (event) {
        event.preventDefault();
        var comment_name = $.trim($('#comment_name').val());
        var comment_email = $.trim($('#comment_email').val());
        var comment_text = $.trim($('#comment_text').val());

        if (comment_name.length < 1) {
            $('#comment_name').addClass("is-invalid");
            return false;
        } else {
            $('#comment_name').removeClass("is-invalid");
        }
        if (comment_email.length < 1) {
            $('#comment_email').addClass("is-invalid");
            return false;
        } else {
            $('#comment_email').removeClass("is-invalid");
        }
        if (comment_text.length < 1) {
            $('#comment_text').addClass("is-invalid");
            return false;
        } else {
            $('#comment_text').removeClass("is-invalid");
        }

        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var limit = parseInt($("#blog_comment_limit").val());
        var serializedData = $form.serializeArray();
        serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
        serializedData.push({ name: "limit", value: limit });
        serializedData.push({ name: "lang_folder", value: lang_folder });

        var recaptcha_status = true;
        if (is_recaptcha_enabled == true) {
            $(serializedData).each(function (i, field) {
                if (field.name == "g-recaptcha-response") {
                    if (field.value == "") {
                        $('.g-recaptcha').addClass("is-recaptcha-invalid");
                        recaptcha_status = false;
                    }
                }
            });
        }
        if (recaptcha_status == true) {
            $('.g-recaptcha').removeClass("is-recaptcha-invalid");
            $inputs.prop("disabled", true);
            request = $.ajax({
                url: base_url + "home_controller/add_comment_post",
                type: "post",
                data: serializedData,
            });
            request.done(function (response) {
                $inputs.prop("disabled", false);
                if (is_recaptcha_enabled == true) {
                    grecaptcha.reset();
                }
                document.getElementById("comment-result").innerHTML = response;
                $("#make_blog_comment")[0].reset();
            });
        }
    });
});

//load more blog comment
function load_more_blog_comment(post_id) {
    var limit = parseInt($("#blog_comment_limit").val());
    var data = {
        "post_id": post_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#load_comment_spinner").show();
    $.ajax({
        method: "POST",
        url: base_url + "home_controller/load_more_comment",
        data: data
    })
        .done(function (response) {
            setTimeout(function () {
                $("#load_comment_spinner").hide();
                document.getElementById("comment-result").innerHTML = response
            }, 1000)
        })
}

//delete blog comment
function delete_blog_comment(comment_id, post_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var limit = parseInt($("#blog_comment_limit").val());
            var data = {
                "comment_id": comment_id,
                "post_id": post_id,
                "limit": limit,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "home_controller/delete_comment_post",
                data: data
            })
                .done(function (response) {
                    document.getElementById("comment-result").innerHTML = response

                })
        }
    });
}


/*
 *------------------------------------------------------------------------------------------
 * PRODUCT COMMENT FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

$(document).ready(function () {
    var request;
    //make registered comment
    $("#make_comment_registered").submit(function (event) {
        console.log("here")
        event.preventDefault();
        var comment_text = $.trim($('#comment_text').val());
        if (comment_text.length < 1) {
            $('#comment_text').addClass("is-invalid");
            return false;
        } else {
            $('#comment_text').removeClass("is-invalid");
        }
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var limit = parseInt($("#product_comment_limit").val());

        var serializedData = $form.serializeArray();
        serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
        serializedData.push({ name: "lang_folder", value: lang_folder });
        serializedData.push({ name: "limit", value: limit });

        $inputs.prop("disabled", true);
        request = $.ajax({
            url: base_url + "product_controller/make_comment",
            type: "post",
            data: serializedData,
        });
        request.done(function (response) {
            $inputs.prop("disabled", false);
            if (response == "error_own_product") {
                $('.error-own-product').show();
                $('textarea[name=comment]').val('');
            } else {
                document.getElementById("comment-result").innerHTML = response;
                $("#make_comment_registered")[0].reset();
            }
        });
    });

    //make comment
    $("#make_comment").submit(function (event) {
        event.preventDefault();
        var comment_name = $.trim($('#comment_name').val());
        var comment_email = $.trim($('#comment_email').val());
        var comment_text = $.trim($('#comment_text').val());

        if (comment_name.length < 1) {
            $('#comment_name').addClass("is-invalid");
            return false;
        } else {
            $('#comment_name').removeClass("is-invalid");
        }
        if (comment_email.length < 1) {
            $('#comment_email').addClass("is-invalid");
            return false;
        } else {
            $('#comment_email').removeClass("is-invalid");
        }
        if (comment_text.length < 1) {
            $('#comment_text').addClass("is-invalid");
            return false;
        } else {
            $('#comment_text').removeClass("is-invalid");
        }

        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var limit = parseInt($("#product_comment_limit").val());

        var serializedData = $form.serializeArray();
        serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
        serializedData.push({ name: "lang_folder", value: lang_folder });
        serializedData.push({ name: "limit", value: limit });

        var recaptcha_status = true;
        if (is_recaptcha_enabled == true) {
            $(serializedData).each(function (i, field) {
                if (field.name == "g-recaptcha-response") {
                    if (field.value == "") {
                        $('.g-recaptcha').addClass("is-recaptcha-invalid");
                        recaptcha_status = false;
                    }
                }
            });
        }
        if (recaptcha_status == true) {
            $('.g-recaptcha').removeClass("is-recaptcha-invalid");
            $inputs.prop("disabled", true);
            request = $.ajax({
                url: base_url + "product_controller/make_comment",
                type: "post",
                data: serializedData,
            });
            request.done(function (response) {
                $inputs.prop("disabled", false);
                if (is_recaptcha_enabled == true) {
                    grecaptcha.reset();
                }
                document.getElementById("comment-result").innerHTML = response;
                $("#make_comment")[0].reset();

            });
        }
    });

});

//make registered subcomment
$(document).on('click', '.btn-subcomment-registered', function () {
    var comment_id = $(this).attr("data-comment-id");
    var data = {
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#make_subcomment_registered_" + comment_id).ajaxSubmit({
        beforeSubmit: function () {
            var form = $("#make_subcomment_registered_" + comment_id).serializeArray();
            var comment = $.trim(form[0].value);
            if (comment.length < 1) {
                $(".form-comment-text").addClass("is-invalid");
                return false;
            } else {
                $(".form-comment-text").removeClass("is-invalid");
            }
        },
        type: "POST",
        url: base_url + "product_controller/make_comment",
        data: data,
        success: function (response) {
            document.getElementById("comment-result").innerHTML = response;
        }
    })
});

//make subcomment
$(document).on('click', '.btn-subcomment', function () {
    var comment_id = $(this).attr("data-comment-id");
    var data = {
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#make_subcomment_" + comment_id).ajaxSubmit({
        beforeSubmit: function () {
            var form = $("#make_subcomment_" + comment_id).serializeArray();
            var name = $.trim(form[0].value);
            var email = $.trim(form[1].value);
            var comment = $.trim(form[2].value);
            if (is_recaptcha_enabled == true) {
                var recaptcha = $.trim(form[3].value);
            }

            if (name.length < 1) {
                $(".form-comment-name").addClass("is-invalid");
                return false;
            } else {
                $(".form-comment-name").removeClass("is-invalid");
            }
            if (email.length < 1) {
                $(".form-comment-email").addClass("is-invalid");
                return false;
            } else {
                $(".form-comment-email").removeClass("is-invalid");
            }
            if (comment.length < 1) {
                $(".form-comment-text").addClass("is-invalid");
                return false;
            } else {
                $(".form-comment-text").removeClass("is-invalid");
            }
            if (is_recaptcha_enabled == true) {
                if (recaptcha == "") {
                    $("#make_subcomment_" + comment_id + ' .g-recaptcha').addClass("is-recaptcha-invalid");
                    return false;
                } else {
                    $("#make_subcomment_" + comment_id + ' .g-recaptcha').removeClass("is-recaptcha-invalid");
                }
            }
        },
        type: "POST",
        url: base_url + "product_controller/make_comment",
        data: data,
        success: function (response) {
            if (is_recaptcha_enabled == true) {
                grecaptcha.reset();
            }
            document.getElementById("comment-result").innerHTML = response;
        }
    })
});

//load more comment
function load_more_comment(product_id) {
    var limit = parseInt($("#product_comment_limit").val());
    var data = {
        "product_id": product_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#load_comment_spinner").show();
    $.ajax({
        method: "POST",
        url: base_url + "product_controller/load_more_comment",
        data: data
    })
        .done(function (response) {
            setTimeout(function () {
                $("#load_comment_spinner").hide();
                document.getElementById("comment-result").innerHTML = response;
            }, 1000)
        })
}

//delete comment
function delete_comment(comment_id, product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var limit = parseInt($("#product_comment_limit").val());
            var data = {
                "id": comment_id,
                "product_id": product_id,
                "limit": limit,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "product_controller/delete_comment",
                data: data
            })
                .done(function (response) {
                    document.getElementById("comment-result").innerHTML = response;
                })

        }
    });
}

//show comment box
function show_comment_box(comment_id) {
    $('.visible-sub-comment').empty();
    var limit = parseInt($("#product_comment_limit").val());
    var data = {
        "comment_id": comment_id,
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/load_subcomment_box",
        data: data,
        success: function (response) {
            $('#sub_comment_form_' + comment_id).append(response);
        }
    });
}


/*
 *------------------------------------------------------------------------------------------
 * MESSAGE FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//delete conversation
function delete_conversation(conversation_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "conversation_id": conversation_id,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "message_controller/delete_conversation",
                data: data
            })
                .done(function (response) {
                    window.location.href = base_url + "messages";
                })

        }
    });
}


/*
 *------------------------------------------------------------------------------------------
 * CART FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//remove from cart
function remove_from_cart(cart_item_id) {
    var data = {
        "cart_item_id": cart_item_id,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "cart_controller/remove_from_cart",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

//update cart product quantity
$(document).on('click', '.btn-cart-product-quantity-item', function () {
    var quantity = $(this).val();
    var product_id = $(this).attr("data-product-id");
    var data = {
        "product_id": product_id,
        "quantity": quantity,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "cart_controller/update_cart_product_quantity",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
});

$(document).ready(function () {
    $('#use_same_address_for_billing').change(function () {
        if ($(this).is(":checked")) {
            $('.cart-form-billing-address').hide();
        } else {
            $('.cart-form-billing-address').show();
        }
    });
});

//approve order product
function approve_order_product(id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (approve) {
        if (approve) {
            var data = {
                "order_product_id": id,
                "lang_folder": lang_folder
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "order_controller/approve_order_product_post",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};


/*
 *------------------------------------------------------------------------------------------
 * OTHER FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//AJAX search
$(document).on("input paste focus", "#input_search", function () {
    var search_type = $('.search_type_input').val();
    var input_value = $(this).val();
    if (input_value.length < 2) {
        $('#response_search_results').hide();
        return false;
    }
    var data = {
        "search_type": search_type,
        "input_value": input_value
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/ajax_search",
        data: data,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                document.getElementById("response_search_results").innerHTML = obj.response;
                $('#response_search_results').show();
            }
            //search text
            $('#response_search_results ul li a').wrapInTag({
                words: [input_value]
            });
        }
    });
});

$(document).on('click', function (e) {
    if ($(e.target).closest(".top-search-bar").length === 0) {
        $("#response_search_results").hide();
    }
});

//search lcoation
$(document).on("input paste focus", "#input_location", function () {
    var input_value = $(this).val();
    if (input_value.length < 2) {
        $('#response_search_location').hide();
        return false;
    }
    var data = {
        "input_value": input_value
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/search_location",
        data: data,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                document.getElementById("response_search_location").innerHTML = obj.response;
                $('#response_search_location').show();
            }
            //search text
            $('#response_search_location ul li a').wrapInTag({
                words: [input_value]
            });
        }
    });
});

$.fn.wrapInTag = function (opts) {
    function getText(obj) {
        return obj.textContent ? obj.textContent : obj.innerText;
    }

    var tag = opts.tag || 'strong',
        words = opts.words || [],
        regex = RegExp(words.join('|'), 'gi'),
        replacement = '<' + tag + '>$&</' + tag + '>';
    $(this).contents().each(function () {
        if (this.nodeType === 3) {
            $(this).replaceWith(getText(this).replace(regex, replacement));
        } else if (!opts.ignoreChildNodes) {
            $(this).wrapInTag(opts);
        }
    });
};

//set location
$(document).on("click", "#response_search_location ul li a", function () {
    var country_id = $(this).attr('data-country');
    var state_id = $(this).attr('data-state');
    var city_id = $(this).attr('data-city');
    $('.input-location-filter').remove();
    if (country_id != null && country_id != 0) {
        $('.filter-location').append("<input type='hidden' value='" + country_id + "' name='country' class='input-location-filter'>");
    }
    if (state_id != null && state_id != 0) {
        $('.filter-location').append("<input type='hidden' value='" + state_id + "' name='state' class='input-location-filter'>");
    }
    if (city_id != null && city_id != 0) {
        $('.filter-location').append("<input type='hidden' value='" + city_id + "' name='city' class='input-location-filter'>");
    }
    /*$('#form-product-filters').submit();*/
});

$(document).on('click', function (e) {
    if ($(e.target).closest(".filter-location").length === 0) {
        $("#response_search_location").hide();
    }
});

//set site language
function set_site_language(lang_id) {
    var data = {
        lang_id: lang_id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        method: "POST",
        url: base_url + "home_controller/set_site_language",
        data: data
    })
        .done(function (response) {
            /*location.reload();*/
        })
}


$(document).on('click', '#btn_load_more_promoted', function () {
    $("#load_promoted_spinner").show();
    var limit = $("#input_promoted_products_limit").val();
    var per_page = $("#input_promoted_products_per_page").val();
    var promoted_products_count = $("#input_promoted_products_count").val();
    var new_limit = parseInt(limit) + parseInt(per_page);
    var data = {
        "limit": limit,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "home_controller/load_more_promoted_products",
        data: data,
        success: function (response) {
            $("#input_promoted_products_limit").val(new_limit);
            setTimeout(function () {
                $("#load_promoted_spinner").hide();
                $("#row_promoted_products").append(response);
                if (new_limit >= promoted_products_count) {
                    $("#btn_load_more_promoted").hide();
                }
            }, 700)
        }
    });

});

//delete product
function delete_product(product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "id": product_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "product_controller/delete_product",
                data: data
            })
                .done(function (response) {
                    location.reload();
                })

        }
    });
}

//delete draft
function delete_draft(product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "id": product_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "product_controller/delete_draft",
                data: data
            })
                .done(function (response) {
                    location.reload();
                })
        }
    });
}

//set product as sold
function set_product_as_sold(product_id) {
    var data = {
        "product_id": product_id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        method: "POST",
        url: base_url + "product_controller/set_product_as_sold",
        data: data
    })
        .done(function (response) {
            location.reload();
        })
}

//delete product digital file
function delete_product_digital_file(product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "product_id": product_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                url: base_url + "file_controller/delete_digital_file",
                type: "post",
                data: data,
                success: function (response) {
                    document.getElementById("digital_files_upload_result").innerHTML = response;
                }
            });
        }
    });
}

//delete product video preview
function delete_product_video_preview(product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "product_id": product_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                url: base_url + "file_controller/delete_video",
                type: "post",
                data: data,
                success: function (response) {
                    document.getElementById("video_upload_result").innerHTML = response;
                }
            });
        }
    });
}

//delete product audio preview
function delete_product_audio_preview(product_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "product_id": product_id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                url: base_url + "file_controller/delete_audio",
                type: "post",
                data: data,
                success: function (response) {
                    document.getElementById("audio_upload_result").innerHTML = response;
                }
            });
        }
    });
}


function send_message_as_email(message_sender_id, message_receiver_id, message_subject, message_text) {
    var data = {
        'email_type': 'new_message',
        'sender_id': message_sender_id,
        "receiver_id": message_receiver_id,
        "message_subject": message_subject,
        "message_text": message_text,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/send_email",
        data: data,
        success: function (response) {

        }
    });
}

function send_message_ads_email(message_sender_id, message_receiver_id, message_subject, message_text, img_src, slug) {
    var data = {
        'email_type': 'new_ads_message',
        'sender_id': message_sender_id,
        "receiver_id": message_receiver_id,
        "message_subject": message_subject,
        "message_text": message_text,
        "img_src": img_src,
        "slug": slug,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/send_email",
        data: data,
        success: function (response) {

        }
    });
}


//get subcategories
function get_subcategories(element, index = 0) {
    let val = element.value;
    var data = {
        "parent_id": val,
        lang_base_url: lang_base_url
    };
    $(element).nextAll().remove();
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        async: window.async || true,
        url: base_url + "ajax_controller/get_subcategories",
        data: data,
        success: function (response) {
            if (response != '' && val != '') {

                $("#listcategories").append(
                    '<select name="second_parent_id[' + (index + 1) + ']" required  id="cat_' + val + '"' +
                    'class="form-control" style="margin-top: 15px;" ' +
                    'onchange="get_subcategories(this,' + (index + 1) + ');"></select>');

                $("#cat_" + val).rules('add', 'required');

                $("#cat_" + val).append($(element).children().first().clone())
                    .append(response);


            }

        }
    });
}


function show_subcategories_by_parent_id(parent_id) {
    $('#subcategory_dropdown select').find('option:not(:first)').remove();
    $('#third_category_dropdown select').find('option:not(:first)').remove();
    $('#subcategory_dropdown').hide();
    $('#third_category_dropdown').hide();

    if ($(".category-option-" + parent_id)[0]) {
        $(".category-option-" + parent_id).each(function () {
            var op_val = $(this).attr('data-id');
            var op_text = $(this).attr('data-name');
            $('#subcategory_dropdown select').append('<option value="' + op_val + '">' + op_text + '</option>');
        });
        $("#subcategory_dropdown select").val("");
        $("#third_category_dropdown select").val("");
        $('#subcategory_dropdown').show();
    }
}


function show_third_categories_by_parent_id(parent_id) {
    $('#third_category_dropdown select').find('option:not(:first)').remove();
    $('#third_category_dropdown').hide();

    if ($(".category-option-" + parent_id)[0]) {
        $(".category-option-" + parent_id).each(function () {
            var op_val = $(this).attr('data-id');
            var op_text = $(this).attr('data-name');
            $('#third_category_dropdown select').append('<option value="' + op_val + '">' + op_text + '</option>');
        });
        $('#third_category_dropdown').show();
        $("#third_category_dropdown select").val("");
    }
}

function get_states(val) {
    var data = {
        "country_id": val,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/get_states",
        data: data,
        success: function (response) {
            $('#states').children('option:not(:first)').remove();
            $('#cities').children('option:not(:first)').remove();
            $("#states").append(response);
            update_product_map();
        }
    });
}

function get_cities(val) {
    var data = {
        "state_id": val,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/get_cities",
        data: data,
        success: function (response) {
            $('#cities').children('option:not(:first)').remove();
            $("#cities").append(response);
            update_product_map();
        }
    });
}


function update_product_map() {
    var country_text = $("#countries").find('option:selected').text();
    var country_val = $("#countries").find('option:selected').val();
    var state_text = $("#states").find('option:selected').text();
    var state_val = $("#states").find('option:selected').val();
    var address = $("#address_input").val();
    var zip_code = $("#zip_code_input").val();
    var data = {
        "country_text": country_text,
        "country_val": country_val,
        "state_text": state_text,
        "state_val": state_val,
        "address": address,
        "zip_code": zip_code,
        "lang_folder": lang_folder
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/show_address_on_map",
        data: data,
        success: function (response) {
            document.getElementById("map-result").innerHTML = response;
        }
    });
}

$(document).on('change', '#address_input', function () {
    update_product_map();
});
$(document).on('change', '#zip_code_input', function () {
    update_product_map();
});

$(document).on('click', '.item-favorite-button', function () {
    var product_id = $(this).attr("data-product-id");
    if ($(this).hasClass("item-favorite-enable")) {
        if ($(this).hasClass('item-favorited')) {
            $(this).removeClass('item-favorited');
        } else {
            $(this).addClass('item-favorited');
        }
        var data = {
            "product_id": product_id
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "product_controller/add_remove_favorite_ajax",
            data: data,
            success: function (response) {
            }
        });
    }
});

//set main image session
$(document).on('click', '.btn-set-image-main-session', function () {
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id
    };
    $('.badge-is-image-main').removeClass('badge-success');
    $('.badge-is-image-main').addClass('badge-secondary');
    $(this).removeClass('badge-secondary');
    $(this).addClass('badge-success');
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/set_image_main_session",
        data: data,
        success: function (response) {
        }
    });
});

//set main image
$(document).on('click', '.btn-set-image-main', function () {
    var image_id = $(this).attr('data-image-id');
    var product_id = $(this).attr('data-product-id');
    var data = {
        "image_id": image_id,
        "product_id": product_id
    };
    $('.badge-is-image-main').removeClass('badge-success');
    $('.badge-is-image-main').addClass('badge-secondary');
    $(this).removeClass('badge-secondary');
    $(this).addClass('badge-success');
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/set_image_main",
        data: data,
        success: function (response) {
        }
    });
});

//delete product image session
$(document).on('click', '.btn-delete-product-img-session', function () {
    $('.dm-upload-icon').css('display', 'block');
    $('.dm-upload-text').css('display', 'block');
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/delete_image_session",
        data: data,
        success: function () {
            $('#uploaderFile' + file_id).remove();
            // if (!$(".dm-uploaded-files li").length){
            //     $(".dm-uploader").css("border-color", "#edaab3")
            //     $(".images-exp").text("Please add at least one photo.");
            // }
        }
    });
});

//delete product image
$(document).on('click', '.btn-delete-product-img', function () {
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/delete_image",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
});

$("#form_validate").submit(function (e) {
    $('.custom-control-validate-input').removeClass('custom-control-validate-error');
    setTimeout(function () {
        $('.custom-control-validate-input .error').each(function () {
            var name = $(this).attr('name');
            if ($(this).is(":visible")) {
                name = name.replace('[]', '');
                $('.label_validate_' + name).addClass('custom-control-validate-error');
            }
        });
    }, 100);
});

$('.custom-control-validate-input input').click(function () {
    var name = $(this).attr('name');
    name = name.replace('[]', '');
    $('.label_validate_' + name).removeClass('custom-control-validate-error');
});

//hide cookies warning
function hide_cookies_warning() {
    $(".cookies-warning").hide();
    var data = {};
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "home_controller/cookies_warning",
        data: data,
        success: function (response) {
        }
    });
}

//validate product variations
$("#form_add_cart").submit(function () {
    $('#form_add_cart .custom-control-variation input').each(function () {
        if ($(this).hasClass('error')) {
            var id = $(this).attr('id');
            $('#form_add_cart .custom-control-variation label').each(function () {
                if ($(this).attr('for') == id) {
                    $(this).addClass('is-invalid');
                }
            });
        } else {
            var id = $(this).attr('id');
            $('#form_add_cart .custom-control-variation label').each(function () {
                if ($(this).attr('for') == id) {
                    $(this).removeClass('is-invalid');
                }
            });
        }
    });
});
$("#form_add_cart_mobile").submit(function () {
    $('#form_add_cart_mobile .custom-control-variation input').each(function () {
        if ($(this).hasClass('error')) {
            var id = $(this).attr('id');
            $('#form_add_cart_mobile .custom-control-variation label').each(function () {
                if ($(this).attr('for') == id) {
                    $(this).addClass('is-invalid');
                }
            });
        } else {
            var id = $(this).attr('id');
            $('#form_add_cart_mobile .custom-control-variation label').each(function () {
                if ($(this).attr('for') == id) {
                    $(this).removeClass('is-invalid');
                }
            });
        }
    });
});

$(document).on('click', '.custom-control-variation input', function () {
    var name = $(this).attr('name');
    $('.custom-control-variation label').each(function () {
        if ($(this).attr('data-input-name') == name) {
            $(this).removeClass('is-invalid');
        }
    });
});

$(document).ready(function () {

    $("#form_validate").validate();
    $("#form_validate_search").validate();
    $("#form_validate_search_mobile").validate();
    $("#form_validate_payout_1").validate();
    $("#form_validate_payout_2").validate();
    $("#form_validate_payout_3").validate();
    $("#form_validate_newsletter").validate();
    $("#form_add_cart").validate();
    $("#form_add_cart_mobile").validate();


    $('.validate_terms').submit(function (e) {
        if (!$('.custom-control-validate-input input').is(":checked")) {
            e.preventDefault();
            $('.custom-control-validate-input').addClass('custom-control-validate-error');
        } else {
            $('.custom-control-validate-input').removeClass('custom-control-validate-error');
        }
    });
});

$(document).on("input keyup paste change", ".validate_price .price-input", function () {
    var val = $(this).val();
    val = val.replace(',', '.');
    if ($.isNumeric(val) && val != 0) {
        $(this).removeClass('is-invalid');
    } else {
        $(this).addClass('is-invalid');
    }
});

$('input[type=radio][name=product_type]').change(function () {
    if (this.value == 'digital') {
        $('.listing_ordinary_listing').hide();
        $('.listing_take_offers').hide();
        $('.listing_sell_on_site input').prop('checked', true);
    } else {
        $('.listing_ordinary_listing').show();
        $('.listing_take_offers').show();
    }
});

$(document).ready(function () {
    $('.validate_price').submit(function (e) {
        $('.validate_price .validate-price-input').each(function () {
            var val = $(this).val();
            if (val != '') {
                val = val.replace(',', '.');
                if ($.isNumeric(val) && val != 0) {
                    $(this).removeClass('is-invalid');
                } else {
                    e.preventDefault();
                    $(this).addClass('is-invalid');
                    $(this).focus();
                }
            }
        });
    });
});

$('.price-input').keypress(function (event) {
    if (typeof thousands_separator == 'undefined') {
        thousands_separator = '.';
    }
    if (thousands_separator == '.') {
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }
        var text = $(this).val();
        if ((text.indexOf('.') != -1) &&
            (text.substring(text.indexOf('.')).length > 2) &&
            (event.which != 0 && event.which != 8) &&
            ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }
    } else {
        var $this = $(this);
        if ((event.which != 44 || $this.val().indexOf(',') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }
        var text = $(this).val();
        if ((text.indexOf(',') != -1) &&
            (text.substring(text.indexOf(',')).length > 2) &&
            (event.which != 0 && event.which != 8) &&
            ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }
    }
});

//full screen
$(document).ready(function () {
    $("iframe").attr("allowfullscreen", "")
});


$(document).on('change', '#ckMultifileupload', function () {
    var MultifileUpload = document.getElementById("ckMultifileupload");
    if (typeof (FileReader) != "undefined") {
        var MultidvPreview = document.getElementById("ckMultidvPreview");
        MultidvPreview.innerHTML = "";
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        for (var i = 0; i < MultifileUpload.files.length; i++) {
            var file = MultifileUpload.files[i];
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement("IMG");
                img.src = e.target.result;
                img.id = "Multifileupload_image";
                MultidvPreview.appendChild(img);
                $("#Multifileupload_button").show();
            }
            reader.readAsDataURL(file);
        }
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});


$(document).ready(function () {

    /* start hkm  */





    // get cities of state
    $("#ysfhkm_slc_negh select").change(function () {
        var state_value = $(this).val();
        var data = {
            "parent": state_value,
            "mode": 'option',
            "type": "city"
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            url: base_url + "Ajax_controller/search_location",
            method: 'POST',
            data: data,
            success: function (data) {
                $('#ysfhkm_slc_city select').html(data);

            }
        });
        return false;
    });

    // get states of country
    $("#ysfhkm_slc_country select").change(function () {
        var country_value = $(this).val();
        var data = {
            "parent": country_value,
            "mode": 'option',
            "type": "state",
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            url: base_url + "Ajax_controller/search_location", /* testing  */
            method: 'post',
            data: data,
            success: function (data) {
                $('#ysfhkm_slc_negh select').html(data);
                let item = $('#ysfhkm_slc_negh select > option[data-capital="1"]').get(0) || { value: '' };
                $('#ysfhkm_slc_negh select').val(item.value).trigger('change');
            },
            error: function (reponse) {
                console.log('Problem with ajax');
            }

        });


    });


    // get Sub Categories */
    $("#ysfhkm_slc_ctg select").change(function () {
        var ysfhkm_slc_ctg = $(this).val();
        $('#formsearchzolmarket').attr('action', ysfhkm_slc_ctg);
        $('#form-product-filters').attr('action', ysfhkm_slc_ctg);
        //data[csfr_token_name] = $.cookie(csfr_cookie_name);
        /*$.ajax({
            url:base_url + "Search_controller/get_sub_categories",
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data){
               $('#show_child_categories').html(data);
            }
        });*/
        if (is_hkm_one_country) {
            if ($('select[name=state]').val() == '') {
                $('select[name=country]').prop("disabled", true)    
                $('select[name=state]').prop("disabled", true)    
            }
            if ($('select[name=city]').val() == '')
                $('select[name=city]').prop("disabled", true)    
        }else {
            if ($('select[name=country]').val() == '')
                $('select[name=country]').prop("disabled", true)
            if ($('select[name=state]').val() == '')
                $('select[name=state]').prop("disabled", true)    
            if ($('select[name=city]').val() == '')
                $('select[name=city]').prop("disabled", true)     
        }
        this.form.submit();
        return false;
    });


});


function filterMenuItems(e) {
    $(e).parent().nextAll().removeClass('d-none');
    var item = $(e).parent().nextAll().filter(function () {
        return !$(this).text().toLowerCase().includes($(e).val().toLowerCase());
    });
    item.addClass('d-none');
}

window.onhashchange = function () {
    e.preventDefault();
}


/* strat hkm */

function validateblockMyForm() {
    //console.log("b_o");
    //event.preventDefault();

    var sender_id = $('#sender_id').val();
    var message_receiver_id = $('#message_receiver_id').val();

    check_is_blocked(message_receiver_id, sender_id).then(function (response) {
        var parseval = JSON.parse(response);
        var retval = parseval.is_blocked;
        if (retval == false) {
            form_send_message();
        } else {
            document.getElementById("send-message-result").innerHTML = "<span class='text-danger'  style='display: block;' >Ops!, This person don't accept email from you!</span><br>";
        }
    }, function (err) {
        console.log("error");
    });

    return false;
}

function form_send_message() {
    var sender_id = $('#sender_id').val();
    var message_subject = $('#message_subject').val();
    var message_text = $('#message_text').val();
    var message_receiver_id = $('#message_receiver_id').val();
    var message_send_em = $('#message_send_em').val();
    var img_src = $('#img_src').val();
    var slug = $('#slug').val();
    if (slug.length < 1) {
        slug = "from_profil";
    }
    if (message_subject.length < 1) {
        // $('#message_subject').addClass("is-invalid");
        // return false;
        message_subject = "";
    } else {
        $('#message_subject').removeClass("is-invalid");
    }
    if (message_text.length < 1) {
        $('#message_text').addClass("is-invalid");
        return false;
    } else {
        $('#message_text').removeClass("is-invalid");
    }
    var $form = $("#form_send_message");
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serializeArray();
    serializedData.push({ name: csfr_token_name, value: $.cookie(csfr_cookie_name) });
    serializedData.push({ name: "lang_folder", value: lang_folder });
    $inputs.prop("disabled", true);
    $.ajax({
        url: base_url + "message_controller/add_conversation",
        type: "post",
        data: serializedData,
        success: function (response) {
            $inputs.prop("disabled", false);
            document.getElementById("send-message-result").innerHTML = response;
            $("#form_send_message")[0].reset();
            //send email
            if (response != null) {
                send_message_ads_email(sender_id, message_receiver_id, message_subject, message_text, img_src, slug);
            }

        }
    });
}


function check_is_blocked(message_receiver_id, sender_id) {
    var data = {
        "annonncer": message_receiver_id,
        "contacter": sender_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    return $.ajax({
        async: false,
        type: 'post',
        url: base_url + "message_controller/check_is_blocked",
        data: data,
    });
}


// hkm block user chat
function block_user_conversation($block_by, $block_in, msg) {
    swal({
        text: msg,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "block_by": $block_by,
                "block_in": $block_in
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                method: "POST",
                url: base_url + "message_controller/block_user_conversation",
                data: data
            })
                .done(function (response) {
                    sweetAlert("Success block", "User is blocked", "success");
                    setTimeout(function () {
                        if (window.location.pathname.indexOf("/ar") == 0) {
                            window.location.href = base_url + "ar/" + "messages";
                        } else {
                            window.location.href = base_url + "messages";
                        }
                    }, 1000);
                })
        }
    });
}

function un_block_user_conversation($block_by, $block_in) {
    var data = {
        "block_by": $block_by,
        "block_in": $block_in
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        method: "POST",
        url: base_url + "message_controller/un_block_user_conversation",
        data: data
    })
        .done(function (response) {
            sweetAlert("Success Unblock", "User is Unblock", "success");
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 1000);
        })
}

// imogis  desktop
$('.hkm_desctopok_uaieua  .btn_imogi').click(function () {
    $('.imogi_div_desktop').toggle();
    $(this).toggleClass('active');
    event.stopPropagation();
});
$('.imogi_div_desktop img').click(function () {
    $('.imogi_div_desktop').show();
    event.stopPropagation();

    event.preventDefault();
    let form_data = new FormData();
    let name = $(this).attr('src');
    var ext = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        alert('ملف  غير معروف');
        return false;
    }
    form_data.append("inmogi_name", name);
    form_data.append("conversation_id", $(".hkm_desctopok_uaieua input[name ='conversation_id']").val());
    form_data.append("sender_id", $(".hkm_desctopok_uaieua input[name ='sender_id']").val());
    form_data.append("receiver_id", $(".hkm_desctopok_uaieua input[name ='receiver_id']").val());

    form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
    $.ajax({
        type: "POST",
        url: base_url + "Message_controller/send_imogi_chat_mobile",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            location.reload();
        }
    });

});

$(document).on('click', 'body', function () {
    $('.imogi_div_desktop').hide();
    $(this).removeClass('active');
});

// imogis  mobile
$('.groupemodileuplaodimagtz .btn_imogi').click(function (event) {
    $('.imogi_div_mobile').toggle();
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
        $(this).html('<i class="fas fa-times" style="margin: 0px;"></i>');
    } else {
        $('.groupemodileuplaodimagtz .form-group button.btn_imogi').html('<i class="far fa-grin" style="margin: 0px;"></i>');
    }
    event.stopPropagation();


});
$('.groupemodileuplaodimagtz img').click(function (event) {
    $('.imogi_div_mobile').show();
    event.stopPropagation();

    event.preventDefault();
    let form_data = new FormData();
    let name = $(this).attr('src');
    var ext = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        alert('ملف  غير معروف');
        return false;
    }
    form_data.append("inmogi_name", name);
    form_data.append("conversation_id", $(".groupemodileuplaodimagtz input[name ='conversation_id']").val());
    form_data.append("sender_id", $(".groupemodileuplaodimagtz input[name ='sender_id']").val());
    form_data.append("receiver_id", $(".groupemodileuplaodimagtz input[name ='receiver_id']").val());

    form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));
    $.ajax({
        type: "POST",
        url: base_url + "Message_controller/send_imogi_chat_mobile",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            location.reload();
        }
    });

});

$(document).on('click', 'body', function () {
    $('.imogi_div_mobile').hide();
    $('.groupemodileuplaodimagtz .form-group button.btn_imogi').html('<i class="far fa-grin" style="margin: 0px;"></i>');
    $('.groupemodileuplaodimagtz .form-group button.btn_imogi').removeClass('active');
});


//delete message
function delete_message_confirm(event, message_id, message) {
    event.preventDefault();
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                'message_id': message_id
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "message_controller/delete_message_in_chat",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        } else {
            return false;
        }
    });
}

$(".hkm_desctopok_uaieua #form_validate").submit(function (event) {
    var message_sender_id = $(".hkm_desctopok_uaieua #form_validate  input[name='sender_id']").val();
    var message_receiver_id = $(".hkm_desctopok_uaieua #form_validate input[name='receiver_id']").val();
    var message_subject = "New Message In Chat!";
    var message_text = $(".hkm_desctopok_uaieua #form_validate  textarea[name='message']").val();

    send_message_as_email(message_sender_id, message_receiver_id, message_subject, message_text);
});

/* end hkm  */


//delete quote request
function delete_quote_request(id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                'id': id
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "bidding_controller/delete_quote_request",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
}

/*
 *------------------------------------------------------------------------------------------
 * LICENSE KEY FUNCTIONS
 *------------------------------------------------------------------------------------------
 */

//add license key
function add_license_keys(product_id) {
    var data = {
        'product_id': product_id,
        'license_keys': $('#textarea_license_keys').val(),
        'allow_dublicate': $("input[name='allow_dublicate_license_keys']:checked").val()
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/add_license_keys",
        data: data,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                document.getElementById("result-add-license-keys").innerHTML = obj.success_message;
                $('#textarea_license_keys').val('');
            }
        }
    });
}

//delete license key
function delete_license_key(id, product_id) {
    var data = {
        'id': id,
        'product_id': product_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/delete_license_key",
        data: data,
        success: function (response) {
            $('#tr_license_key_' + id).remove();
        }
    });
}

//update license code list on modal open
$("#viewLicenseKeysModal").on('show.bs.modal', function () {
    var product_id = $('#license_key_list_product_id').val();
    var data = {
        'product_id': product_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_controller/refresh_license_keys_list",
        data: data,
        success: function (response) {
            document.getElementById("response_license_key").innerHTML = response;
        }
    });
});

// Active Link
var url = window.location.href;
var tg = url.split('/');
jQuery('.mobile-footer .col > a').each(function () {
    url_this = jQuery(this).attr("href");
    var ts = url_this.split('/');

    if (decodeURIComponent(tg[tg.length - 1]) === decodeURIComponent(ts[ts.length - 1])) {
        jQuery(this).addClass('active');
    }
});