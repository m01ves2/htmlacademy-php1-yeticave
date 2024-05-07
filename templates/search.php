<?= renderTemplate('./templates/nav.php', []); ?>
<div class="container">
    <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$search?></span>»</h2>
        <ul class="lots__list">
            <?php foreach ($lots as $key => $lot) : ?>
                <li class="lots__item lot">
                    <?= renderTemplate('./templates/lot-preview.php', ['lot' => $lot]); ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (!count($lots)) : ?>
            <p> По вашему запросу ничего не найдено</p>
        <?php endif; ?>
    </section>

    <?= renderTemplate('./templates/_pagination.php', [ 'link' => 'search.php?search='.$search,  'pages' => $pages, 'current_page' => $current_page ] ); ?>
</div>
