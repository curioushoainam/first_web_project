<div id="modal_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">

         <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>

            <div class="modal-body" id="deleted_account_info" >
                               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" id="cancle-btn" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-success" id="ok-btn" >Đồng ý</button>                
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){ 
        $('.deleting_account').click(function(){
            var ma = $(this).attr("id");            
            $.ajax({
                url     : "./pages/delete_account.php",
                type    : "text",
                method  : "post",
                data    : {del_ma : ma},
                success : function(data){
                    $('#deleted_account_info').html(data);                    
                    $('#modal_delete').modal("show");
                },
                error   : function(err){

                }
            });
        });

        $('#ok-btn').click(function(){
            var ma = $('.deleting').attr("id");            
            $.ajax({
                url     : "pages/delete_account.php",
                type    : "text",
                method  : "post",
                data    : { deleted_ma : ma},
                            
                success : function(data){  
                    $('#ok-btn').hide();
                    $('#cancle-btn').hide();
                    $('#deleted_account_info').html(data);                     
                },
                error   : function(err){

                }
            });
        });

        $('#modal_delete').on('hidden.bs.modal', function () {
            window.location.reload(true);
        })



    });
</script>