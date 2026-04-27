<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>
    <style>
      #toastContainer {
          z-index: 9999 !important;
      }
    </style>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <div class="app-brand justify-content-center">
              <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo demo" style="background-color: black; padding: 5px; border-radius: 6px;">
                <img src="{{ asset('assets/img/dustlogo.png') }}"
                    alt="Logo"
                    style="height: 40px;">
              </span>
              </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
              <!-- /Logo -->
              {{-- <h4 class="mb-2">Welcome to Sneat! </h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

              <form id="login_form" class="mb-3">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary d-grid w-100" >Sign in</button>
                </div>
              </form>

              {{-- <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p> --}}
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <script>
      $(document).ready(function () {
          function showToast(message, type = 'success') {

              let bgClass = 'bg-success';
              let icon = 'bx-check-circle';

              if (type === 'error') {
                  bgClass = 'bg-danger';
                  icon = 'bx-error-circle';
              } else if (type === 'warning') {
                  bgClass = 'bg-warning';
                  icon = 'bx-error';
              }

              let toastHTML = `
                  <div class="bs-toast toast fade ${bgClass}" role="alert">
                      <div class="toast-header">
                          <i class="bx ${icon} me-2"></i>
                          <div class="me-auto fw-semibold">Notification</div>
                          <small>Now</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                      </div>
                      <div class="toast-body">
                          ${message}
                      </div>
                  </div>
              `;

              let container = $('#toastContainer');
              let toastElement = $(toastHTML);

              container.append(toastElement);

              let toast = new bootstrap.Toast(toastElement[0], {
                  delay: 3000
              });

              toast.show();

              // remove after hidden
              toastElement.on('hidden.bs.toast', function () {
                  $(this).remove();
              });
          }

          $('#login_form').validate({

            ignore: ":hidden:not(.force-validate)",
            
            rules: {
                status_type: {
                    required: true
                },
                status_name: {
                    required: true
                },
                next_status: {
                    required: true
                },
                'categ_id[]': {
                    required: true
                },
                hold_pause_activity: {
                    required: true
                },
                // Localization
                'localization_name[]': {
                    required: true
                },
                'localization_lang[]': {
                    required: true
                }
            },

            messages: {
                status_type: {
                    required: "Please select a status type."
                },
                status_name: {
                    required: "Please enter the status name."
                },
                next_status: {
                    required: "Please select the next status."
                },
                'categ_id[]': {
                    required: "Please select at least one category."
                },
                hold_pause_activity: {
                    required: "Please choose hold/pause activity."
                },

                // Localization
                'localization_name[]': {
                    required: "Please enter status name for all languages."
                },
                'localization_lang[]': {
                    required: "Please select at least one language."
                }
            },

            submitHandler: function (form) {
                let formData = new FormData(form);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                url: "{{ route('check_login') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                //  BEFORE SEND
                beforeSend: function () {

                    // Disable submit button
                    $('#login_form button[type="submit"]').prop('disabled', true);

                    // Change button text (optional)
                    $('#login_form button[type="submit"]').html(
                        `<span class="spinner-border spinner-border-sm me-2"></span> Signing in...`
                    );
                },

                //  SUCCESS
                success: function (response) {

                    if (response.status) {
                        showToast(response.message, 'success');
                        window.location.href = response.redirect_url;

                        $('#login_form')[0].reset();

                    } else {
                        showToast(response.message, 'error');
                    }
                },

                //  ERROR
                error: function (xhr) {

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            showToast(messages[0], 'error'); // replaced toastr 
                        });

                    } else {
                        showToast(xhr.responseJSON.message || 'Something went wrong!', 'error');
                    }
                },

                //  AFTER COMPLETE (always runs)
                complete: function () {

                    // Enable button again
                    $('#login_form button[type="submit"]').prop('disabled', false);

                    // Restore button text
                    $('#login_form button[type="submit"]').html('Submit');
                }
            });
            }
          });

      });
    </script>
  </body>
</html>
