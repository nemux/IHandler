<script type="text/javascript" charset="utf-8">
    var signatures_added = new Array();
    var count_signatures = 0;
    var signatures_list = new Array();

    var signatures_list = Array();
    <?php foreach ($signatures as $s) {
        $sign = htmlspecialchars(addslashes(str_replace(["\r\n", "\r", "\n"],"[nl]",$s->signature)),ENT_NOQUOTES);
        $desc = htmlspecialchars(addslashes(str_replace(["\r\n", "\r", "\n"],"[nl]",$s->description)),ENT_NOQUOTES);
        $recom = htmlspecialchars(addslashes(str_replace(["\r\n", "\r", "\n"],"[nl]",$s->recommendation)),ENT_NOQUOTES);
        $risk = htmlspecialchars(addslashes(str_replace(["\r\n", "\r", "\n"],"[nl]",$s->risk)),ENT_NOQUOTES);
        $ref = htmlspecialchars(addslashes(str_replace(["\r\n", "\r", "\n"],"[nl]",$s->reference)),ENT_NOQUOTES);

        echo "signatures_list.push({sid:\"$s->id\",
                                    signature:\"$sign\",
                                    description:\"$desc\",
                                    recommendation:\"$recom\",
                                    risk:\"$risk\",
                                    reference:\"$ref\"});\n";
    } ?>

    function validateSignature(sid) {
        for (var i = 0; i < signatures_added.length; i++) {
            if (signatures_added[i] == sid) {
                return "1";
            }
        }
        return "0";
    }

    function addSignature(item) {

        var signature = signatures_list[item];
        validate = [signature.sid, signature.signature];
        if (validateEntry(validate) == "1") {
            return 0;
        }

        count_signatures++;

        var signature_row = '<tr  style="cursor:pointer" onclick="removeSignature(this,\'' + item + '\')">'
                + '<td>'
                + signature.sid
                + '<input style="display:none" value="' + signature.sid + '" onkeyup="queryRule(this.value)" class="form-control" placeholder="signature_id" type="text" name="signature_id_' + count_signatures + '" >'
                + '</td>'
                + '<td>'
                + signature.signature
                + '<input style="display:none" value="' + signature.signature + '"  class="form-control" placeholder="firma" type="text" name="signature_' + count_signatures + '" >'
                + '</td></tr>';

        if (validateSignature(signature.sid) == "0") {
            signatures_added.push(signature.sid);

            addText('description', signature.description);//'<b>' + signature + '</b>' + ": " + description);
            addText('recomendations', signature.recommendation);//'<b>' + signature + '</b>' + ": " + recommendation);
            addText('references', signature.reference);//'<b>' + signature + '</b>' + ": " + reference);

            $("#signatures").append(signature_row);
        }
    }

    function removeSignature(tr, item) {
        var signature = signatures_list[item];
        $(tr).remove();

        removeText('description', signature.description);//'<b>' + signature + '</b>' + ": " + description);
        removeText('recomendations', signature.recommendation);//'<b>' + signature + '</b>' + ": " + recommendation);
        removeText('references', signature.reference);// '<b>' + signature + '</b>' + ": " + reference);

        var index = signatures_added.indexOf(signature.sid);
        signatures_added.splice(index, 1);
    }

    /**
     * Agrega texto <b>text</b> al campo de textarea definido por <b>item_id</b>
     * @param item_id
     * @param text
     */
    function addText(item_id, text) {
        var appropriateEditor = $("#" + item_id).data("wysihtml5").editor;
        var value = appropriateEditor.getValue();

        text = formatHtmlText(text);

        appropriateEditor.setValue(value + text, true);
    }

    /**
     * Remueve el texto contenido en <b>item_id</b> con el texto <b>text</b>
     * @param item_id
     * @param text
     */
    function removeText(item_id, text) {
        var appropriateEditor = $("#" + item_id).data("wysihtml5").editor;
        var value = appropriateEditor.getValue();

        text = formatHtmlText(text);

        value = value.replace(text, '');
        appropriateEditor.setValue(value, true);
    }

    /**
     * Da formato al texto como si fuese HTML.
     * Reemplaza el tag [nl] que fue agregado como medida para
     * que javascript no truene al encontrar nuevas líneas en el texto
     *
     * @param text
     * @returns {string|*}
     */
    function formatHtmlText(text) {
        text = text.replace(/\"/gi, "\'");
        text = text.replace(/\[nl\]/gi, "<br>");
        text = text + "<br>";
        return text;
    }
</script>

<tr <?php //echo $display_form ?>>
    <td colspan="5">
        <h4>Añadir Firmas de Detección</h4>
    </td>
</tr>
<tr <?php //echo $display_form ?>>
    <td style="width: 10%;"><br>
        <a style="width:100%" href="#modal-dialog-signatures" class="btn btn-sm btn-success"
           data-toggle="modal"><i class="fa fa-check"></i> Seleccionar firma</a> <br><br>
    </td>
    <td colspan="4">
    </td>
</tr>
<tr <?php //echo $display_form ?>>

    <td colspan="5">

        <table class="table table-bordered table-striped table-hover">
            <tbody id="signatures">

            <?php if (isset($update)): ?>
            <?php $i = 0; ?>
            <?php foreach ($incident_signatures as $is): ?>
            <?php $i++; ?>
            <tr onclick="removeSignature(this,'<?php echo $is->signature->id ?>')"
                style="cursor:pointer">
                <td>
                    <?php echo $is->signature->id ?>
                    <input style="display:none" value="<?php echo $is->signature->id ?>"
                           class="form-control" type="text" name="signature_id_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $is->signature->signature ?>
                    <input style="display:none" value="<?php echo $is->signature->signature ?>"
                           class="form-control" type="text" name="signature_<?php echo $i ?>">
                </td>
            </tr>
            <script>
                if (validateSignature(<?php echo $is->signature->id ?>) == "0") {
                    signatures_added.push(<?php echo $is->signature->id ?>);

                }
                count_signatures =<?php echo $i ?>;
            </script>
            <?php endforeach ?>

            <?php endif ?>
            </tbody>
        </table>
    </td>
</tr>