<!DOCTYPE html>
<html lang="en">
<head>
  <title>SMS | Home</title>
  <script src="templates/js/notification.js"></script>
</head>
<body>
 
  <div>
   
	<div class="split left">
                <h2>Send SMS</h2>
                <form action="/" method="post">
                    <div>
                        <li>
                            <label for="number">Phone number (E164 format) : </label>
                            <input type="text" name="number" id="number" placeholder="+12223334444" />
                        </li>
                        <li>
                            <label>Message : </label>
                            <input type="text" name="message" id="message" />
                        </li>
                    </div>
                    <button type="submit">Send</button>
                    </br>
					
                </form>
            </div>
	<div class="split right">
                <h2>SMS Notification</h2>
                <form action="/subscribe" method="post">
                    <div>
                        <li>
                            <label for="webhook">Webhook host URL(Ref. README for details) : </label>
                            <input type="text" name="webhook" id="webhook" />
                        </li>
                    </div>
                    <button type="submit">Subscribe</button>
                </form>

                <div id="notification" class="box"></div>
            </div>
  </div>
   <?php if (isset($alert)): ?>
    <div class="alert alert-error">
      <p><?php echo $message ?></p>
    </div>
  <?php endif; ?>
  <?php if (isset($success)): ?>
    <div class="alert alert-success">
      <p><?php echo $message ?></p>
    </div>
  <?php endif; ?>
  <script>
    if (window.smsNotification) {
      setInterval(window.smsNotification.render, 5000)
    }
  </script>
</body>
</html>