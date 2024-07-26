(function ($) {
  const tosCheckbox = document.getElementById("tos");
  const signupButton = document.getElementById("signup");

  tosCheckbox.addEventListener("change", () => {
    if (tosCheckbox.checked) {
      signupButton.disabled = false;
    } else {
      signupButton.disabled = true;
    }
  });

  // Initially disable the button if the checkbox is unchecked
  if (!tosCheckbox.checked) {
    signupButton.disabled = true;
  }

  $(".login").submit(function (e) {
    e.preventDefault();

    // remove error
    $(".email").removeClass("is-invalid");
    $(".password").removeClass("is-invalid");

    // remove html
    $(".emailErr").html("");
    $(".passwordErr").html("");

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "forms/accounts/signin.php",
      data: formData,
      dataType: "json",
      encode: true,
      timeout: 10000, // set timeout
      beforeSend: function () {
        // show loading button while processing
        $("#signinLoading").html('<i id="afL" class="fas fa-spinner"></i>');
      },
    })
      .done(function (data) {
        // handle successful response
        if (data.success) {
          // hide loading button
          $("#afterSignin").html("");
          // Display success message
          $("#afterSignin").html(data.message);
          setTimeout(() => window.location.replace("./"), 7500);
        } else {
          // error return
          try {
            if (data.errors.email) {
              $(".email").addClass("is-invalid");
              $(".emailErr").html(
                '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-triangle-exclamation text-warning"></i> ' +
                  data.errors.email +
                  "</span>"
              );
            }

            if (data.errors.password) {
              $(".password").addClass("is-invalid");
              $(".passwordErr").html(
                '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-triangle-exclamation text-warning"></i> ' +
                  data.errors.password +
                  "</span>"
              );
            }

            // if (data.errors.login) {
            //   $(".password").addClass("is-invalid");
            //   $(".passwordErr").html(
            //     '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-triangle-exclamation text-warning"></i> ' +
            //       data.errors.login +
            //       "</span>"
            //   );
            // }

            /*
            if (data.errors.email || data.errors.password) {
              $(".email").addClass("is-invalid");
              $(".password").addClass("is-invalid");

              $(".err").html(
                '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-triangle-exclamation text-warning"></i> Invalid email or password</span>'
              );
            } */
          } catch (error) {
            console.error("Error handling error response:", error);
          }
        }
        // remove loading button when request is complete
        $("#afterSignin").find(".badge.badge-info").remove();
      })
      .fail(function (errorResponse, textStatus, errorThrown) {
        // handle error response
        try {
          if (textStatus === "timeout") {
            // handle timeout error
            $("#signinLoading").html(
              '<span class="badge badge-danger btn-block" style="width: fit-content;display: inline;">Error!! Request timed out.</span>'
            );
          } else {
            // handle other errors
            $("#afterSignin").html(
              '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;">Error ' +
                errorResponse.status +
                ": " +
                errorResponse.statusText +
                "</span>"
            );
          }
          $("#signinLoading").removeClass("mb-4");
        } catch (error) {
          console.error("Error handling error response:", error);
        }
        // remove loading button when request is complete
        $("#signinLoading").find("#afL").remove();
      });
  });

  $("#createaccount").submit(function (e) {
    e.preventDefault();

    // remove error
    $("#school, #programme, #fullname, #regNo, #email, #password").removeClass(
      "is-invalid"
    );

    // remove html
    $(
      "#schoolErr, #programmeErr, #fullnameErr, #regNoErr, #emailErr, #passwordErr"
    ).html("");

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "forms/accounts/signup.php",
      data: formData,
      dataType: "json",
      encode: true,
      timeout: 10000, // set timeout
      beforeSend: function () {
        // show loading button while processing
        $("#signupLoading").html('<i id="afS" class="fas fa-spinner"></i>');
      },
    })
      .done(function (data) {
        // handle successful response
        if (data.success) {
          // hide loading button
          $("#afS").remove();
          // Display success message
          $("#afterSignup").html(
            '<span class="badge badge-success btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-check-circle text-success"></i> ' +
              data.message +
              "</span>"
          );
          //setTimeout(() => window.location.replace("./"), 7500);
        } else {
          // error return
          try {
            $.each(data.errors, function (key, value) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Err").html(
                '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;"> <i class="fas fa-triangle-exclamation text-warning"></i> ' +
                  value +
                  "</span>"
              );
            });
          } catch (error) {
            console.error("Error handling error response:", error);
          }
        }
      })
      .fail(function (errorResponse, textStatus, errorThrown) {
        // handle error response
        try {
          if (textStatus === "timeout") {
            // handle timeout error
            $("#signupLoading").html(
              '<span class="badge badge-danger btn-block" style="width: fit-content;display: inline;">Error!! Request timed out.</span>'
            );
          } else {
            // handle other errors
            $("#afterSignup").html(
              '<span class="badge badge-danger btn-block mb-3" style="width: fit-content;display: inline;">Error ' +
                errorResponse.status +
                ": " +
                errorResponse.statusText +
                "</span>"
            );
          }
          $("#signupLoading").removeClass("mb-4");
        } catch (error) {
          console.error("Error handling error response:", error);
        }
        // remove loading button when request is complete
        $("#signupLoading").find("#afS").remove();
      });
  });

  $('#search-box').on("keyup input", function() {
    /* Get input value on change */
    var inputVal = $(this).val();
    var resultDropdown = $('#search-results');
    if (inputVal.length) {
      $.ajax({
        url: "forms/search.php",
        method: "GET",
        data: { term: inputVal },
        success: function(data) {
          // Display the returned data in the browser
          resultDropdown.html(data);
        },
        error: function(xhr, status, error) {
          console.error("Error fetching search results: " + error);
          resultDropdown.html('<p>Error fetching results. Please try again later.</p>');
        }
      });
    } else {
      resultDropdown.empty();
    }
  });

  // Set search input value on click of result item
  $(document).on("click", "#search-results table tr", function() {
    var courseTitle = $(this).find("td:eq(1) p:first-child").text();
    $('#search-box').val(courseTitle);
    $('#search-results').empty();
  });
})(jQuery);
