class AlertMessage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: 'open'});
        this.shadowRoot.innerHTML = `
        <style>
            :host {
                display: none;
                position: fixed;
                top: 0; right: 0;
                bottom: 0; left: 0;
                background: rgba(0,0,0,0.7);
                z-index:10000;
                align-items: center;
                justify-content: center;
            }
            .message-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                border-radius: 5px;
                font-weight: bold;
                text-align: center;
                max-width: 80%;
                min-width: 25%;
            }
            .success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #155724;
            }
            .warning {
                background-color: #fff3cd;
                color: #856404;
                border: 1px solid #856404;
            }
            .danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #721c24;
            }
            .alert-message-success-icon,
            .alert-message-warning-icon,
            .alert-message-danger-icon {
                width: 40px;
                margin-bottom: 10px;
            }
            .alert-message-success-icon {
                color: #155724;
            }
            .alert-message-warning-icon {
                color: #856404;
            }
            .alert-message-danger-icon {
                color: #721c24;
            }
        </style>
        <div class="message-box" id="messageBox">
            <svg id="icon" fill="currentColor" viewBox="0 0 16 16">
                <path class="outerPath"/>
                <path class="innerPath"/>
            </svg>
            <div id="messageText"></div>
        </div>
        `;
    }

    show(message, messageType) {
        let icon = this.shadowRoot.querySelector('#icon');
        let messageText = this.shadowRoot.querySelector('#messageText');
        let messageBox = this.shadowRoot.querySelector('#messageBox');
        let outerPath = this.shadowRoot.querySelector('.outerPath');
        let innerPath = this.shadowRoot.querySelector('.innerPath');

        messageText.textContent = message;
        messageBox.className = "message-box " + messageType;

        outerPath.setAttribute('d', 'M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z');
        icon.setAttribute('class', `alert-message-${messageType}-icon`);

        switch(messageType) {
            case 'success':
                innerPath.setAttribute('d', 'M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z');
                break;
            case 'warning':
                innerPath.setAttribute('d', 'M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z');
                break;
            case 'danger':
                innerPath.setAttribute('d', 'M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z');
                break;
        }

        this.style.display = 'flex';
    }

    hide() {
        this.shadowRoot.querySelector('#messageText').textContent = '';
        this.style.display = 'none';
    }
}

window.customElements.define('alert-message', AlertMessage);
