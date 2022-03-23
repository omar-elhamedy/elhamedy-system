<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">اسعار العملات من البنك المركزى المصرى</h1>
</div>

<section class="p-3 mx-auto">
    <?= $data[0] ?>
</section>

<script type="text/javascript">
    document.onload = myFunction();
        function myFunction() {
            const table = document.querySelector("table");
            const thead = document.querySelector("thead")
            table.removeAttribute("xmlns:asp");
            table.removeAttribute("xmlns:dt");
            thead.classList.add("table-dark");
            table.classList.add("table-sm", "table-bordered", "table-light", "table-hover", "rounded");
        }
</script>
<?= $this->endSection(); ?>
