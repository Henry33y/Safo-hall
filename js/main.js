$(function () {
  $("#wizard").steps({
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "fade",
      enableAllSteps: true,
      transitionEffectSpeed: 500,
      labels: { finish: "Submit", next: "Forward", previous: "Backward" },
      onStepChanging: function (event, currentIndex, newIndex) {
          // Always allow going backward even if the current step contains invalid fields!
          if (currentIndex > newIndex) {
              return true;
          }

          // Validate only the fields in the current step
          var currentStep = $("#wizard").find("section").eq(currentIndex);
          var inputsAndSelects = currentStep.find("input, select");

          var valid = true;
          inputsAndSelects.each(function () {
              if (!this.checkValidity()) {
                  valid = false;
                  $(this).addClass('is-invalid');
                  $(this).removeClass('valid');
                } else {
                  valid = true;
                  $(this).removeClass('is-invalid');
                  $(this).addClass('valid');
              }
          });

          return valid;
      },
      onFinishing: function (event, currentIndex) {
          // Validate the entire form before finishing
          var form = $("#wizard")[0];
          if (form.checkValidity() === false) {
              $(form).addClass('was-validated');
              return false;
          }

          return true;
      },
      onFinished: function (event, currentIndex) {
        //   alert("Submitted!");
      }
  });

  $(".wizard > .steps li a").click(function () {
      $(this).parent().addClass("checked");
      $(this).parent().prevAll().addClass("checked");
      $(this).parent().nextAll().removeClass("checked");
  });

  $(".forward").click(function () {
      $("#wizard").steps("next");
  });

  $(".backward").click(function () {
      $("#wizard").steps("previous");
  });

  $("html").click(function () {
      $(".select .dropdown").hide();
  });

  $(".select").click(function (event) {
      event.stopPropagation();
  });

  $(".select .select-control").click(function () {
      $(this).parent().next().toggle();
  });

  $(".select .dropdown li").click(function () {
      $(this).parent().toggle();
      var text = $(this).attr("rel");
      $(this).parent().prev().find("div").text(text);
  });
});
