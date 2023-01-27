"use strict";
var KTCreateAccount = (function () {
    var e,
        t,
        i,
        o,
        s,
        r,
        a = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#kt_create_account_stepper")),
                (i = t.querySelector("#kt_create_account_form")),
                (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                (s = t.querySelector('[data-kt-stepper-action="next"]')),
                (r = new KTStepper(t)).on("kt.stepper.changed", function (e) {
                    4 === r.getCurrentStepIndex()
                        ? (o.classList.remove("d-none"),
                          o.classList.add("d-inline-block"),
                          s.classList.add("d-none"))
                        : 5 === r.getCurrentStepIndex()
                        ? (o.classList.add("d-none"), s.classList.add("d-none"))
                        : (o.classList.remove("d-inline-block"),
                          o.classList.remove("d-none"),
                          s.classList.remove("d-none"));

                    if (r.getCurrentStepIndex() === 4) {
                        const data = new FormData(
                            document.querySelector("form")
                        );
                        for (const arr of data.entries()) {
                            const [target, value] = arr;
                            const elm = document.querySelector(
                                `[data-target="${target}"]`
                            );
                            if (elm) elm.textContent = value;
                            console.log(arr);
                        }
                    }
                }),
                console.log(e, t, i, o, s, r, a);
            console.clear();
            r.on("kt.stepper.next", function (e) {
                console.log("stepper.next");

                console.log(e);

                // var checkEmail = true;
                //
                // if (e.getCurrentStepIndex() === 1) {
                //     let email = $('input[name="email"]').val();
                //
                //     if (email !== "") {
                //         var return_first = function () {
                //             var tmp = $.ajax({
                //                 type: "GET",
                //                 async: false,
                //                 url: location.origin + "/email/check/" + email,
                //                 success: function (data) {
                //                     tmp = data;
                //                 },
                //             }).done(function (data) {
                //                 return data;
                //             });
                //
                //             return tmp;
                //         };
                //
                //         checkEmail = JSON.parse(return_first().responseText);
                //
                //         if (!checkEmail) {
                //             $('input[name="email"]').next().text(email_exist);
                //         }
                //     }
                // }
                //
                // console.log(checkEmail);

                var t = a[e.getCurrentStepIndex() - 1];
                t
                    ? t.validate().then(function (t) {
                          console.log(t),
                              "Valid" == t
                                  ? (e.goNext(), KTUtil.scrollTop())
                                  : Swal.fire({
                                        text: inputs_err,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: ok,
                                        customClass: {
                                            confirmButton: "btn btn-light",
                                        },
                                    }).then(function () {
                                        KTUtil.scrollTop();
                                    });
                      })
                    : (e.goNext(), KTUtil.scrollTop());
            }),
                r.on("kt.stepper.previous", function (e) {
                    console.log("stepper.previous"),
                        e.goPrevious(),
                        KTUtil.scrollTop();
                }),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            nom: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            prenom: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            age: {
                                validators: {
                                    notEmpty: { message: message_err },
                                    numeric: {
                                        message:
                                            "L'age doit avoir que des chiffres!",
                                    },
                                    callback: {
                                        message: max_age,
                                        callback: function (input) {
                                            if (parseInt(input.value) > 50) {
                                                return message_err;
                                            }
                                        },
                                    },
                                    // siren: {message: "Champs .."}
                                },
                            },
                            lieu_naissance: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            province_commune: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            nationalite: {
                                validators: {
                                    notEmpty: { message: message_err },
                                    string: { message: "String" },
                                },
                            },
                            phone: {
                                validators: {
                                    notEmpty: { message: message_err },
                                    digits: { message: phone_err },
                                    stringLength: {
                                        min: 10,
                                        max: 10,
                                        message: phone_max,
                                    },
                                },
                            },
                            date_naissnace: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            email: {
                                validators: {
                                    notEmpty: { message: message_err },
                                    emailAddress: { message: email_err },
                                    // callback: {
                                    //     message: 'Email unique',
                                    //     callback: function (input) {
                                    //
                                    //         $.ajax({
                                    //             url: location.origin+"/email/check",
                                    //             type:'GET',
                                    //             data: {email_check:input}
                                    //         }).done(function(data){
                                    //             $('input[name="email"]').addClass(data);
                                    //             //return data;
                                    //         });
                                    //
                                    //
                                    //         if (input.classList.contains('exist-email')) {
                                    //             alert('error')
                                    //         }
                                    //
                                    //
                                    //
                                    //     }
                                    // }
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".input",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            niveau_etude: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            profession: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            annee_experience: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            diplome_obtenu: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".input",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            entreprise: {
                                validators: {
                                    notEmpty: { message: checkbox_err },
                                },
                            },
                            date_creation: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            forme_juridique: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            province_comune_entreprise: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            objet_sociale: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            financement: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            intitule_projet: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            secteur_activite: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            province_implantation: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            programme_estimatif: {
                                validators: {
                                    notEmpty: { message: message_err },
                                },
                            },
                            nb_emplois_estimatif: {
                                validators: {
                                    notEmpty: { message: message_err },
                                    callback: {
                                        message: max_emplois,
                                        callback: function (input) {
                                            if (parseInt(input.value) > 500) {
                                                return false;
                                            }else {
                                                return true;
                                            }
                                        },
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".input",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            card_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Name on card is required",
                                    },
                                },
                            },
                            card_number: {
                                validators: {
                                    notEmpty: {
                                        message: "Card member is required",
                                    },
                                    creditCard: {
                                        message: "Card number is not valid",
                                    },
                                },
                            },
                            card_expiry_month: {
                                validators: {
                                    notEmpty: { message: "Month is required" },
                                },
                            },
                            card_expiry_year: {
                                validators: {
                                    notEmpty: { message: "Year is required" },
                                },
                            },
                            card_cvv: {
                                validators: {
                                    notEmpty: { message: "CVV is required" },
                                    digits: {
                                        message: "CVV must contain only digits",
                                    },
                                    stringLength: {
                                        min: 3,
                                        max: 4,
                                        message:
                                            "CVV must contain 3 to 4 digits only",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                o.addEventListener("click", async function (e) {
                    let myForm = $("#kt_create_account_form").serializeArray();

                    const form = document.querySelector("[form]");
                    form.submit();
                    const formData = new FormData();
                    await fetch("/action", {
                        method: "POST",
                        body: formData,
                    });

                    // $.ajax({
                    //     url: "/action",
                    //     type: "POST",
                    //     // dataType: "json",
                    //     data: myForm,
                    //     success: function (data) {

                    const data = [];
                    console.log(data);

                    setTimeout(function () {
                        $("#success .alert")
                            .removeClass("d-none")
                            .text(data.success);

                        $("#success").prev().remove();

                        $('button[data-kt-stepper-action="submit"]').remove();
                        $('button[data-kt-stepper-action="previous"]').remove();

                        $(".btn-actions")
                            .append(
                                `<a href="${base_url}" class="btn btn-xl w300px px-20 btn-warning bg-gradient">Retour</a>`
                            )
                            .addClass("text-center d-block w-100");
                        }, 2e2);
                    // },
                    // });

                    a[3].validate().then(function (t) {
                        console.log("validated!"),
                            "Valid" == t
                                ? (e.preventDefault(),
                                  (o.disabled = !0),
                                  o.setAttribute("data-kt-indicator", "on"),
                                  setTimeout(function () {
                                      o.removeAttribute("data-kt-indicator"),
                                          (o.disabled = !1),
                                          r.goNext();
                                  }, 2e3))
                                : Swal.fire({
                                      text: "Sorry, looks like there are some errors detected, please try again.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-light",
                                      },
                                  }).then(function () {
                                      KTUtil.scrollTop();
                                  });
                    });
                }),
                $(i.querySelector('[name="card_expiry_month"]')).on(
                    "change",
                    function () {
                        a[3].revalidateField("card_expiry_month");
                    }
                ),
                $(i.querySelector('[name="card_expiry_year"]')).on(
                    "change",
                    function () {
                        a[3].revalidateField("card_expiry_year");
                    }
                ),
                $(i.querySelector('[name="business_type"]')).on(
                    "change",
                    function () {
                        a[2].revalidateField("business_type");
                    }
                );
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init();
});
