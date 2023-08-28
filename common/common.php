<?php

function sanitize($before) {
    foreach($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES,"UTF-8");
    }
    return $after;
}

function pulldown_cate() {
    print "<select name='cate'>";
    print "<option value='道着'>道着</option>";
    print "<option value='武具'>武具</option>";
    print "<option value='書籍'>書籍</option>";
    print "<option value='日用品'>日用品</option>";
    print "<option value='その他'>その他</option>";
    print "</select>";
}
?>

