<!DOCTYPE html>
<!-- saved from url=(0060)https://blank-dogovor-kupli-prodazhi.ru/zapolnit-online.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="Content-language" content="ru">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all">
    <meta name="author" lang="ru" content="Счет на оплату">
    <meta name="copyright" lang="ru" content="Счет на оплату">
    <!-- verification -->
    <meta content="Счет на оплату" name="keywords">
    <meta content="Счет на оплату" name="description">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" src="./payment_files/context.js.Без названия" async=""></script>
    <script type="text/javascript" src="./payment_files/context.js.Без названия" async=""></script>
    <script async="" src="./payment_files/analytics.js.Без названия"></script>
    <script type="text/javascript" async="" src="./payment_files/watch.js.Без названия"></script>
    

    <script type="text/javascript"> 
         (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33710244 = new Ya.Metrika({ id:33710244, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");
    </script>

    <!-- <noscript><div><img src="https://mc.yandex.ru/watch/33710244" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
    <!-- /Yandex.Metrika counter -->
    <!-- google anal-->
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-70922540-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script type="text/javascript">
      function clearPlaceholders() {
        const inputs = document.getElementsByTagName("input");
        Array.from(inputs).map(function(elem) {
          elem.setAttribute('placeholder', '');
        });
      }
    </script> <!-- ! это нид -->
    <script type="text/javascript">
      window.onload = function() {
        const inputs = document.getElementsByTagName("input");
        Array.from(inputs).map(function(inpt) {
          if (window.localStorage[inpt.name]) {
            inpt.value = window.localStorage[inpt.name]
          }
          inpt.onblur = function() {
            window.localStorage.setItem(inpt.name, inpt.value);
          };
        });
      };
    </script> <!-- ! это нид -->
    <!-- /google anal-->
    <title>Ведомость заказа</title>
<!-- CSS -->


<link href="/template/css/statement_style.css" rel="stylesheet" type="text/css" media="screen" /> 
<style type="text/css" media="print">
button {display: none; }
.inline {
  display: flex;
  justify-content: space-between;
}

</style>
<!-- js  -->
    <script src="./payment_files/jspdf.min.js.Без названия"></script>
    <script type="text/javascript" src="./payment_files/html2canvas.min.js.Без названия"></script>
    <script type="text/javascript" src="./payment_files/zapolnit-online.js.Без названия"></script>
    <link rel="preload" href="./payment_files/context_static.js.Без названия" as="script">
    <script id="https://an.yandex.ru/partner-code-bundles/8824/context_static.js" src="./payment_files/context_static.js.Без названия"></script>
    <script type="text/javascript" charset="utf-8" async="" src="./payment_files/f9b76bc25d834c1081fb.js.Без названия"></script>
<!-- js END -->

</head>
  


<body style="padding-left: 2%;" >
    <div id="pdf" class="printConteiner">
       
<h1>Ведомость заказа № <?php echo $order['ID_order']; ?> от 

<?php 
  $arr = ['января', 'февраля', 'марта', 'апреля', 'мая',  'июня', 'июля','августа', 'сентября','октября','ноября','декабря'];
  $date = new DateTime($order['date_order']);
  $m = $date->format('m'); 
  $month = $m-1;              
  $format = $date->format('d '.$arr[$month].' Y'); 
  echo $format;                                     
?>
 года      
</h1>
<hr>
<div>  <!-- Реквезиты -->    
    <p><b>Исполнитель:</b>
    ООО "ТСС- Арзамас", ИНН 5243025782, КПП 525801001, 607226 Нижегородская область. г. Арзамас. ул. Ленина 110-Д, тел.: 8(83147) 2-55-99
    <br>    
    <b>Покупатель</b><?php $user = User::getUserById($order['ID_user']);?> <?php echo $user['name']; ?> 
    , <?php echo $user['address']; ?> , тел.: <?php echo $user['phone']; ?> 
    </p>
</div>
<br>
<div>

 <?php $number = 1;  ?> 
<table border="1px" style="border-collapse: collapse; width: 100%;">
<tr>
  <td style="text-align: center;">ID</td>
  <td width="80px" style="text-align: center;">Кол-во, шт</td>
  <td>Наименование товара</td>
  <td style="text-align: center;">Цена, шт.</td>
  <td style="text-align: center;">Сумма</td>
</tr>
<?php $count = 0; $total = 0; ?>
<?php foreach ($products as $product): ?>
<tr>
  <td style="text-align: center;"><?php   echo $product['ID_product']; ?></td>
  <td style="text-align: center;">
  <?php echo $productsQuantity[$product['ID_product']];
  $count = $count + $productsQuantity[$product['ID_product']]; ?>   
  </td>
  <td><?php echo $product['model']; ?></td>
  <td style="text-align: center;"><?php echo $product['price'];?> руб.</td>
  <td style="text-align: center;">
    <?php
    $summ = $product['price']*$productsQuantity[$product['ID_product']];
    echo $summ; 
    $total = $total + $summ;  
    ?> руб.
  </td>
</tr>
<?php endforeach; ?> 



<tr>
  <td colspan="2">Продукции: <?php echo $count;?> шт.</td>
  <!-- <td style="text-align: center;"></td> -->
  <td colspan="3" style="text-align: right;"> Итого за заказ: <?php echo $total;?> руб.</td>
</tr>


</table>
<br>
<div>
<b>

<?php if ($number>=20 && $number <= 22): ?> 
<div class='answer' style="page-break-after: always;"></div>
<?php endif;?><!--  -->

<table align="right">
<tr>
  <td>Итого: <td>
  <td style="text-align: right;"><?php echo $total;?> руб.<td>
</tr>
<tr>
  <td>Без налога (НДС)<td>
  <td style="text-align: right;">-<td>
</tr>
<tr>
  <td>Всего к оплате:<td>
  <td style="text-align: right;"><?php echo $total;?> руб.<td>
</tr>
</table>
</b>
</div>
</div>

<br><br><br><br>

<div class="itog_payment_text">
  <p>
    Всего наименований <?php echo $count;?>, 
  на сумму <?php echo $total.' руб. ('.Order::number2string($total).')';?>
  </p>
</div>

<hr>
<br>
<div class="inline">
 <div align="left" style="font-size: 12px;">Руководитель_________________Талаев Д.В.</div>
 <div align="right" style="font-size: 12px;">Бухгалтер_________________Шаматова И.А.</div>
</div>
</div>




<br><br>
<div class="noprint">
 <div class="noprint_buttons">
    <div>
      <button onclick="window.print();">Печать в PDF</button>
      <!-- <button onclick="downloadPDF()">Скачать PDF</button> -->
    </div>  
 </div>
</div>
</body>
</html>