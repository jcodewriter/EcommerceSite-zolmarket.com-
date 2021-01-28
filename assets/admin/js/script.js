//update token
$("form").submit(function () {
    $("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});

//datatable
$(document).ready(function () {
    $('#cs_datatable').DataTable({
        "order": [[0, "desc"]],
        "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
    });
});

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
});
$('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
    checkboxClass: 'icheckbox_square-purple',
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
});

$(function () {
    $('#tags_1').tagsInput({width: 'auto'});
});


//check all checkboxes
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

//show hide delete button
$('.checkbox-table').click(function () {
    if ($(".checkbox-table").is(':checked')) {
        $(".btn-table-delete").show();
    } else {
        $(".btn-table-delete").hide();
    }
});

//get subcategories

function get_subcategories(element,index=0) {
	let val = element.value;
	var data = {
		"parent_id": val
	};
	$(element).nextAll().remove();
	data[csfr_token_name] = $.cookie(csfr_cookie_name);
return	$.ajax({
		type: "POST",
		async: window.async || true,
		url: base_url + "category_controller/get_subcategories",
		data: data,
		success: function (response) {
			if (response != '' && val != '') {

				$("#listcategories").append(
					'<select name="second_parent_id[' + (index+1) + ']"   id="cat_' + val + '"' +
					'class="form-control" style="margin-top: 15px;" ' +
					'onchange="get_subcategories(this,' + (index+1) + ');"></select>');

				$("#cat_" + val).append($(element).children().first().clone())
                    .append(response);
				
			}

		}
	});
}


// function get_subcategories(val) {
//     var data = {
//         "parent_id": val
//     };
//     data[csfr_token_name] = $.cookie(csfr_cookie_name);
//
//     $.ajax({
//         type: "POST",
//         url: base_url + "category_controller/get_subcategories",
//         data: data,
//         success: function (response) {
//             $('#subcategories').children('option:not(:first)').remove();
//             $("#subcategories").append(response);
//             $('#third_categories').children('option:not(:first)').remove();
//         }
//     });
// }

$(document).on('click', '.has-menu', function () {
    var oldmenu = null;
    var id = $(this).data('ajax');
    var customCountryId = $(this).attr('data-ajax');
    var url = $(this).data('url');
    var type = $(this).data('type');
    var text = $(this).text().trim();
    var queryv = $(this).data('query');
    // console.log('type: ' + type + ' :id ' + id);
    if ($("#" + type + id).length == 0) {
        var data = {parent: id, type: type, query: queryv, custom_country_id: customCountryId};
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
                    if(typeof data.back!="undefined" && data.back==true)
                    $("#" + type + id).css('margin-left', "105%");
                    else
                    $("#" + type + id).css('margin-left', "0%");
                    $('html,body').addClass('disable-body-scroll');
                }, 50);
            }
        });
    } else {
        $("#" + type + id).css('margin-left', "100%");

        if (oldmenu != undefined) {
            oldmenu.css({"z-index":'1 !important'});
        }

        $("#" + type + id).css({"z-index": '2 !important'});
        oldmenu = $("#" + type + id);

        setTimeout(function () {
            $("#" + type + id).css('margin-left', "0%");
            $('html,body').addClass('disable-body-scroll');

        }, 50);

    }
});
var windowsearchOpen = undefined;
var menuFirstAppear=true;
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
                    var data = {parent: id, type: type, back: true, lang_base_url: lang_base_url, query: queryv};
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
                            if(menuFirstAppear){
                                setTimeout(function () {
                                    $("#" + type + id).css('margin-left', "0%");
                                    $('html,body').addClass('disable-body-scroll');
                                }, 50);
                                menuFirstAppear=false
                            }
                            else{
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

//get third categories
function get_third_categories(val) {
    var data = {
        "parent_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "category_controller/get_subcategories",
        data: data,
        success: function (response) {
            $('#third_categories').children('option:not(:first)').remove();
            $("#third_categories").append(response);
        }
    });
}

//get categories
function get_categories_by_lang(val) {
    var data = {
        "lang_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "category_controller/get_categories_by_lang",
        data: data,
        success: function (response) {
            $('#categories').children('option:not(:first)').remove();
            $("#categories").append(response);
        }
    });
}

