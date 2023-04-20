<h1>Reviews</h1>
<form action="index.php" method="post">

  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="name">
  </div>

  <div class="form-group mt-3">
    <label for="review">Review:</label>
    <textarea class="form-control" name="review"></textarea>
  </div>

  <button class="button mt-3 btn btn-primary" name="action" value="sendReview">Send</button>

</form>


<?
$fName = 'reviews.txt';
$reviews = [];
if (file_exists($fName)) {
  $reviews = json_decode(file_get_contents($fName));
}

$reviews = array_reverse($reviews);

foreach ($reviews as $review) :
?>

  <div class="p-5 shadow-sm mt-3">
    <strong><?= $review->name ?>, <?= date('d.m.Y H:i', $review->time) ?> </strong>
    <div><?= $review->review ?></div>
  </div>

<? endforeach ?>


