<?php
 	require_once(APPPATH.'views/include/header.php');
?>
<div class="col-md-12">
  <div class="card">
    <div class="card card-plain">
      <div class="content table-responsive table-full-width">
        <div class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
              <label>Pilihan Menu</label><br/>
                <button class="btn btn-info btn-fill" onclick="getNilai();" name="button"><i class="pe-7s-diskette"></i>&nbsp&nbsp Analisa Karyawan</button>
                <a class="btn btn-warning btn-fill" onclick="goBack();" name="button"><i class="pe-7s-back"></i>&nbsp&nbsp Kembali</a>
            <div class="col-md-7">
              <div class="form-group">
              </div>
            </div>
          </div>
        </div>
          <script type="text/javascript">
          function getNilai() {
            $('#clk').load("<?php echo base_url().'HR/allKar'; ?>");
          }
          </script>
      </div>
    </div>
  </div>
    <div id="clk" class="card">
</div>
<script type="text/javascript">
function goBack() {
    window.history.back();
}
function getPDF(){

 var HTML_Width = $(".canvas_div_pdf").width();
 var HTML_Height = $(".canvas_div_pdf").height();
 var top_left_margin = 15;
 var PDF_Width = HTML_Width+(top_left_margin*2);
 var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
 var canvas_image_width = HTML_Width;
 var canvas_image_height = HTML_Height;

 var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


 html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
 canvas.getContext('2d');

 console.log(canvas.height+"  "+canvas.width);


 var imgData = canvas.toDataURL("image/jpeg", 1.0);
 var pdf = new jsPDF('p','pt',  [PDF_Width, PDF_Height]);
     pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


 for (var i = 1; i <= totalPDFPages; i++) {
 pdf.addPage(PDF_Width, PDF_Height);
 pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
 }

     pdf.save("analisa-manajer.pdf");
        });
 };
 function printData()
{
   var divToPrint=document.getElementById("clm");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
};
</script>
<?php require_once(APPPATH.'views/include/footer.php'); ?>
