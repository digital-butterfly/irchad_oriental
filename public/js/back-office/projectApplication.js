function tagifySubMembers()
{
    var subMembers = function () {
        var input = document.getElementById("kt_tagify_members");
        var primaryID = $("#member_id").val();
        var wl = [];

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            url: "/admin/existantIDs",
            method: "GET",
        })
        .then(function (result) {
            result.map((el) => {
                if (el.id != primaryID) {
                    wl.push({
                        value: el.id,
                        name: el.first_name + " " + el.last_name,
                    });
                }
            });

            var tagify = new Tagify(input, {
                enforceWhitelist: true,
                whitelist: wl,
                templates: {
                    tag: function (tagData) {
                        try {
                            return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" class='tagify__tag tagify__tag--brand tagify--noAnim ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                                        <div>
                                            <span class='tagify__tag-text'>${tagData.name} (${tagData.value})</span>
                                        </div>
                                    </tag>`;
                        } catch (err) { console.log("error on tag"); }
                    },
                    dropdownItem: function (tagData) {
                        try {
                            return `<div class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' tagifySuggestionIdx="${tagData.tagifySuggestionIdx}">
                                        <div class="kt-media-card">
                                            <div class="kt-media-card__info">
                                                <a class="kt-media-card__title">${tagData.value}</a>
                                                <span class="kt-media-card__desc">${tagData.name}</span>
                                            </div>
                                        </div>
                                    </div>`;
                        } catch (err) { console.log("error dorpdown"); }
                    },
                },
                dropdown: {
                    searchKeys: ["value", "name"],
                    classname: "color-blue",
                    enabled: 1,
                    maxItems: 10,
                },
            });

            tagify.on("remove", onRemoveTag);

            function onRemoveTag(e) {
                $("input#deleteTags").val($("input#deleteTags").val() + JSON.stringify(e.detail.data) + ",");
            }
        });
    };

    return {
        init: function () {
            subMembers();
        },
    };
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

jQuery(document).ready(function()
{
    if(getUrlVars()["member_id"]) {
        $('input#member_id').val(getUrlVars()["member_id"]) ;
    }

    $("input#member_id").change( function() {
        $.ajax({
            context: this,
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
            url: '/admin/members/' + $(this).val(),
        })
        .then(function(result) {
            $(this).next().html(result.first_name ? (result.first_name.charAt(0).toUpperCase() + result.first_name.slice(1) + " " + result.last_name.charAt(0).toUpperCase() + result.last_name.slice(1)) : 'Aucun membre trouvé');
        })
    });

    $("input#member_id").trigger("change");
});
