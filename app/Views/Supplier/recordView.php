<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
    فاتورة رقم <?= $record->id ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> فاتورة رقم <?= $record->id ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">


        <div class="btn-group me-2">
            <a type="button" href="javascript:history.back()" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>


    </div>
</div>


<section class="p-3">
    <div class="col-5 pb-5 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ملحوظات الفاتورة</span>
        <textarea class="form-control" name="notes" aria-label="With textarea" disabled><?= $note ?></textarea>
    </div>

    <table class="table table-borderless pt-3 table-responsive">
        <thead>
        <tr>

            <th scope="col">اسم المنتج</th>

            <th scope="col">الكمية</th>
            <th scope="col">نوع الوحدة</th>
            <th scope="col">سعر الوحدة</th>

            <th scope="col">قيمة المنتج</th>

        </tr>
        </thead>
        <tbody>


            <?php foreach ($products as $product): ?>

                <tr class="align-middle">

                    <td><?= getProductName($product->product_id) ?></td>
                    <td><input type="number" value="<?= $product->QTY ?>" class="form-control" disabled></td>
                    <td><?= getUnitName(getProductUnit($product->product_id)) ?></td>
                    <td><input type="number" value="<?= $product->price ?>" class="form-control" disabled></td>

                    <td><input type="text"  style="text-align: left"  value="<?= $product->QTY*$product->price ?>" class="form-control total currency" disabled></td>
                </tr>
            <?php endforeach; ?>
            <tr class="align-bottom">
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td><input type="text" style="text-align: left" id="total" class="form-control" disabled></td>

            </tr>


        </tbody>
    </table>

    <div class="col-2 pb-5 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">القيمة الفعلية للفاتورة من المورد</span>
        <input class="form-control col-2" type="text" style="text-align: left" value="<?= $actual_total . '  جنيه' ?> " name="actual_total" aria-label="With textarea" disabled>
    </div>


</section>



<script>
    $(document).ready( function (){
        const formatToCurrency = amount => {
            return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") + " جنيه " ;
        };



        let sum = 0;
        $(".total").each(function(){
            sum += +$(this).val();  // Or this.innerHTML, this.innerText
        });
        $("#total").val(formatToCurrency(sum));

        $(".currency").each(function(){

            $(this).val(formatToCurrency(parseInt($(this).val())));
            // Or this.innerHTML, this.innerText
        });

    });

</script>
<?= $this->endSection() ?>
