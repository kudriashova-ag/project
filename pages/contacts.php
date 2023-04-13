<h1>Contact Us</h1>

<form action="index.php?page=contacts" method="POST">

  <div class="form-group">
    <label for="name">Name: </label>
    <input type="text" class="form-control" name="name" id="name">
  </div>

  <div class="form-group mt-3">
    <label for="email">Email: </label>
    <input type="email" class="form-control" name="email" id="email">
  </div>

  <div class="form-group mt-3">
    <label for="message">Message: </label>
    <textarea class="form-control" name="message" id="message"></textarea>
  </div>

  <button class="btn btn-primary mt-3" name="action" value="sendMail">Send</button>

</form>