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
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
