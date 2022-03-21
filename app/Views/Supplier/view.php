<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المورد (<?= $supplier->name ?>)</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/suppliers') ?>" class="btn btn-sm btn-outline-secondary">تعديل البيانات</a>
            <a type="button" href="<?= site_url('/suppliers') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>
    </div>
</div>

<section>
    <h4>قائمة المنتجات</h4>

            <section class="p-3 mx-auto">
                <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">اسم المنتج</th>
                        <th scope="col">سعر المنتج</th>
                        <th scope="col">اخر تاريخ توريد</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
<!--1 abyad w aswed-->
<!--0 game3 al2alwan-->
<!--2 bdon lon-->
                        <?php if (getProductColorId($product->product_id) === '1'): ?>

                                    <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
                                        <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>
                                        <tr>
                                            <td><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) ?></td>
                                            <td><input type="number" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                        <?php endif; ?>
                        <?php if (getProductColorId($product->product_id) === '0'): ?>

                            <?php if (!empty(getAllProductsBySize($product->product_id))): ?>
                                <?php foreach (getAllProductsBySize($product->product_id) as $item): ?>
                                    <tr>
                                        <td><?= getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id)  . ' ' . getTypeName($item->type_id) ?></td>
                                        <td><input type="number" onmousewheel="onWheel()" min="1" placeholder="السعر" class="form-control wheelable" ></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

</section>


<?= $this->endSection(); ?>
