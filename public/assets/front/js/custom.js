(function ($) {
  "use strict";

  // PRE LOADER
  $(window).load(function () {
    $(".preloader").fadeOut(1000); // set duration in brackets
  });

  // MENU
  $(".navbar-collapse a").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  $(window).scroll(function () {
    if ($(".navbar").offset().top > 50) {
      $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
      $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
  });

  // HOME SLIDER & COURSES & CLIENTS
  $(".home-slider").owlCarousel({
    animateOut: "fadeOut",
    items: 1,
    loop: true,
    dots: false,
    autoplayHoverPause: false,
    autoplay: true,
    smartSpeed: 1000,
  });

  $(".owl-courses").owlCarousel({
    animateOut: "fadeOut",
    loop: true,
    autoplayHoverPause: false,
    autoplay: true,
    smartSpeed: 1000,
    dots: false,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      1000: {
        items: 3,
      },
    },
  });

  $(".owl-client").owlCarousel({
    animateOut: "fadeOut",
    loop: true,
    autoplayHoverPause: false,
    autoplay: true,
    smartSpeed: 1000,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      1000: {
        items: 3,
      },
    },
  });

  // SMOOTHSCROLL
  // $(function() {
  //   $('.custom-navbar a, #home a').on('click', function(event) {
  //     var $anchor = $(this);
  //       $('html, body').stop().animate({
  //         scrollTop: $($anchor.attr('href')).offset().top - 49
  //       }, 1000);
  //         event.preventDefault();
  //   });
  // });
})(jQuery);

$(".dropdown-toggle").click(function (e) {
  if ($(document).width() > 768) {
    e.preventDefault();

    var url = $(this).attr("href");

    if (url !== "#") {
      window.location.href = url;
    }
  }
});

