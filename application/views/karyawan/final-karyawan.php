<?php
 	require_once(APPPATH.'views/include/header.php');
?>
<div class="col-md-12">
  <div class="card">
    <div class="card card-plain">
      <div class="content table-responsive table-full-width">
        <div class="header">
          <h4 class="title">Halaman Peringkat</h4>
          <p class="category">Silahkan Klik tombol lihat ranking atau unduh nilai ranking </p>
        </div>
        <div class="content">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                  <?php
                  $this->db->from('jabatan');
                  $query=$this->db->get();
                  $jab=$query->result();
                  ?>  
              </div>
            </div>
            
        </div>
        <label>Pilihan Menu</label><br/>
              <span class="text-danger" id="warn"></span><br/> 
              <button class="btn btn-fill btn-warning btnsend" type="button" id="btnsend" name="button">&nbsp&nbsp Lihat Rangking</button>
                <a class="btn btn-info btn-fill" onclick="location.href='<?php echo base_url();?>HR/export'"  name="button"><i class=""></i>&nbsp&nbsp Unduh Nilai Ranking</a>
            
        </div>
     
          <script type="text/javascript">
          $(document).ready(function(){
            $('.btnsend').click(function(event){
              event.preventDefault();
                $('#warn').html('');
                $('#clk').load("<?php echo site_url('HR/rkjAll/'); ?>");
            });
          });
          </script>
      </div>
    </div>
  </div>
    <div id="clk" class="card">
</div>
<script type="text/javascript">
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
<!-- print excel -->
<script type="text/javascript">
function exportTableToExcel(tableID, filename = ''){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';

  // Create download link element
  downloadLink = document.createElement("a");

  document.body.appendChild(downloadLink);

  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

      // Setting the file name
      downloadLink.download = filename;

      //triggering the function
      downloadLink.click();
  }
}
</script>
<?php require_once(APPPATH.'views/include/footer.php'); ?>
