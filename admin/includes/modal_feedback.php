<div id="modal_feedback" class="modal fade" role="dialog">
    <div class="modal-dialog">

         <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kết quả</h4>
            </div>

            <div class="modal-body" id="" >    
                    <p><?= $_SESSION['feedback'] ?></p>                           
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){  
        // $('#modal_feedback').on('hidden.bs.modal', function () {
        //     window.location.reload(true);
        // })
    });
</script>