<?php use CodeIgniter\I18n\Time;

if (getProductColorId($product->product_id) === '1'): ?>

    <?php if (!allProductsHasSameType(getAllProductsBySize($product->product_id))): ?>

        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>
                <tr>
                    <td><a href="<?= site_url('inv/edit/' . $product->product_id) ?>"><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)?></a></td>
                    <td><input type="number" step="0.01" name="color[<?= $item->color_id ?>]" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                    <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

                    <td><?= Time::parse($item->updated_at_product , 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    <?php else: ?>

        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>
                <tr>
                    <td><a href="<?= site_url('inv/edit/' . $product->product_id) ?>"><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)?></a></td>
                    <td><input type="number" step="0.01" name="type[<?= $item->type_id ?>][colors][<?= $item->color_id ?>]" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                    <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

                    <td><?= Time::parse($item->updated_at_product , 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    <?php endif; ?>

<?php endif; ?>
