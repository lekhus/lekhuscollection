

<style>
@media print {
     @page {
        size: 3in 3in;
        /*margin-left: 0.05in;*/
        /*margin-top: 0.05in;*/
     }
     .qrc
     {
         width:2.5in;
         height:2.5in;
     }
     
     .dtl
     {
         font-size:20pt;
     }
     header, footer, aside, nav, form, iframe, .menu, .hero, .adslot {
  display: none;
}
}
</style>
<center>
<div id="outprint">
<img class="qrc" src="<?php $stri=$item['qradd']; echo "http://".$_SERVER['HTTP_HOST'].substr($stri,2); ?>"/>
<p class="dtl" style="padding-left:20px;"><?php echo $item['code']; ?></p>
    </div>
    <button class="btn btn-success printMe"> Print QR Code</button>
    </center>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.printMe').click(function(){
     $("#outprint").print();
});
</script>

