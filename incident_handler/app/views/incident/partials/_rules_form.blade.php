<script>
    var sid_added = new Array();
    var count_rule = 0;

    function validateSid(sid) {
        for (var i = 0; i < sid_added.length; i++) {
            if (sid_added[i] == sid) {
                return "1";
            }
        }
        return "0";
    }

    function addRuleOnClick() {
        //sid,rule,message,translate,rule_is,why
        var sid = $("#search_sid").val();
        var rule = $("#search_rule").val();
        var message = $("#search_message").val();
        var translate = $("#search_translate").val();
        var rule_is = $("#search_rule_is").val();
        var why = $("#search_why").val();

        if (!sid || !message) {
            $('#modal-dialog3').modal('show');
        } else {
            addRule(sid, rule, message, translate, rule_is, why);
        }
    }

    $(document).ready(function () {
        $("#search_sid").keyup(function (e) {

            if (e.which == 13 && validateSid($("#search_sid").val())) {

            } else {
                $.ajax({
                    type: "GET",
                    url: "/rule/query/" + $("#search_sid").val(),
                    async: true,
                    cache: false,
                    success: function (ret) {
                        if (ret != "") {
                            response = ret.split("\`");
                            if (validateSid(response[0]) == "0") {
                                addRule(response[0], response[1], response[2], response[3], response[4], response[5]);

                            }

                        }
                    },
                    error: function (x, e) {
                        console.log("error occur");
                    }
                });
            }
        })
    });

    function addRule(sid, rule, message, translate, rule_is, why) {
        validate = [sid, rule, message, translate, rule_is, why];
        if (validateEntry(validate) == "1") {
            return 0;
        }
        count_rule = count_rule + 1;
        //'sid','rule','message','translate','rule_is','why'
        var str = '<tr onclick="removeRule(this,\'' + sid + '\')" style="cursor:pointer">'
                + '<td>'
                + sid
                + '<input style="display:none" value="' + sid + '" onkeyup="queryRule(this.value)" class="form-control" placeholder="sid" type="text" name="sid_' + count_rule + '" >'
                + '</td>'
                + '<td>'
                + rule
                + '<input style="display:none" value="' + rule + '"  class="form-control" placeholder="regla" type="text" name="rule_' + count_rule + '" >'
                + '</td>'
                + '<td>'
                + message
                + '<input style="display:none" value="' + message + '"  class="form-control" placeholder="mensaje" type="text" name="message_' + count_rule + '" >'
                + '</td>'
                + '<td>'
                + translate
                + '<input style="display:none" value="' + translate + '"  class="form-control" placeholder="traducción" type="text" name="translate_' + count_rule + '">'
                + '</td>'
                + '<td>'
                + rule_is
                + '<input style="display:none" value="' + rule_is + '"  class="form-control" placeholder="qué es" type="text" name="ruleis_' + count_rule + '" >'
                + '</td>'
                + '<td>'
                + why
                + '<input style="display:none" value="' + why + '"  class="form-control" placeholder="por qué ocurre" type="text" name="why_' + count_rule + '" >'
                + '</td>'

                + '</tr>';

        if (validateSid(sid) == "0") {
            sid_added.push(sid);
            $("#rules").append(str);
        }
    }

    function removeRule(tr, sid) {
        $(tr).remove();
        var index = sid_added.indexOf(sid);
        sid_added.splice(index, 1);
    }
</script>
<tr <?php //echo $display_form ?>>
    <td colspan="5">
        <h4>Añadir Reglas de Detección</h4>
    </td>
</tr>

<tr <?php //echo $display_form ?>>
    <td style="width:10%"><br>
        <a style="width:100%" href="#modal-dialog" class="btn btn-sm btn-success"
           data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a> <br><br>
        <a style="width:100%" class="btn btn-sm btn-success"
           onclick="addRuleOnClick()"><i class="fa fa-plus"></i> Añadir</a>

    </td>
    <td colspan="4">
        <table class="table">
            <tbody>
            <tr>
                <td>
                    <input id="search_message" class="form-control" placeholder="indicador"
                           type="text">
                </td>
                <td>
                    <input id="search_sid" class="form-control" placeholder="sid"
                           type="text">
                </td>
                <td>
                    <input id="search_rule" class="form-control" placeholder="regla"
                           type="text">
                </td>
                <td>
                    <input id="search_translate" class="form-control"
                           placeholder="traducción" type="text">
                </td>
                <td>
                    <input id="search_rule_is" class="form-control" placeholder="qué es"
                           type="text">
                </td>
                <td>
                    <input id="search_why" class="form-control" placeholder="por qué ocurre"
                           type="text">
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr <?php //echo $display_form ?>>

    <td colspan="5">

        <table class="table table-bordered table-striped table-hover">
            <tbody id="rules">

            <?php if (isset($update)): ?>
            <?php $i = 0; ?>
            <?php foreach ($incident_rule as $ir): ?>
            <?php $i++; ?>
            <tr onclick="removeRule(this,'<?php echo $ir->rule->sid ?>')"
                style="cursor:pointer">
                <td>
                    <?php echo $ir->rule->sid ?>
                    <input style="display:none" value="<?php echo $ir->rule->sid ?>"
                           class="form-control" type="text" name="sid_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $ir->rule->rule ?>
                    <input style="display:none" value="<?php echo $ir->rule->rule ?>"
                           class="form-control" type="text" name="rule_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $ir->rule->message ?>
                    <input style="display:none" value="<?php echo $ir->rule->message ?>"
                           class="form-control" type="text" name="message_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $ir->rule->translate ?>
                    <input style="display:none" value="<?php echo $ir->rule->translate ?>"
                           class="form-control" type="text"
                           name="translate_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $ir->rule->rule_is ?>
                    <input style="display:none" value="<?php echo $ir->rule->rule_is ?>"
                           class="form-control" type="text" name="ruleis_<?php echo $i ?>">
                </td>
                <td>
                    <?php echo $ir->rule->why ?>
                    <input style="display:none" value="<?php echo $ir->rule->why ?>"
                           class="form-control" type="text" name="why_<?php echo $i ?>">
                </td>
            </tr>
            <script>
                if (validateSid(<?php echo $ir->rule->sid ?>) == "0") {
                    sid_added.push(<?php echo $ir->rule->sid ?>);

                }
                count_rule =<?php echo $i ?>;
            </script>
            <?php endforeach ?>

            <?php endif ?>
            </tbody>
        </table>
    </td>
</tr>
