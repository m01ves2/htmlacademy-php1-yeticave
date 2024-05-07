<?= renderTemplate('./templates/nav.php', []); ?>
<div class="container">
    <section class="lots">
        <h2>История просмотров</h2>
        <ul class="lots__list">
            <?php foreach($lots as $id => $lot): ?>
                <li class="lots__item lot">
                    <?= renderTemplate('./templates/lot-preview.php', [ 'id' => $id, 'lot' => $lot ] ); ?>
                </li>
            <?php endforeach;  ?>
        </ul>
    </section>
    <?= renderTemplate('./templates/_pagination.php', [ 'link' => 'history.php?pagination=on',  'pages' => $pages, 'current_page' => $current_page ] ); ?>
</div>
