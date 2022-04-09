<?php use CodeIgniter\I18n\Time;

if (getProductColorId($product->product_id) === '1'): ?>

    <?php if (!allProductsHasSameType(getAllProductsBySize($product->product_id))): ?>

        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>

                <?= view('Storage/table', [
                    'product_id' => $product->product_id,
                    'item' => $item,
                    'name' => "color[$item->color_id]",
                    'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)
                ]) ?>

            <?php endforeach; ?>
        <?php endif; ?>

    <?php else: ?>

        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>

                <?= view('Storage/table', [
                    'product_id' => $product->product_id,
                    'item' => $item,
                    'name' => "type[$item->type_id][colors][$item->color_id]",
                    'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)
                ]) ?>

            <?php endforeach; ?>
        <?php endif; ?>

    <?php endif; ?>

<?php endif; ?>
