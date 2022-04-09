<tr>
    <td><a href="<?= site_url('inv/edit/' . $product_id) ?>"><?= $label ?></a></td>
    <td><input type="number" step="0.01" name="<?= $name ?>" value="<?= getPriceOf($item->id) ?>" onmousewheel="onWheel()"  placeholder="السعر" class="form-control wheelable" ></td>
    <td>سعر ال<?= getUnitName($item->unit_id) ?></td>

</tr>