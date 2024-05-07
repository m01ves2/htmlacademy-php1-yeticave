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
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
