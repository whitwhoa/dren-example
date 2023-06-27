<?php $view_extends = 'master'; ?>
<?php $view_title = 'Form array element example'; ?>

<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of custom html elements "loading-overlay" and "alert-message"<br/>
                </p>
            </div>

            <button class="btn btn-primary pr-2" type="button" id="loadingOverlayButton">Loading Overlay</button>
            <button class="btn btn-primary pr-2" type="button" id="alertMessageButton">Alert Message</button>

        </div>
    </div>

    <!--
        <loading-overlay></loading-overlay> must be included before the closing body tag, in this case
        it is included in the master page

        <alert-message></alert-message> must be included before the closing body tag, in this case
        it is included in the master page
     -->

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>
    <!-- /js/loading-overlay.js must be included, in this case it's included in the master page -->
    <script>
        let overlay = document.querySelector('loading-overlay');

        $('#loadingOverlayButton').click(function(){
            overlay.show();

            setTimeout(function(){
                overlay.hide();
            }, 3000);

        });


        let alertBox = document.querySelector('alert-message');

        $('#alertMessageButton').click(function(){

            // with confirmation callback
            alertBox.show('Success!', 'success', () => {});

            // with confirmation callback, error example
            //alertBox.show('An unexpected error has occurred while processing your request', 'danger', () => {});

            // with auto hide
            //alertBox.show('Success!', 'success', 2000);

            // handle clear manually with some custom functionality later
            //alertBox.show('Success!', 'success');

        });


    </script>
<?php $view_page_specific_js = end_section(); ?>