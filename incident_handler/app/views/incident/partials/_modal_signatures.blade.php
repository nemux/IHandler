<div class="modal fade" id="modal-dialog-signatures">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" width="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Firmas del incidente</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover  ">
                        <thead>
                        <tr>
                            <th>SID</th>
                            <th>Firma</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 0; foreach ($signatures as $s): ?>

                        <tr style="cursor: pointer"
                            onclick="<?php
                            echo "addSignature($i);";
                            ?>">

                            <td>
                                <?php echo $s->id; ?>
                            </td>
                            <td>
                                <?php echo $s->signature; ?>
                            </td>
                        </tr>
                        <?php $i++; endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>

            </div>
        </div>
    </div>
</div>