//get blog categories
function get_blog_categories_by_lang(val) {
    var data = {
        "lang_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "blog_controller/get_categories_by_lang",
        data: data,
        success: function (response) {
            $('#categories').children('option:not(:first)').remove();
            $("#categories").append(response);
        }
    });
}

function get_sub_categories(val) {
    var data = {
        "parent_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "category_controller/get_sub_categories",
        data: data,
        success: function (response) {
            $('#subcategories').children('option:not(:first)').remove();
            $("#subcategories").append(response);
        }
    });
}

//delete selected products
function delete_selected_products(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var product_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                product_ids.push(this.value);
            });
            var data = {
                'product_ids': product_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "product_admin_controller/delete_selected_products",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

//delete selected products permanently
function delete_selected_products_permanently(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var product_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                product_ids.push(this.value);
            });
            var data = {
                'product_ids': product_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "product_admin_controller/delete_selected_products_permanently",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

//remove from promoted
function remove_from_promoted(val) {
    var data = {
        "product_id": val,
        "is_ajax": 1
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_admin_controller/add_remove_promoted_products",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
}

//delete item
function delete_item(url, id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                'id': id,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + url,
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

//confirm user email
function confirm_user_email(id) {
    var data = {
        'id': id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/confirm_user_email",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

//ban remove user ban
function ban_remove_ban_user(id) {
    var data = {
        'id': id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/ban_remove_ban_user",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

function decline_user(id) {
    var data = {
        'id': id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/decline_user",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

//get states by country
function get_states_by_country(val) {
    var data = {
        "country_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/get_states_by_country",
        data: data,
        success: function (response) {
            $('#select_states option').remove();
            $("#select_states").append(response);
        }
    });
}

function set_state_capital(el) {
    var data = {
        "state_id": $(el).data('id'),
        "country_id": $(el).data('country'),
        "val": $(el).hasClass("fa fa-toggle-on")?0:1
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/set_state_capital",
        data: data,
        success: function (response) {
            $("i[data-country='" + $(el).data('country') + "']").removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");

            if(data.val == 0)
                $(el).removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");
            else
                $(el).removeClass("fa fa-toggle-off").addClass("fa fa-toggle-on");
        }
    });
}


function set_country_default(el) {
    var data = {
        "country_id": $(el).data('country'),
        "val": $(el).hasClass("fa fa-toggle-on")?0:1
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/set_country_default",
        data: data,
        success: function (response) {
            $("i[data-country]").removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");

            if(data.val == 0)
                $(el).removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");
            else
                $(el).removeClass("fa fa-toggle-off").addClass("fa fa-toggle-on");
        }
    });
}


function set_city_default(el) {
    var data = {
        "state_id": $(el).data('id'),
        "city_id": $(el).data('city'),
        "val": $(el).hasClass("fa fa-toggle-on")?0:1
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "ajax_controller/set_city_default",
        data: data,
        success: function (response) {
            $("i[data-id='" + $(el).data('id') + "']").removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");

            if(data.val == 0)
                $(el).removeClass("fa fa-toggle-on").addClass("fa fa-toggle-off");
            else
                $(el).removeClass("fa fa-toggle-off").addClass("fa fa-toggle-on");
        }
    });
}


//open or close user shop
function open_close_user_shop(id, message) {
    if (message.length > 1) {
        swal({
            text: message,
            icon: "warning",
            buttons: true,
            buttons: [sweetalert_cancel, sweetalert_ok],
            dangerMode: true,
        }).then(function (approve) {
            if (approve) {
                var data = {
                    "id": id
                };
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                $.ajax({
                    type: "POST",
                    url: base_url + "admin_controller/open_close_user_shop",
                    data: data,
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        });
    } else {
        var data = {
            "id": id
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: base_url + "admin_controller/open_close_user_shop",
            data: data,
            success: function (response) {
                location.reload();
            }
        });
    }
};

//approve product
function approve_product(id) {
    var data = {
        'id': id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_admin_controller/approve_product",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

//restore product
function restore_product(id) {
    var data = {
        'id': id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "product_admin_controller/restore_product",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

//upload product image update page
// code change to daynmic upload file problem find when has in some folder upload to file like icon and image 
// to avoid duplicate code do this soultion
$(document).on('change', 'input[type=file]', function () {
    var filetarget = $(this).data('show'),imageid=$(this).data('id');
    var MultifileUpload = this;
    if (typeof (FileReader) != "undefined") {
        if(filetarget == "" || filetarget == undefined)
        var MultidvPreview = document.getElementById("MultidvPreview");
        else
        var MultidvPreview = document.getElementById(filetarget);

        MultidvPreview.innerHTML = "";
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        for (var i = 0; i < MultifileUpload.files.length; i++) {
            var file = MultifileUpload.files[i];
            var reader = new FileReader();
            reader.onload = function (e) {
                
                var img = document.createElement("IMG");
                img.height = "100";
                img.width = "100";
                img.src = e.target.result;
                if(imageid == "" || imageid == undefined)
                    img.id = "Multifileupload_image";
                else
                    img.id = imageid;

                MultidvPreview.appendChild(img);
                $("#" + img.id).show();
              

            }
            reader.readAsDataURL(file);
        }
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});



function show_preview_image(input) {
    var name = $(input).attr('name');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_preview_' + name).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//delete selected reviews
function delete_selected_reviews(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {

            var review_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                review_ids.push(this.value);
            });
            var data = {
                'review_ids': review_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "product_admin_controller/delete_selected_reviews",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        }
    });
};

//delete selected user reviews
function delete_selected_user_reviews(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {

            var review_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                review_ids.push(this.value);
            });
            var data = {
                'review_ids': review_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "admin_controller/delete_selected_user_reviews",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        }
    });
};

//delete selected comments
function delete_selected_comments(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {

            var comment_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                comment_ids.push(this.value);
            });
            var data = {
                'comment_ids': comment_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "product_admin_controller/delete_selected_comments",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        }
    });
};

//delete selected blog comments
function delete_selected_blog_comments(message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {

            var comment_ids = [];
            $("input[name='checkbox-table']:checked").each(function () {
                comment_ids.push(this.value);
            });
            var data = {
                'comment_ids': comment_ids,
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "blog_controller/delete_selected_comments",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        }
    });
};

//delete custom field option
function delete_custom_field_option(message, common_id) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "common_id": common_id
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "category_controller/delete_custom_field_option",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

//get custom field category
function delete_custom_field_category(message, field_id, category_id) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "field_id": field_id,
                "category_id": category_id
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "category_controller/delete_custom_field_category",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

function delete_ad_spaces(message, field_id) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                "field_id": field_id
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "admin_controller/delete_ad_spaces",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
};

//approve bank transfer
function approve_bank_transfer(id, order_id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        buttons: [sweetalert_cancel, sweetalert_ok],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var data = {
                'id': id,
                'order_id': order_id,
                'option': 'approved',
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "order_admin_controller/bank_transfer_options_post",
                data: data,
                success: function (response) {
                    location.reload();
                }
            });

        }
    });
};

