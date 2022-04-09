<?php use CodeIgniter\I18n\Time;

if (getProductColorId($product->product_id) === '2'): ?>

    <?php if (!empty(getAllProducts($product->product_id))): ?>
        <?php foreach (getAllProducts($product->product_id) as $item): ?>
            <?= view('Storage/table', [
                'product_id' => $product->product_id,
                'item' => $item,
                'name' => "$item->id",
                'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id)
            ]) ?>

        <?php endforeach; ?>
    <?php endif; ?>

<?php endif; ?>

