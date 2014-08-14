$(function() {
    $('input[id*=sort]').keyup(function(){
        var sort = $(this).val();//排序
        if(sort != ""){
            // 取得變更的sort id
            var sort_id = $(this).attr('id');
            var array = sort_id.split('_');
            var pic_id = array[1];//照片系統編號

            if(!isNaN(sort)){
               $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("hair_stores/change_pic_sort") ?>",
                    data: "pic_id=" + pic_id + "&sort=" + sort,
                    success: function(msg){
                        var msg_array = msg.split(',');
                        if(msg_array[0] == "y"){
                            alert(msg_array[1]);
                        }else{
                            alert(msg_array[1]);
                        }
                    }
                });
            }else{
              alert("排序僅可輸入數字！");
            }
        }
    });
});