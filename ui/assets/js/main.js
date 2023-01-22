/* Select 2
===========================*/
$(document).ready(function () {
  "use strict";
  if ($(".select").length > 0) {
    $(".select").select2();
  }
});

/* Toggle Icon
==============================*/
$(document).ready(function () {
  "use strict";
  $(".toggle-btn").click(function () {
    $("aside").toggleClass("move");
  });
});

/* Date Picker 
===========================*/
$(document).ready(function () {
  "use strict";
  if ($(".flatpickr-input").length > 0) {
    $(".flatpickr-input").flatpickr({
      enableTime: false,
      minDate: "today",
      dateFormat: "Y-m-d",
    });
  }
  if ($(".timer_count").length > 0) {
    $(".timer_count").countTo();
  }
});

/* Data Table
=======================*/
$(document).ready(function () {
  "use strict";
  if ($(".datatable_full").length > 0) {
    $(".datatable_full").DataTable({
      fixedHeader: true,
      dom: "Bfrtip",
      buttons: ["excel", "pdf"],
    });
  }
});

/* Show Password
===========================*/
var state = false;
function toggle() {
  if (state) {
    document.getElementById("password").setAttribute("type", "password");
    document.getElementById("show_pass").setAttribute("class", "fa fa-eye");
    state = false;
  } else {
    document.getElementById("password").setAttribute("type", "text");
    document
      .getElementById("show_pass")
      .setAttribute("class", "fas fa-eye-slash");
    state = true;
  }
}
/* Loading 
================================*/
$(window).on("load", function () {
  "use strict";
  $(".load_cont").fadeOut(function () {
    $(this).parent().fadeOut();
    $("body").css({
      "overflow-y": "visible",
    });
  });
});
