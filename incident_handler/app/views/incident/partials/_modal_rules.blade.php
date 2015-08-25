<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content" width="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal Dialog</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover  ">
                        <thead>
                        <tr>
                            <th>SID</th>
                            <th>Regla</th>
                            <th>Mensaje</th>
                            <th>Traducción</th>
                            <th>Qué es</th>
                            <th>Por qué ocurre</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($rule as $r): ?>
                        <tr style="cursor:pointer"
                            onclick="addRule('<?php echo $r->sid ?>','<?php echo $r->rule ?>','<?php echo $r->message ?>','<?php echo $r->translate ?>','<?php echo $r->rule_is ?>','<?php echo $r->why ?>')">

                            <td>
                                <?php echo $r->sid ?>
                            </td>
                            <td>
                                <?php echo $r->rule ?>
                            </td>
                            <td>
                                <?php echo $r->message ?>
                            </td>
                            <td>
                                <?php echo $r->translate ?>
                            </td>
                            <td>
                                <?php echo $r->rule_is ?>
                            </td>
                            <td>
                                <?php echo $r->why ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

            </div>
        </div>
    </div>
</div>