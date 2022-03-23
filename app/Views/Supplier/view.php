<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المورد (<?= $supplier->name ?>)</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/suppliers/edit/' . $supplier->id) ?>" class="btn btn-sm btn-outline-secondary">تعديل البيانات</a>
            <a type="button" href="<?= site_url('/suppliers') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>
    </div>
</div>
<?php if(session()->has('errors')): ?>
    <?php foreach (session('errors') as $err): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                <?= $err ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(session()->has('info')): ?>

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            <?= session()->get('info') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>
<section>

    <div class="col-auto btn-block">
        <a type="button" href="<?= site_url('/suppliers/' . $supplier->id . '/supply-items') ?>" class="btn btn-success mb-3">انشاء فاتورة توريد</a>
    </div>

    <div class="py-2">
        <h4>قائمة المنتجات</h4>
    </div>


            <section class="p-3 mx-auto">
                <?= form_open('/suppliers/prices/update', ['id' => 'price']) ?>
                <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">اسم المنتج</th>
                        <th scope="col">سعر المنتج</th>
                        <th scope="col">الوحدة</th>

                        <th scope="col">اخر تاريخ توريد</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($products as $product): ?>

                    <?php if (getPriceCalcMethod($product->product_id) === '0'): ?>

                        <?= view('/Supplier/table-View/1', ['product' => $product]) ?>

                        <?= view('/Supplier/table-view/0', ['product' => $product])?>

                        <?= view('/Supplier/table-view/2', ['product' => $product])?>







                    <?php elseif (getPriceCalcMethod($product->product_id) === '1'): ?>

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

                    <?php elseif (getPriceCalcMethod($product->product_id) === '2'): ?>

                            <?php if (!empty(getAllProducts($product->product_id))): ?>
                                <?php foreach (getAllProducts($product->product_id) as $item): ?>
                                    <tr>
                                        <td><a href="<?= site_url('inv/edit/' . $product->product_id) ?>"><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id) . ' ' .  getColorName($item->color_id)  . ' ' . getTypeName($item->type_id) ?></a></td>
                                        <td><input type="number" step="0.01" name="<?= $item->id ?>" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                                        <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

                                        <td><?= Time::parse($item->updated_at_product , 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy')?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                    <?php endif; ?>


                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
    <div class="col-auto btn-block">
        <button type="submit" form="price" class="btn btn-success mb-3">تحديث الاسعار</button>
    </div>
    <?= form_close() ?>
</section>




<?= $this->endSection(); ?>
