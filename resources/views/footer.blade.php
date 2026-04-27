 <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @yield('section-js')
    <script>
        $('#logout_btn').click(function (e) {
              e.preventDefault();
              $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
              $.ajax({
                  url: "/logout",
                  type: "POST",
                  success: function (response) {
                      if (response.status == 200) {
                          window.location.href = "/login";
                      }

                  }
              });

        });
    </script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
    <script src="{{ asset('assets/js/ui-toasts.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        $(document).ready(function() {
        
            $('#defaultToggle').addClass('collapsed');
            $('#additionalToggle').addClass('collapsed');
            $('#purchaseToggle').addClass('collapsed');
            $('#financialToggle').addClass('collapsed');
            $('#allottedToggle').addClass('collapsed');
            $('#warrantyToggle').addClass('collapsed');
        
            var table = $('#assetTable').DataTable({
                orderCellsTop: true,
                autoWidth: false,   //  important
                scrollX: true       //  optional but recommended
            });
        
            $('#selectAll').click(function() {
                $('tbody input[type="checkbox"]').prop('checked', this.checked);
            });
        
            //  ONLY THIS (no extra logic)
            let defaultCols = table.columns('.default-extra').indexes().toArray();
            let additionalCols = table.columns('.additional-extra').indexes().toArray();
            let purchaseCols = table.columns('.purchase-extra').indexes().toArray();
            let financialCols = table.columns('.financial-extra').indexes().toArray();
            let allottedCols = table.columns('.allotted-extra').indexes().toArray();
            let warrantyCols = table.columns('.warranty-extra').indexes().toArray();
        
            let defaultOpen = false;
            let additionalOpen = false;
            let purchaseOpen = false;
        
            // DEFAULT
            $('#defaultToggle').on('click', function() {
        
                let isVisible = table.column(defaultCols[0]).visible(); //  check current state
        
                table.columns(defaultCols).visible(!isVisible, false);
        
                table.columns.adjust().draw(false);
        
                $(this).toggleClass('collapsed', isVisible);
        
                $('.toggle-icon')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });
        
            // ADDITIONAL
            $('#additionalToggle').on('click', function() {
        
                let isVisible = table.column(additionalCols[0]).visible();
        
                table.columns(additionalCols).visible(!isVisible, false);
        
                table.columns.adjust().draw(false);
        
                $(this).toggleClass('collapsed', isVisible);
        
                $('.toggle-icon-add')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });
        
            $('#purchaseToggle').on('click', function() {
        
                let isVisible = table.column(purchaseCols[0]).visible();
        
                table.columns(purchaseCols).visible(!isVisible, false);
        
                table.columns.adjust().draw(false);
        
                $(this).toggleClass('collapsed', isVisible);
        
                $('.toggle-icon-purchase')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });

            // FINANCIAL
            $('#financialToggle').on('click', function() {
                let isVisible = table.column(financialCols[0]).visible();
                table.columns(financialCols).visible(!isVisible, false);
                table.columns.adjust().draw(false);
                $(this).toggleClass('collapsed', isVisible);
                $('.toggle-icon-financial')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });

            //Allotted Information
            $('#allottedToggle').on('click', function() {
                let isVisible = table.column(allottedCols[0]).visible();
                table.columns(allottedCols).visible(!isVisible, false);
                table.columns.adjust().draw(false);
                $(this).toggleClass('collapsed', isVisible);
                $('.toggle-icon-allotted')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });

            // WARRANTY
            $('#warrantyToggle').on('click', function() {
                let isVisible = table.column(warrantyCols[0]).visible();
                table.columns(warrantyCols).visible(!isVisible, false);
                table.columns.adjust().draw(false);
                $(this).toggleClass('collapsed', isVisible);
                $('.toggle-icon-warranty')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });
        
        });
    </script>
  </body>
</html>