//email preview
$(document).on('click', '#btn_email_preview', function () {
    var title = $("input[name=subject]").val();
    var content = CKEDITOR.instances['ckEditor'].getData();
    var data = {
        "title": title,
        "content": content
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/email_preview",
        data: data,
        success: function (response) {
            var w = window.open();
            $(w.document.body).html(response);
        }
    });
});

$('.increase-count').each(function () {
    $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

$('#selected_system_marketplace').on('ifChecked', function () {
    $('.system-currency-select').show();
});
$('#selected_system_classified_ads').on('ifChecked', function () {
    $('.system-currency-select').hide();
});

$(document).ready(function () {
    $('.magnific-image-popup').magnificPopup({type: 'image'});
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

$(document).ready(function () {
    $('.validate_price').submit(function (e) {
        $('.validate_price .validate-price-input').each(function () {
            var val = $(this).val();
            val = val.replace(',', '.');
            if ($.isNumeric(val) && val != 0) {
                $(this).removeClass('is-invalid');
            } else {
                e.preventDefault();
                $(this).addClass('is-invalid');
                $(this).focus();
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



//delete category watermark
function delete_category_watermark(category_id) {
    var data = {
        "category_id": category_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_controller/delete_category_watermark_post",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
};

$(document).ajaxStop(function () {

    $('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
        checkboxClass: 'icheckbox_square-purple',
        radioClass: 'iradio_square-purple',
        increaseArea: '20%' // optional
    });

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-show').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgUploader").change(function () { readURL(this); });