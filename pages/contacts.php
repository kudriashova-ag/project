<h1>Contacts</h1>

<?php Message::get(); ?>

<form action="index.php" method="POST">
  <div class="form-group mt-3">
    <label for="">Email:</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="form-group mt-3">
    <label for="">Subject:</label>
    <input type="text" name="subject" class="form-control">
  </div>

  <div class="form-group mt-3">
    <label for="">Message:</label>
    <textarea name="message" class="form-control"></textarea>
  </div>

  <button class="btn btn-primary mt-3 w-100" name="action" value="sendMail">Send</button>
</form>