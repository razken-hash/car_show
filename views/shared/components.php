<?php

class Components {
    public static function generateSelectField ($fieldLabel, $fieldName, $items, $selectedItem) {
        echo "
        <div class='field input col-start'>
            <label for='".$fieldName."'>".$fieldLabel."</label>
            <select
                name='".$fieldName."'>
                <option value=''></option>;
                ";
                                    
        foreach ($items as $item) {
            $selected = $item == $selectedItem ? 'selected' : '';
            echo "<option value='".$item."' ".$selected." >" . $item . "</option>";
        }

        echo "
            </select>
        </div>
        ";
    }
}

?>