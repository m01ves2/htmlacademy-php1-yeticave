<div class="lot__image">
    <img src="<?= $lot["img"] ?>" width="350" height="260" alt="<?= $lot["name"] ?>">
</div>
<div class="lot__info">
    <span class="lot__category"><?= $lot["category"] ?></span>
    <h3 class="lot__title">
        <a class="text-link" href="lot.php?id=<?= $lot['id'] ?>"><?= $lot["name"] ?></a>
    </h3>
    <div class="lot__state">
        <div class="lot__rate">
            <span class="lot__amount">Стартовая цена</span>
            <span class="lot__cost"><?= formatPrice($lot["price"]) ?></span>
        </div>
        <div class="lot__timer timer
            <?php
                $time_remaining = getLotTimeLeft($lot['enddate']);
                if ($time_remaining[0] < 1) {
                    echo 'timer--finishing';
                } ?>">
                    <?= sprintf("%02d", $time_remaining[0]) . ':' . sprintf("%02d", $time_remaining[1]); ?>
            </div>
    </div>
</div>
