<?php use CodeIgniter\I18n\Time;

if (getProductColorId($product->product_id) === '0'): ?>

    <?php if (!empty(getAllProductsBySize($product->product_id))): ?>


        <?php if (!allProductsHasSameType(getAllProductsBySize($product->product_id))): ?>

            <?php foreach (getAllProductsBySize($product->product_id) as $item): ?>
                <tr>
                    <td><a href="<?= site_url('inv/edit/' . $product->product_id) ?>"><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id) ?></a></td>
                    <td><input type="number" step="0.01" name="sizes[<?= $item->size_id ?>]" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                    <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

                    <td><?= Time::parse($item->updated_at_product , 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy')?></td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>

            <?php foreach (getAllProductsBySize($product->product_id) as $item): ?>
                <tr>
                    <td><a href="<?= site_url('inv/edit/' . $product->product_id) ?>"><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id) ?></a></td>
                    <td><input type="number" step="0.01"  name="type[<?= $item->type_id ?>][sizes][<?= $item->size_id ?>]" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                    <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

                    <td><?= Time::parse($item->updated_at_product , 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy')?></td>
                </tr>
            <?php endforeach; ?>

        <?php endif; ?>


    <?php endif; ?>

<?php endif; ?>

