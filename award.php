
<?php
    include "./com/base.php";
    include "./include/header.php";

// 判別最新已開獎期數
// 排序是否可以設定兩個欄位的排序組合???如日期+期數
$last_aw=all("award_number",""," order by id desc limit 0,1");

foreach($last_aw as $d){
    $last_y=$d['year'];
    $last_p=$d['period'];
}

?>





<section class="content row fixed">

    <article class="contentLeft col-12 col-md-6">
        <div class="title">對獎專區</div>
        <h4>小確幸moment!</h4>
        <div class="search">
            <a href="award.php?year=<?=$last_y;?>&period=<?=$last_p;?>">
                <div class="awardbtn sub">
                    <p>Newest<br>Award</p>
                </div>
            </a>
            <p class="text-muted small mt-3 mb-5">最新開獎點這裡↑</p>

            <hr>
            <h4>前期對獎</h4>
            <form action="award.php" method="get">
                <div class="srchgp">
                <input type="text" name="year" size="3">
                    <select name="period">
                        <option value="1">一二月</option>
                        <option value="2">三四月</option>
                        <option value="3">五六月</option>
                    </select>
                </div>
                <div class="srchgp">
                    <input class="sub" type="submit" value="Go!">
                </div>
            </form>




        </div>
    </article>

    <article class="contentRight col-12 col-md-6">
    <div class="title">搜尋結果</div> 
        <div class="result row">

<?php

$aw=[
    1=>'特別獎',
    2=>'特獎',
    3=>'頭獎',
    4=>'二獎',
    5=>'三獎',
    6=>'四獎',
    7=>'五獎',
    8=>'六獎',
    9=>'增開獎',
];

if(!empty($_GET['year']) && !empty($_GET['period'])){

    echo "<h4 class='col-12'>".$_GET['year']."第".$_GET['period']."期</h4>";
    echo "<div class='row col-6'>";
    foreach($aw as $k=>$v){
        echo "<div class='chsbar col-12 ml-3'><a class='btn btn-outline-warning' href='check_award.php?aw=".$k."&year=".$_GET['year']."&period=".$_GET['period']."'>".$v."</a></div>";
    }
    echo "</div>";
}

if(!empty($_GET['awget'])){
    $tmp=array('id'=>$_GET['awget'],);
    $award_get=find("reward_record",$tmp);
    echo "<div class='col-6'>";
    echo "<div class='text-warning' style='font-weight:900;font-size:2rem;line-height:3rem;'>中獎囉</div>";
    echo $aw[$_GET['aw']];
    echo $award_get['code']."-";
    echo $award_get['number'];
    echo "$".$award_get['reward'];
    echo "</div>";
}else{
    echo "<div class='text-warning' style='font-weight:900;font-size:2rem;line-height:3rem;'>c8 c8 c8 沒中獎</div>";
}

?>




        </div>
    </article>

<article class="moreinfo col-12 text-right mt-5">
    <div>也許你還想去...(↑)</div>
    <a href="list.php">顯示當期發票</a><br>
    <a href="award.php">對獎GOGO</a><br>
    <a href="inputaward.php">後台輸入獎號</a>
</article>



</section>


<?php include "./include/footer.php";?>