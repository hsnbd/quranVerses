<?php
include "simple_html_dom.php";

( isset($_POST) && !empty($_POST))? getVers($_POST['link']) : getVers('http://www.quraanshareef.org/Surah-Al-Hadid');
?>

<br  /><br  /><br  /><br  />
<hr />
    <form class="" action="index.php" method="post">
        <?php  getSura('http://www.quraanshareef.org/'); ?>
        <input type="submit" name="save" value="Save">
    </form>
<?php

function getSura($link){
    $html = new simple_html_dom();
    $html->load_file($link);

    echo "<select  name='link'>";
    foreach($html->find('.snamecell .snameB a') as $element){
        echo "<option value='{$element->href}'>$element->outertext</option>";
    }
    echo "</select>";
}


function getVers($page) {
    $html = new simple_html_dom();
    $html->load_file($page);

    $suraNo = $html->find('.sheader');
    echo $suraNo[0]->outertext;

    $suraNo = preg_replace("/[^0-9]/","", substr($suraNo[0]->outertext, 21, 3));
    echo "<hr />";

    $element = $html->find('.ayah');
    $totalVers = count($element);
    $i = rand (0,$totalVers -1);
    $j = $i + 1;

    echo "এই সূরার মোট আয়ত সংখ্যা: ", $totalVers, " | <a href='http://tanzil.net/#trans/bn.bengali/{$suraNo}:{$j}' target='_blank'> সম্পূর্ণ সূরা</a> ";
    echo "<hr />";
    echo $element[$i]->outertext;
}

 ?>
