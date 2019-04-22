/**
 * Created by phoenix on 01.11.2016.
 */

jQuery(function($) {

    var respond = $("#respond");

    $("p.js-reply > a").bind("click", function(){

        var id = $(this).attr('rel');

        respond.find(".comment-cancelReply:first").remove();

        $('<a>Cancel</a>').addClass('comment-cancelReply uk-margin-left').attr('href', "#respond").bind("click", function(){
            respond.find(".comment-cancelReply:first").remove();
            respond.appendTo($('#comments')).find("[name=comment_parent]").val(0);

            return false;
        }).appendTo(respond.find(".actions:first"));

        respond.find("[name=comment_parent]").val(id);
        respond.appendTo($("#comment-"+id));

        return false;

    });
});