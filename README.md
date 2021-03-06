# kandy-cpaas2-sample-sms-php

This is a SMS application where a user can send an sms, subscribe sms notification and receive real-time sms events (inbound, outbound etc notification).


## Installation

1. Update `.env.example` and rename to `.env` and add the appropriate values.

    ```bash
    Example : 
     CLIENT_ID=abcde123-12a1-1a23-1234-123a12345a1a
     CLIENT_SECRET=123abcde-a123-1234-abcd-ab12345c67d8
     BASE_URL=baseurl.domain.com
     PHONE_NUMBER=+16543219870
    ```

2. To install dependencies, run:

    ```bash
    composer install
    ```
    
3. Step into `public` folder
	```bash
	cd public
	```

4. To start the server, get into the public folder and run:
	```bash
	php -S localhost:8888
	```

ENV KEY       | Description
------------- | -------------
CLIENT_ID     | Private project key
CLIENT_SECRET | Private project secret
BASE_URL      | URL of the CPaaS server to use
SENDER_NUMBER | Phone number purchased in CPaaS portal (sender phone number)


## Usage

The application has a simple page with 3 section:

### Section 1 - Send SMS

There are two fields in the form

1. Phone number - The phone number where the SMS is to be send.
2. Message - A text message for the SMS

When clicked on `Send` button, an SMS is sent out where the `sender` phone number is the one add in `.env` file (SENDER_NUMBER) and `destination` is the one entered in the form.

### Section 2 - SMS notification subscription

This represents the subscription to SMS notification and can be found on the top right section. Here a Webhook host URL is to added.

As incoming notifications are to be received by the local server. There is a need of a web server to be running and that web server to have a public IP address. So to use this, it is recommended to install and use [ngrok](https://ngrok.com/).

#### How to use ngrok

After installing `ngrok`, run the following command

```bash
ngrok http 3001
```

Where 3001 is the `PORT` that is used while running the software.

Once `ngrok` starts forwarding the `localhost`, you would find a similar kind of message in your screen.

```bash
ngrok by @inconshreveable                                                                  (Ctrl+C to quit)

Session Status                online
Session Expires               7 hours, 28 minutes
Update                        update available (version 2.3.34, Ctrl-U to update)
Version                       2.3.28
Region                        United States (us)
Web Interface                 http://127.0.0.1:4040
Forwarding                    http://29de1e3e.ngrok.io -> http://localhost:3001
Forwarding                    https://29de1e3e.ngrok.io -> http://localhost:3001

Connections                   ttl     opn     rt1     rt5     p50     p90
                              0       0       0.00    0.00    0.00    0.00
```

After this the usage part of `ngrok` is done and we got out public domain, let's shift out attention to the notification subscription.

Copy the `forwarding` domain, for our case it is `https://29de1e3e.ngrok.io` from above and paste it to in the `Webhook host URL` input field.
Click `Subscribe` and a notification channel would be created with the above domain against the phone number that is described in the `.env` file (PHONE_NUMBER) and all the sms notifications would start coming in.

**Note**: While entering the ngrok domain and subscribing, make sure that there is not forward slash at the end of the domain.

- **Correct** `https://29de1e3e.ngrok.io`
- **Incorrect** `https://29de1e3e.ngrok.io/`

### Section 3 - SMS Notification

This is the bottom half of the right section of the application. As in `section 2` we subscribed for all the SMS notification against the phone number described in the `.env` file (PHONE_NUMBER), whenever we send out an sms using the `Send SMS` section or get an sms to the phone number described in the `.env` file (PHONE_NUMBER), we would receive a notification and that notification would be printed out under the `SMS Notification` header