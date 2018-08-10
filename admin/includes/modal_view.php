<div id="modal_view" class="modal fade" role="dialog">
    <div class="modal-dialog">

         <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông tin chi tiết</h4>
            </div>

            <div class="modal-body" id="account_info">
                <div class="row">                    
                </div>                                 
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.view_data').click(function(){
            var ma = $(this).attr("id");            
            $.ajax({
                url     : "./pages/view_account.php",
                type    : "text",
                method  : "post",
                data    : {ma : ma},
                success : function(data){
                    $('#account_info').html(data);
                    $('#modal_view').modal("show");
                },
                error   : function(err){

                }
            });
        });       
    });
</script>
