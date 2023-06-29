/*

<async-form
    csrf-token="nullable"
    bearer-token="nullable"
    validation-errors="together|per-element"
    on-response="flash-{ms}|flash-redirect-{ms}|redirect|confirm|confirm-redirect"
    redirect-url="/some/url/route/{response_var_name}/{response_var_name_2}/...."
    success-message="Success!"
    processing-message="Processing..."
    unnamed-element-validation-callback="myGloballyAccessibleFunction()"

 */

class AsyncForm extends HTMLElement
{
    constructor()
    {
        super();
    }

    connectedCallback()
    {
        this.processingTransaction = false;
        this.loadingOverlay = document.querySelector('loading-overlay');
        this.alertMessage = document.querySelector('alert-message');
        this.form = this.querySelector('form');
        this.setupForm();
    }

    getValueInBrackets(str)
    {
        let match = str.match(/{([^}]+)}/);

        if (match)
            return match[1]; // Return only the capture group

        return null;
    }

    replaceVarsInUrl(url, obj)
    {
        return url.replace(/{([^}]+)}/g, function(match, captureGroup) {
            return obj[captureGroup];
        });
    }

    setupForm()
    {
        this.form.addEventListener('submit', (event) => {
            event.preventDefault();

            if(this.processingTransaction)
                return;

            this.processingTransaction = true;

            let processingMessage = this.getAttribute('processing-message');

            if(processingMessage)
                this.loadingOverlay.show(processingMessage);
            else
                this.loadingOverlay.show();

            this.sendFormData(new FormData(this.form));

        });
    }

    async sendFormData(formData) {
        try
        {
            // Get attributes
            let bearerToken = this.getAttribute('bearer-token');
            let validationErrors = this.getAttribute('validation-errors');
            let onResponse = this.getAttribute('on-response');
            let successMessage = this.getAttribute('success-message');
            let redirectUrl = this.getAttribute('redirect-url');
            let unnamedElementValidationCallback = this.getAttribute('unnamed-element-validation-callback');

            // Set request data
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

                // change csrfToken to be included as hidden value in form data vs in header, removed all together
                // because you can just add it to the form elements in the markup
             */
            if (bearerToken)
                fetchOptions.headers['Authorization'] = 'Bearer ' + bearerToken;

            // Send request
            let response = await fetch(this.form.action, fetchOptions);

            // Check request
            if (response.ok) // valid response, 200
            {
                let responseJson = await response.json();

                this.loadingOverlay.hide();

                if(!successMessage)
                    successMessage = 'Success!';

                if(onResponse.includes('flash-redirect'))
                {
                    this.alertMessage.show(successMessage, 'success');

                    let time = parseInt(this.getValueInBrackets(onResponse));

                    setTimeout(() => {

                        if(!redirectUrl)
                            window.location.reload();

                        window.location.href = this.replaceVarsInUrl(redirectUrl, responseJson);

                    }, time);
                }
                else if(onResponse.includes('flash'))
                {
                    this.alertMessage.show(successMessage, 'success', parseInt(this.getValueInBrackets(onResponse)));
                    this.form.reset();
                }
                else if(onResponse.includes('confirm-redirect'))
                {
                    this.alertMessage.show(successMessage, 'success', () => {
                        if(!redirectUrl)
                            window.location.reload();

                        window.location.href = this.replaceVarsInUrl(redirectUrl, responseJson);
                    });
                }
                else if(onResponse.includes('confirm'))
                {
                    this.alertMessage.show(successMessage, 'success', () => {
                        this.form.reset();
                    });
                }
                else if(onResponse.includes('redirect'))
                {
                    if(!redirectUrl)
                        window.location.reload();

                    window.location.href = this.replaceVarsInUrl(redirectUrl, responseJson);
                }
            }
            else // http error, something other than 2xx
            {
                this.processingTransaction = false;
                this.loadingOverlay.hide();

                let responseJson = await response.json();

                if(response.status !== 422 || (response.status === 422 && !responseJson.hasOwnProperty('errors')))
                {
                    this.alertMessage.show('An unexpected error has occurred while processing your request', 'danger', () => {});
                    return;
                }

                // if we made it here, then we know we have received a response with code 422 and that the required
                // 'errors' property is present within the responseJson object.

                // TODO: THIS WHERE WE LEFT OFF....need logic that utilizes the validationErrors variable to determine if
                // we should display all the error messages in one big block right above the form, or use individual
                // validation messages and css classes

                // clear previous errors
                this.form.querySelectorAll('.invalid-feedback').forEach(e => e.parentNode.removeChild(e));

                // get all input elements within form
                let inputElements = this.form.querySelectorAll("input, textarea, select");

                // convert the NodeList to an array, extract the "name" property of each element,
                // and filter out duplicate names
                let namedElements = Array.from(inputElements)
                    .map((element) => element.name)
                    .filter((name, index, array) => array.indexOf(name) === index);

                // remove 'is-invalid' class from all elements
                inputElements.forEach(e => e.classList.remove('is-invalid'));

                // must figure out how to handle elements of arrays, going to go hack around in the
                // form-array-element-example...
                //
                // ok, so when submitting form inputs that are array's their names follow the below format
                // [
                //     "keyValPair[0][key]",
                //     "keyValPair[0][value]"
                // ]
                // I have tweaked the request validator to output using this format instead of the .* format so the
                // names that are returned can be used just like names that are not arrays and then referenced correctly
                // in the below code to auto set error styles/messages...woot

                // add invalid classes to all elements which require them
                Object.keys(responseJson.errors).forEach((key) => {

                    if(namedElements.includes(key))
                    {
                        let element = this.form.querySelector('input[name="' + key + '"]') ||
                            this.form.querySelector('select[name="' + key + '"]') ||
                            this.form.querySelector('textarea[name="' + key + '"]');

                        element.classList.add('is-invalid');

                        element.insertAdjacentHTML('afterend','<span class="invalid-feedback" role="alert"><strong>' +
                            responseJson.errors[key][0] + '</strong></span>');
                    }

                    // include a callback here for extended functionality
                    if(unnamedElementValidationCallback && typeof window[unnamedElementValidationCallback] === 'function')
                        window[unnamedElementValidationCallback](key, responseJson.errors);

                });

            }
        }
        catch (error) // bad error
        {
            console.error('Fetch error', error);
            this.alertMessage.show('An unexpected error has occurred while processing your request', 'danger', () => {});
        }
    }

}

window.customElements.define('async-form', AsyncForm);