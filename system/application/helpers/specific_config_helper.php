<?php
function specific_config($items, $object){
    switch($items->kind){
        case "text":{
            echo '<tr>'.'<input name="specific_id[]" type="hidden" value="'.$items->id.'" />';
            echo '<td width="150px"><label for="name">'.$items->name_vietnamese.'</label></td>';
            echo '<td width="500px">'.
                '<input name="OptionName'.$items->id.'" class="smallInput big" type="text" value="'.$items->product_productspecification->where(array('productspecification_id'=>$items->id, 'product_id'=>$object->id))->get()->chooseValue.'" /></td>';
            echo '</tr>';
            break;
        }
        case "textarea":{
            echo '<tr>';
            echo '<input name="specific_id[]" type="hidden" value="'.$items->id.'" />';
            echo '<td width="150px"><label for="name">'.$items->name_vietnamese.'</label></td>';
            echo '<td width="500px"><textarea name="OptionName'.$items->id.'" rows="3" cols="30" class="smallInput medium">'.$row_sub->product_productspecification->where(array('productspecification_id'=>$row_sub->id, 'product_id'=>$object->id))->get()->chooseValue.'</textarea></td>';
            echo '</tr>';
            break;
        }
        case "radio":{
            echo '<tr>';
            echo '<input name="specific_id[]" type="hidden" value="'.$items->id.'" />';
            echo '<td width="150px"><label for="name">'.$items->name_vietnamese.'</label></td>';
            echo '<td width="500px">';
                    $check = $items->product_productspecification->where(array('productspecification_id'=>$items->id, 'product_id'=>$object->id))->get()->chooseValue;
                    $specific = $items->productspecificationvalue->where('productspecification_id', $items->id);
                    foreach($specific as $specificvalues){
                        echo '<label><input ';
                        if($check==$specificvalues->value) echo 'checked="checked"';
                        echo ' value="'.$specificvalues->value.'" name="OptionName'.$items->id.'" type="radio" />'.$specificvalues->name.'</label>';
                    }
            echo '</td></tr>';
            break;
        }
        case "checkbox":{
            echo '<tr>';
            echo '<input name="specific_id[]" type="hidden" value="'.$items->id.'" />';
            echo '<td width="150px"><label for="name">'.$items->name_vietnamese.'</label></td>';
            echo '<td width="500px">';
                $check = $items->product_productspecification->where(array('productspecification_id'=>$items->id, 'product_id'=>$object->id))->get()->chooseValue;
                $mang = explode("-", $check);
                $specific = $items->productspecificationvalue->where('productspecification_id', $items->id);
                foreach($specific as $specificvalues){
                    echo '<label><input ';
                     foreach($mang as $mang_sub){
                        if($mang_sub==$specificvalues->value) echo 'checked="checked"';
                     };
                     echo ' value="'.$specificvalues->value.'" name="OptionName'.$items->id.'[]" type="checkbox" />'.$specificvalues->name.'</label>';
                }
            echo '</td></tr>';
            break;
        }
        case "select":{
            echo '<tr>';
            echo '<input name="specific_id[]" type="hidden" value="'.$items->id.'" />';
            echo '<td width="150px"><label for="name">'.$items->name_vietnamese.'</label></td>';
            echo '<td width="500px">
                    <select name="OptionName'.$items->id.'" class="smallInput medium">';
                        $select = $items->product_productspecification->where(array('productspecification_id'=>$items->id, 'product_id'=>$object->id))->get()->chooseValue;
                        $specific = $items->productspecificationvalue->where('productspecification_id', $items->id);
                        foreach($specific as $specificvalues){
                            echo '<option ';
                            if($select==$specificvalues->value) echo 'selected="selected"';
                            echo 'value="'.$specificvalues->value.'">'.$specificvalues->name.'</option>';
                        }
                    echo '</select></td></tr>';
            break;   
        }
    }
}
?>