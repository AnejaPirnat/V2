<div class="container">
    <h3>Seznam novic</h3>
    <div class="article">
        <h4><?php echo $article->title;?></h4>
        <p><b>Povzetek:</b> <?php echo $article->abstract;?></p>
        <p><?php echo $article->text; ?></p>
        <p>Objavil: <?php echo $article->user->username; ?>, <?php echo date_format(date_create($article->date), 'd. m. Y \ob H:i:s'); ?></p>
        <a href="/V2/"><button>Nazaj</button></a>
    </div>
</div>
<?php
  if (isset($_SESSION['USER_ID'])) {
      include 'views/comments/create.php';
  }
include 'views/comments/show.php';
?>
