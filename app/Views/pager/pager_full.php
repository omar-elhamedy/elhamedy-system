<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getFirst() ?>" class="page-link" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true">اول صفحة</span>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getPreviousPage() ?>" class="page-link" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true">السابق</span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="page-item active"' : '' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getNextPage() ?>" class="page-link" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true">التالى</span>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getLast() ?>" class="page-link" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true">اخر صفحة</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
