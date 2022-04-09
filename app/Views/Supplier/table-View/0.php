<?php use CodeIgniter\I18n\Time;

if (getProductColorId($product->product_id) === '0'): ?>

    <?php if (!empty(getAllProductsBySize($product->product_id))): ?>


        <?php if (!allProductsHasSameType(getAllProductsBySize($product->product_id))): ?>

            <?php foreach (getAllProductsBySize($product->product_id) as $item): ?>

            <?= view('Storage/table', [
                    'product_id' => $product->product_id,
                    'item' => $item,
                    'name' => "sizes[$item->size_id]",
                    'label' => getMaterialName($item->name) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id)
                ]) ?>

            <?php endforeach; ?>

        <?php else: ?>

            <?php foreach (getAllProductsBySize($product->product_id) as $item): ?>
                <?= view('Storage/table', [
                    'product_id' => $product->product_id,
                    'item' => $item,
                    'name' => "type[$item->type_id][sizes][$item->size_id]",
                    'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id)
                ]) ?>

            <?php endforeach; ?>

        <?php endif; ?>


    <?php endif; ?>

<?php endif; ?>

