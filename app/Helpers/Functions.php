<?php
function isSelected($fieldName, $current, $id){
    if (old($fieldName)){
        if (old($fieldName)==$id){
            return 'selected';
        }
    }else{
        if ($current && $current->$fieldName==$id){
            return 'selected';
        }
    }
}

function getValueInput($fieldName, $current){
    if (old($fieldName)){
        return old($fieldName);
    }else{
        if ($current && $current->$fieldName){
            return $current->$fieldName;
        }
    }

    return '';
}