// ==========================
$(document).ready(function () {
  $("#submit_form").click(function(){    
      $("#msform").submit(); // Submit the form
  });
});
$(document).ready(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  $(".next").click(function () {
    var serial = $(this).attr("serial");
    if (serial == 1) {
      var return_status = checkFirstNextValidation();
    }else if (serial == 2) {
      var return_status = checkSecondNextValidation();
    }else if (serial == 3) {
      var return_status = checkThirdNextValidation();
    }
    // var return_status = true;
    if (return_status != false) {
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      //Add Class Active
      $("#progressbar li")
        .eq($("fieldset").index(next_fs))
        .addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
              display: "none",
              position: "relative",
            });
            next_fs.css({ opacity: opacity });
          },
          duration: 600,
        }
      );
    } else {
      $("html, body").animate(
        {
          scrollTop: $(".errorScroll").offset().top - 300,
        },
        1000
      );
    }
  });

  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 600,
      }
    );
  });

  $(".submit").click(function () {
    return false;
  });
  

  $("input").change(function () {
    var val = $(this).val();
    var name = $(this).attr("name");
    var type = $(this).attr("type");
    // console.log('vale:'+val+'-name:'+name+'-type:'+type)
    if(type == 'checkbox'){
      return false;
    }else{
      if (val != "") {
        $("#" + name + "_error").html("");
        $("#" + name + "_error").removeClass("errorScroll");
      }
    }
    $("#" + name).html(val);
  });
  $("select").change(function () {
    var val = $(this).val();
    var name = $(this).attr("name");
    // console.log('vale:'+val+'-name:'+name)
    $("#" + name).html(val);
    if (val != "") {
      $("#" + name + "_error").html("");
      $("#" + name + "_error").removeClass("errorScroll");
    }
  });

});
function checkSecondNextValidation() {
  var permanent_address = $("input[name='permanent_address']").val();
  var password = $("input[name='password']").val();
  var password_confirmation = $("input[name='password_confirmation']").val();
  var file_error = $("input[id='file_error']").val();
  if (permanent_address == "") {
    $("#permanent_address_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter SSC Reg number");
    return false;
  } else {
    $("#permanent_address_error").html("");
    $("#permanent_address_error").removeClass("errorScroll");
  }

  if (file_error == 0) {
    $("#file_error_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter profile image");
    return false;
  } else {
    $("#file_error_error").html("");
    $("#file_error_error").removeClass("errorScroll");
  }

  if (password == '') {
    $("#password_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter password");  
    return false;  
  } else {
    $("#password_error").html("");
    $("#password_error").removeClass("errorScroll");
  }

  if (password != password_confirmation) {
    $("#password_error").addClass("errorScroll");
    $(".errorScroll").html("The password confirmation does not match.");  
    return false;  
  } else {
    $("#password_error").html("");
    $("#password_error").removeClass("errorScroll");
  }

}
function checkThirdNextValidation() {
  var limit_Elective = $("#limit_Elective").val();
  var limit_4th = $("#limit_4th").val();
  var selected_subject_Elective = parseInt($("#selected_subject_Elective").val())/2;
  var selected_subject_4th = parseInt($("#selected_subject_4th").val())/2;
  if (limit_Elective != selected_subject_Elective) {
    $("#subject_error_Elective").addClass("errorScroll");
    $(".errorScroll").html("Please complete elective subject selection");
    return false;
  }else {
    $("#subject_error_Elective").html("");
    $("#subject_error_Elective").removeClass("errorScroll");
  }
  if(limit_4th != selected_subject_4th) {
    $("#subject_error_4th").addClass("errorScroll");
    $(".errorScroll").html("Please complete 4th subject selection");
    return false;
  } else {
    $("#subject_error_4th").html("");
    $("#subject_error_4th").removeClass("errorScroll");
  }
}
function checkFirstNextValidation() {
  var ssc_reg = $("input[name='ssc_reg']").val();
  var school_name = $("input[name='school']").val();
  var gender = $("select[name='gender']").val();
  var ssc_gpa = $("input[name='ssc_gpa']").val();
  var ssc_gpa_forth = $("input[name='ssc_gpa_forth']").val();
  var dob = $("input[name='dob']").val();
  var phone = $("input[name='phone']").val();
  var father_name = $("input[name='father_name']").val();
  var mother_name = $("input[name='mother_name']").val();
  var birth_registration = $("input[name='birth_registration']").val();
  var parents_phone = $("input[name='parents_phone']").val();
  var religion = $("select[name='religion']").val();
  if (ssc_reg == "") {
    $("#ssc_reg_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter SSC Reg number");
    return false;
  } else {
    $("#ssc_reg_error").html("");
    $("#ssc_reg_error").removeClass("errorScroll");
  }
  if (school_name == "") {
    $("#school_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter school name");
    return false;
  } else {
    $("#school_error").html("");
    $("#school_error").removeClass("errorScroll");
  }
  if (gender == "") {
    $("#gender_error").addClass("errorScroll");
    $(".errorScroll").html("Please select gender");
    return false;
  } else {
    $("#gender_error").html("");
    $("#gender_error").removeClass("errorScroll");
  }
  if (ssc_gpa == "") {
    $("#ssc_gpa_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter SSC GPA");
    return false;
  } else {
    $("#ssc_gpa_error").html("");
    $("#ssc_gpa_error").removeClass("errorScroll");
  }
  if (ssc_gpa_forth == "") {
    $("#ssc_gpa_forth_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter SSC GPA With 4th");
    return false;
  } else {
    $("#ssc_gpa_forth_error").html("");
    $("#ssc_gpa_forth_error").removeClass("errorScroll");
  }
  if (dob == "") {
    $("#dob_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter date of birth");
    return false;
  } else {
    $("#dob_error").html("");
    $("#dob_error").removeClass("errorScroll");
  }

  if (phone == "") {
    $("#phone_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter phone");
    return false;
  } else {
    $("#phone_error").html("");
    $("#phone_error").removeClass("errorScroll");
  }
  if (father_name == "") {
    $("#father_name_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter father name");
    return false;
  } else {
    $("#father_name_error").html("");
    $("#father_name_error").removeClass("errorScroll");
  }
  if (mother_name == "") {
    $("#mother_name_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter mother name");
    return false;
  } else {
    $("#mother_name_error").html("");
    $("#mother_name_error").removeClass("errorScroll");
  }
  if (parents_phone == "") {
    $("#parents_phone_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter parents phone");
    return false;
  } else {
    $("#parents_phone_error").html("");
    $("#parents_phone_error").removeClass("errorScroll");
  }
  if (birth_registration == "") {
    $("#birth_registration_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter birth registration");
    return false;
  } else {
    $("#birth_registration_error").html("");
    $("#birth_registration_error").removeClass("errorScroll");
  }

  if (religion == "") {
    $("#religion_error").addClass("errorScroll");
    $(".errorScroll").html("Please enter religion");
    return false;
  } else {
    $("#religion_error").html("");
    $("#religion_error").removeClass("errorScroll");
  }
}
$(document).ready(function () {
  var sc = 0;
  for (let i = 0; i < 10; i++) {
    if ($(".status_Compulsory_" + i).is(":checked")) {
      sc = parseInt(sc) + 1;
      var subject_name = $(".status_Compulsory_" + i).attr(
        "subject-name"
      );
      var code = $(".status_Compulsory_" + i).attr("code");
      var html =
        `<div class="col-md-12"><strong id="">` +
        subject_name +
        ` (` +
        code +
        `)</strong></div>`;
      $(".subject-list-class-compulsory").append(html);
      $("#compulsory-subject").html(sc);
    }
  }
  //set initial state.
  $(".subject").change(function () {
    if ($(this).is(":checked")) {
      var code = $(this).attr("code");
      var main_subject = $(this).attr("main-subject");
      var status = $(this).attr("subject-status");
      var section = $(this).attr("section");
      if (status === "Elective") {
        var disabled_status = "4th";
        if (section != 2) {
          $(".status_" + status).prop("checked", false);
          $(".status_" + status).prop("disabled", true);
        } else {
          var count = 1;
          for (let i = 0; i < 10; i++) {
            if ($(".status_" + status + "_" + i).is(":checked")) {
              count = count + 1;
            }
          }
          if (count > 5) {
            for (let i = 0; i < 10; i++) {
              if (
                $(".status_" + status + "_" + i).is(
                  ":not(:checked)"
                )
              ) {
                $(".status_" + status + "_" + i).prop(
                  "disabled",
                  true
                );
              }
            }
          }
          //console.log(count);
        }
      } else if (status === "4th") {
        var disabled_status = "Elective";
        $(".status_" + status).prop("checked", false);
        $(".status_" + status).prop("disabled", true);
      }
      var limit_val = $("#limit_" + status).val();
      $(".main_" + main_subject + "_status_" + status).prop(
        "checked",
        true
      );
      $(".main_" + main_subject + "_status_" + status).prop(
        "disabled",
        false
      );
      $(".main_" + main_subject + "_status_" + disabled_status).prop(
        "checked",
        false
      );
      $(".main_" + main_subject + "_status_" + disabled_status).prop(
        "disabled",
        true
      );
      // console.log(limit_val);
      $(".subject-list-class-" + status).html("");
      var selected_subject = 0;
      for (let s = 0; s < 10; s++) {
        if ($(".status_" + status + "_" + s).is(":checked")) {
          selected_subject =parseInt(selected_subject) + 1;
          var subject_name = $(".status_" + status + "_" + s).attr(
            "subject-name"
          );
          var code = $(".status_" + status + "_" + s).attr("code");
          var html =
            `<strong id="">` +
            subject_name +
            ` (` +
            code +
            `)</strong><br>`;
          $(".subject-list-class-" + status).append(html);
        }
      }
      $('#selected_subject_'+status).val(selected_subject);
    } else {
      var code = $(this).attr("code");
      var main_subject = $(this).attr("main-subject");
      var status = $(this).attr("subject-status");
      var section = $(this).attr("section");
      if (status === "Elective") {
        var disabled_status = "4th";
        if (section != 2) {
          $('.status_'+status).prop('disabled',false);
          $('.status_'+status).prop('checked',false);
        } else {
          var count = -1;
          for (let i = 0; i < 10; i++) {
            if ($(".status_" + status + "_" + i).is(":checked")) {
              count = count + 1;
            }
          }
          if (count < 5) {
            for (let j = 0; j < 10; j++) {
              if (
                $(".status_" + status + "_" + j).prop(
                  "disabled"
                ) == true
              ) {
                $(".status_" + status + "_" + j).prop(
                  "disabled",
                  false
                );
              }

              for (let k = 0; k < 10; k++) {
                if (
                  $(
                    ".status_" + disabled_status + "_" + k
                  ).is(":checked")
                ) {
                  var code = $(
                    ".status_" + disabled_status + "_" + k
                  ).attr("code");
                  $("." + status + "_code_" + code).prop(
                    "disabled",
                    true
                  );
                }
              }
            }
          }
        }
      } else if (status === "4th") {
        var disabled_status = "Elective";
        $(".status_" + status).prop("disabled", false);
        $(".status_" + status).prop("checked", false);
        if (section == 2) {
          for (let i = 0; i < 10; i++) {
            if (
              $(".status_" + disabled_status + "_" + i).is(
                ":checked"
              )
            ) {
              var code = $(
                ".status_" + disabled_status + "_" + i
              ).attr("code");
              $("." + status + "_code_" + code).prop(
                "disabled",
                true
              );
            }
          }

          var el_count = 0;
          for (let i = 0; i < 10; i++) {
            if (
              $(".status_" + disabled_status + "_" + i).is(
                ":checked"
              )
            ) {
              el_count = el_count + 1;
            }
          }
          // console.log("El:" + el_count);
        }
      }

      $(".main_" + main_subject + "_status_" + disabled_status).prop(
        "checked",
        false
      );
      $(".main_" + main_subject + "_status_" + disabled_status).prop(
        "disabled",
        false
      );
      $(".main_" + main_subject + "_status_" + status).prop(
        "checked",
        false
      );
      if (status === "Elective") {
        for (let t = 0; t < 10; t++) {
          if (
            $(".status_" + disabled_status + "_" + t).is(":checked")
          ) {
            $(
              ".main_" +
              main_subject +
              "_status_" +
              disabled_status
            ).prop("disabled", true);
          }
        }
      } else if (status === "4th") {
        if (el_count > 5) {
          $(
            ".main_" + main_subject + "_status_" + disabled_status
          ).prop("disabled", true);
        }
      }
      if (status === "Compulsory") {
        $(".main_" + main_subject + "_status_" + status).prop(
          "checked",
          true
        );
      }
      $(".subject-list-class-" + status).html("");
      var selected_subject = 0;
      for (let s = 0; s < 10; s++) {
        if ($(".status_" + status + "_" + s).is(":checked")) {
          selected_subject = selected_subject + 1;
          var subject_name = $(".status_" + status + "_" + s).attr(
            "subject-name"
          );
          var code = $(".status_" + status + "_" + s).attr("code");
          var html =
            `<strong id="">` +
            subject_name +
            ` (` +
            code +
            `)</strong><br>`;
          $(".subject-list-class-" + status).append(html);
        }
      }
      $('#selected_subject_'+status).val(selected_subject);
    }
    // $('.subject').val($(this).is(':checked'));
  });
});
