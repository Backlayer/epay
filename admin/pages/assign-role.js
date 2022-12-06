"use strict";

$(document).ready(function () {
    setTimeout(function () {
        let url = $('#searchUrl').val();
        $("#user").select2({
            ajax: {
                type: 'post',
                url: url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 2,
            templateResult: formatState,
            templateSelection: formatTemplateSelection
        });


        function formatState (state) {
            if (state.loading) {
                return state.text;
            }

            return $(
                '<div class="d-flex align-items-center">'+
                '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                '<span> ' + state.text + '</span>'+
                '</div>'
                // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
            );
        }

        function formatTemplateSelection(state) {
            if (!state.id){
                return state.text;
            }

            return $(
                '<div class="d-flex align-items-center">'+
                '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                '<span> ' + state.text + '</span>'+
                '</div>'
                // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
            );
        }
    }, 1000)
})
