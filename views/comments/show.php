<div class="container">
    <h3>Vsi komentarji</h3>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <?php echo htmlspecialchars($comment->text); ?>
                <p style="font-size: 12px;">Objavil:<?php echo htmlspecialchars($comment->user->username); ?>, <?php echo date_format(date_create($comment->date), 'd. m. Y \ob H:i:s'); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Ni komentarjev na tej novici.</p>
    <?php endif; ?>
</div>
