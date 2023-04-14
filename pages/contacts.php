<h1>Contact Us</h1>

<?php Message::get() ?>

<form action="index.php?page=contacts" method="POST">

  <div class="form-group">
    <label for="name">Name: </label>
    <input type="text" class="form-control" name="name" id="name" value="<?= OldInputs::get('name') ?>">
  </div>

  <div class="form-group mt-3">
    <label for="email">Email: </label>
    <input type="email" class="form-control" name="email" id="email" value="<?= OldInputs::get('email') ?>">
  </div>

  <div class="form-group mt-3">
    <label for="message">Message: </label>
    <textarea class="form-control" name="message" id="message"><?= OldInputs::get('message') ?></textarea>
  </div>


  <div class="mt-3">
    <input type="radio" name="gender" value="male" <?= OldInputs::get('gender') === 'male' ? 'checked' : '' ?>> Male <br>
    <input type="radio" name="gender" value="female" <?= OldInputs::get('gender') === 'female' ? 'checked' : '' ?>> FeMale <br>
  </div>

  <button class="btn btn-primary mt-3" name="action" value="sendMail">Send</button>

</form>