<?php
$host = \yii\helpers\Url::base(true);
echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <?php
    foreach ($ids as $prefix => $modelIds) :
        foreach ($modelIds as $id) :
            ?>
                <url>
                    <loc><?= $host ?>/ru-ru/<?= $prefix ?>/<?= $id ?></loc>
                    <xhtml:link rel="alternate" hreflang="ru-ru" href="<?= $host ?>/ru-ru/<?= $prefix ?>/<?= $id ?>"/>
                    <xhtml:link rel="alternate" hreflang="en-us" href="<?= $host ?>/en-us/<?= $prefix ?>/<?= $id ?>"/>
                </url>
                <?php
        endforeach;
    endforeach;
    ?>
</urlset>
