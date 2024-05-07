<?php if( count($pages) > 1 ): ?>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev">
            <a href="<?= $current_page > 1 ? $link.'&page='.($current_page - 1) : '#' ?>">Назад</a>
        </li>

        <?php foreach($pages as $page): ?>
            <li class="pagination-item <?= ($page == $current_page ? 'pagination-item-active' : '') ?>">
                <a href="<?=$link?>&page=<?=$page;?>"><?= $page?></a>
            </li>
        <?php endforeach; ?>

        <li class="pagination-item pagination-item-next">
            <a href="<?= $current_page < count($pages) ? $link.'&page='.($current_page + 1) : '#' ?>">Вперед</a>
        </li>

    </ul>
<?php endif; ?>
