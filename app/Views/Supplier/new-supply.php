<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
فاتورة توريد <?= $supplier->name ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">فاتورة توريد جديدة ل<?= $supplier->name ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">


        </div>
    </div>
</div>



<section class="p-3">


    <?= form_open('/suppliers/add-to-cart') ?>
    <input type="text" name="supplier-id" value="<?= $supplier->id ?>" hidden>



    <div class="col-2 pt-3 btn-block">
        <select class="selectpicker" aria-label="Default select example"  data-size="10" data-live-search="true" name="products[]" multiple required>
            <?php foreach ($products as $meta): ?>
                <?php foreach (getAllProducts($meta->product_id) as $product): ?>
                    <option value="<?= $product->id ?>" <?= (session()->has('cart-' . $supplier->id) && in_array($product->id, session()->get('cart-' . $supplier->id))) ? 'selected' : ' ' ?>><?= getUnitName(getProductUnit($product->id)) . ' ' . $product->name   ?></option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-auto py-2 btn-block">
        <button type="submit" class="btn btn-success mb-3">اضافة منتج</button>
    </div>
    <?= form_close() ?>

    <?= form_open('/suppliers/submit-new-supply/' . $supplier->id) ?>
    <div class="col-5 pb-5 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ملحوظات الفاتورة</span>
        <textarea class="form-control" name="notes" aria-label="With textarea"></textarea>
    </div>

    <table class="table table-borderless pt-3 table-responsive">
        <thead>
        <tr>
            <th scope="col">حذف</th>
            <th scope="col">اسم المنتج</th>

            <th scope="col">الكمية</th>
            <th scope="col">نوع الوحدة</th>
            <th scope="col">سعر الوحدة</th>

            <th scope="col">قيمة المنتج التقديرية</th>

        </tr>
        </thead>
        <tbody>

        <?php if (session()->has('cart-' . $supplier->id)): ?>
        <?php foreach (session()->get('cart-' . $supplier->id) as $product): ?>
        <tr class="align-middle">
            <th scope="row"><a href="<?= site_url('/suppliers/remove-item/'. $product .'/cart-'. $supplier->id .'') ?>" class="btn btn-danger">x</a></th>
            <td><?= getProductName($product) ?></td>
            <td><input type="number" id="a<?= $product ?>" oninput="calculate('a<?= $product ?>', 'p<?= $product ?>', 't<?= $product ?>')" name="products[<?= $product ?>][qty]" onmousewheel="onWheel()" min="1" placeholder="الكمية" class="form-control" ></td>
            <td><?= getUnitName(getProductUnit($product)) ?></td>
            <td><input type="number" id="p<?= $product ?>" oninput="calculate('a<?= $product ?>', 'p<?= $product ?>', 't<?= $product ?>')" name="products[<?= $product ?>][price]" value="<?= getPriceOf($product) ?>" onmousewheel="onWheel()" min="1" placeholder="الكمية" class="form-control" ></td>

            <td><input type="number" id="t<?= $product ?>" class="form-control total" disabled></td>
        </tr>
        <?php endforeach; ?>
            <tr class="align-bottom">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" style="text-align: left" id="total" class="form-control" disabled></td>

            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="col-2 pb-5 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">من فضلك قم بأدخال القيمة الفعلية للفاتورة من المورد</span>
        <input class="form-control col-2" type="number"  name="actual_total" aria-label="With textarea" required>
    </div>

</section>

<div class="col-auto btn-block">
    <button type="submit" class="btn btn-primary mb-3">تسجيل التوريد</button>
</div>
<?= form_close() ?>

<script>
    $(document).ready( function (){
        const formatToCurrency = amount => {
            return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") + " جنيه " ;
        };
        calculate = function (a, p, t) {
            const amount = document.getElementById(a).value;
            const price = document.getElementById(p).value;
            document.getElementById(t).value = parseInt(amount)*parseInt(price);
            let sum = 0;
            $(".total").each(function(){
                sum += +$(this).val();  // Or this.innerHTML, this.innerText
            });
            $("#total").val(formatToCurrency(sum));
        }
    });




</script>

<?= $this->endSection(); ?>
