
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/index.min.js" integrity="sha512-ve8zzIbgiFFiUFW32RRJD+NBFRoVrGlhYfRLcTbQrqcFeazoPxhV03wWlyvDQE+/8GgZSMp+HqJlVBloc9D2vA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/src/camera.min.js" integrity="sha512-62PikEVTNQL5GTUTGJQCIbqkpu6gsrjkKVLVt3nm1UcGxuiXJE63rXt5Y8QHwjCN+8vKw6SBq5f2BbZOtI/rdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/src/scanner.min.js" integrity="sha512-4wgp0QqokkXAt6fuzisXfxI2u5vjPP8Sj5lRuT+f0fpmF0OcdkiKxr2byGgtJdUOi/jONy5BuRIJAORe0KmEaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/src/zxing.min.js" integrity="sha512-HTMvDnKIzrfcofgQyEdYQHLSuXwbExp6G17PzyaiuzDKmW5n+3DsTs2JHwLIpHtyq4iFk0le/EPQqUyfcpK4Hg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.7.0-beta.8/vue.min.js" integrity="sha512-DaxftX6XYPBTVx2PHW6tZGkI69bVaaAOmZz/Njipi/QrAu7fsEDi2Z4ZpiV3sLAroSwWrmsfjh2ml1BxjcEnJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.1.1/adapter.min.js" integrity="sha512-e2A/V1CfhzYEO4L2W0ADX27EWh3i1OOOZlOTMaJLvTGna9CZsopO1WcnDVsLnTSwkG+fsSSjvgdJfrM4em10Ew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Scan QR Code </h3>

          </div>

          <div class="d-inline-block float-right">


          </div>

        </div>

        <div class="card-body">   

           <div class="row">
               <div class="col-md-6">
                   <video id="preview" width=100% ></video>
               </div>
                 
    
               <div class="col-md-6">
                   <label>
                       QR Code Text
                   </label>
                   <input type="text" readyonly name="text" id="text" class="form-control" />
                   <?php echo form_open(base_url('admin/customerOrder'), ['method' => 'get'], 'class="form-horizontal"');  ?> 
                        <input type="hidden" name="c_id" id="cid" >
                   <input type="submit" Class="btn btn-success" >
               </div>
                <?php echo form_close( ); ?>
           </div>

        </div>

    </section> 
    <script type="text/javascript">
					var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
					scanner.addListener('scan',function(content){
					    document.getElementById('text').value=content;
					    const myArray = content.split("-");
                        document.getElementById("cid").value = myArray[0]; 
					//	alert(content);
						//window.location.href=content;
					});
					Instascan.Camera.getCameras().then(function (cameras){
						if(cameras.length>0){
							scanner.start(cameras[0]);
							$('[name="options"]').on('change',function(){
								if($(this).val()==1){
									if(cameras[0]!=""){
										scanner.start(cameras[0]);
									}else{
										alert('No Front camera found!');
									}
								}else if($(this).val()==2){
									if(cameras[1]!=""){
										scanner.start(cameras[1]);
									}else{
										alert('No Back camera found!');
									}
								}
							});
						}else{
							console.error('No cameras found.');
							alert('No cameras found.');
						}
					}).catch(function(e){
						console.error(e);
						alert(e);
					});
				</script>
    <!--<script>-->
    <!--    let scanner=new Instascan.Scanner((video:document.getElementById('preview')));-->
    <!--    Instascan.Camera.getCameras().then(function(cameras){-->
    <!--        if(cameras.length>0)-->
    <!--        {-->
    <!--            scanner.start(camera[0]);-->
    <!--        }-->
    <!--        else-->
    <!--        {-->
    <!--            alert('no camera found');-->
    <!--        }-->
    <!--    }).catch(function(e){-->
    <!--        console.error(e);-->
    <!--    });-->
        
    <!--    scanner.addListner('scan', function(c){-->
    <!--        document.getDocumentById('text').value=c;-->
    <!--    });-->
    <!--</script>-->

  </div>