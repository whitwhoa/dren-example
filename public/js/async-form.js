/*

<async-form
    csrf-token="nullable"
    bearer-token="nullable"
    validation-rules="together|per-element"
    on-response="flash-{ms}|flash-redirect-{ms}|redirect|confirm|confirm-redirect"

 */

class AsyncForm extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback()
    {
        this.processingTransaction = false;
        this.loadingOverlay = document.querySelector('loading-overlay');
        this.form = this.querySelector('form');
        this.setupForm();
    }

    setupForm()
    {
        this.form.addEventListener('submit', (event) => {
            event.preventDefault();

            if(this.processingTransaction)
                return;

            this.loadingOverlay.show();
            this.processingTransaction = true;
            this.sendFormData(new FormData(this.form));

        });
    }

    async sendFormData(formData) {
        try
        {
            let csrfToken = this.getAttribute('csrf-token');
            let bearerToken = this.getAttribute('bearer-token');

            let fetchOptions = {
                method: this.form.method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: formData

            };

            // Add conditional headers
            /*
                If you are using this element within a webapp, then you're probably authenticating users via session ids
                saved within a cookie, in which case you need to include a csrf token to mitigate potential csrf attacks
                since cookies are sent with every request.

                If you are using this element within an spa (or in our case an spa capacitor mobile app), you need to
                include an access token in the http Authorization header
             */
            if (csrfToken)
                fetchOptions.headers['X-CSRF-TOKEN'] = csrfToken;
            if (bearerToken)
                fetchOptions.headers['Authorization'] = 'Bearer ' + bearerToken;


            let response = await fetch(this.form.action, fetchOptions);

            if (response.ok)
            {
                // success
                //console.log(await response.text());

                this.loadingOverlay.hide();

            }
            else
            {
                // error
                //console.error('HTTP error', response.status);



            }
        }
        catch (error)
        {
            console.error('Fetch error', error);
        }
    }

}

window.customElements.define('async-form', AsyncForm);