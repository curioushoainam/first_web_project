<?php 
// $productDetail = array(
//    array(
//             'group'=>'Màn hình',
//             'cnmh'=>'Công nghệ màn hình:',
//             'dpgmh'=>'Độ phân giải:',
//             'ktmh'=>'Kích thước màn hình:',
//             'mkcu'=>'Mặt kính cảm ứng:'
//         ),
//     array(
//             'group'=>'Hệ điều hành-CPU',
//             'hdh'=>'Hệ điều hành:',
//             'cscpu'=>'Chipset (hãng SX CPU):',
//             'tdcpu'=>'Tốc độ CPU:',
//             'cdhgpu'=>'Chip đồ họa (GPU):'
//         ),
//     array(
//             'group'=>'Bộ nhớ',
//             'ram'=>'RAM:',
//             'bnt'=>'Bộ nhớ trong:',
//             'tnn'=>'Thẻ nhớ ngoài:'
//         ),
//     array(
//             'group'=>'Kết nối',
//             'mdd'=>'Mạng di động:',
//             'sim'=>'SIM:',
//             'wifi'=>'Wifi:',
//             'gps'=>'GPS:',
//             'blt'=>'Bluetooth:',
//             'ckn'=>'Cổng kết nối/sạc:',
//             'jtn'=>'Jack tai nghe:',
//             'knk'=>'Kết nối khác:'
//         ),
//     array(
//             'group'=>'Camera sau',
//             'dpgcs'=>'Độ phân giải:',
//             'qp'=>'Quay phim:',
//             'df'=>'Đèn Flash:',
//             'canc'=>'Chụp ảnh nâng cao:'
//         ),
//     array(
//             'group'=>'Camera trước',
//             'dpgct'=>'Độ phân giải:',
//             'vdc'=>'Videocall:',
//             'ttk'=>'Thông tin khác:'
//         ),
//     array(
//             'group'=>'Thiết kế',
//             'tk'=>'Thiết kế:',
//             'cl'=>'Chất liệu:',
//             'kt'=>'Kích thước:',
//             'tl'=>'Trọng lượng:'
//         ),
//     array(
//             'group'=>'Pin & Sạc',
//             'dlp'=>'Dung lượng pin:',
//             'lp'=>'Loại pin:'
//         ),
//     array(
//             'group'=>'Tiện ích',
//             'bmnc'=>'Bảo mật nâng cao:',
//             'tndb'=>'Tính năng đặc biệt:',
//             'ga'=>'Ghi âm:',
//             'radio'=>'Radio:'
//         )
// );
//viewArr($productDetail );
// $count = count($productDetail);
// $mid = floor($count/2);
// echo $input["noi_dung_chi_tiet"];
// exit();
$detail = explode('>>>|',$input["noi_dung_chi_tiet"]);
// echo'$input["noi_dung_chi_tiet"] => ';
// viewArr($detail);exit();
$nd = array();
$i = 0;
foreach($detail as $item){
    if(isset($item) && $item){
        $groups = explode('|||', rtrim($item,'|||'));
        $j = 0;
        foreach($groups as $gr){
            $nd[$i][$j] = explode('||', $gr); 
            $j += 1;
        }
         $i += 1;
        
    }        
}
// echo'nd => ';
// viewArr($nd); exit();
$count = count($nd);
$mid = floor($count/2);
?>



<div>
    <div class="col-md-6">
        <?php 
        for ($n=0; $n<$mid; $n++){
            $item = $nd[$n];
            $no = count( $item);
        ?>
        <div>
            <h5><b><?= $item[0][1] ?></b></h5>
            <table class="table">
                <tbody>
                <?php 
                for ($i=1;$i<$no;$i++ ){                    
                ?>
                <tr>
                    <td class="leftCol success col-sm-3" style="font-size: 14px"><?= $item[$i][1] ?></td>
                    <td class="rightCol"><input type="text" name="<?= $item[$i][0] ?>" style="width: 100%; " value="<?= $item[$i][2] ?>"></td>
                </tr> 
                <?php 
                   
                }  
                ?>              
                </tbody>
            </table>            
        </div>
        <?php 
        }       
         ?>  
    </div>

    <div class="col-md-6">
        <?php 
        for ($n=$mid; $n<$count; $n++){
            $item = $nd[$n];
            $no = count( $item);
        ?>
        <div>
            <h5><b><?= $item[0][1] ?></b></h5>
            <table class="table">
                <tbody>
                <?php 
                for ($i=1;$i<$no;$i++ ){                    
                ?>
                <tr>
                    <td class="leftCol success col-sm-3" style="font-size: 14px"><?= $item[$i][1] ?></td>
                    <td class="rightCol"><input type="text" name="<?= $item[$i][0] ?>" style="width: 100%; " value="<?= $item[$i][2] ?>"></td>
                </tr> 
                <?php 
                   
                }  
                ?>              
                </tbody>
            </table>            
        </div>
        <?php 
        }       
         ?>
    </div>
</div>

