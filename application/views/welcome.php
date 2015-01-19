	<style type="text/css">   
   .slider .slide-cnt {
    float: left;
 /* height: 220px;*/
    overflow: hidden;
   /* padding-top: 30px;*/
    position: relative;
    width: 450px;
}
.slider ul {
    list-style: outside none none;
}


.featured {
    background: none repeat scroll 0 0 #f1f1f1;
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    margin-bottom: 42px;
    padding: 10px 213px 10px 18px;
    position: relative;
}


.featured h4 strong {
    color: #ff6f20;
    font-weight: 600;
}
</style>
	<!--main content start-->
	<section id="main-content">
	<section class="wrapper">
	
			<!-- slider -->
				<div class="slider"> 
					<ul style="margin-left:-70px;margin-bottom:-20px;">
						<li id="img1">
							<div class="slide-cnt">
								<h4>Kuesinoer Analisis Kebutuhan Diklat</h4>
								<h2>E-Kuesioner</h2>
								<p align="justify">Aplikasi Kuesioner untuk analisis kebutuhan diklat pada industri bidang pertambangan yang tersedia pada pusdiklat Minerba Bandung serta menemukan kebutuhan diklat yang ada di industri Minerba diluar diklat yang telah ada dan diklat wajib. </p>
								<form id="frmlogin" class="form-signin" action="<?=base_url();?>welcome/login_usr">
									<h2 class="form-signin-heading">Log In</h2>
								 
									 <div class="login-wrap">
										<div class="user-login-info">
									 
										<input type="text" class="form-control" name="username" placeholder="User ID" autofocus>
										<input type="password" name="p4ss" class="form-control" placeholder="Password">
										<span id="loginInfo" class="help-block">
											
                                             </span> 
										<button class="btn btn-lg btn-login btn-block" type="submit"><i class="fa fa-sign-in"></i> Sign in</button>
										</div>
									</div>
							</form>
							</div>
							 
							<img style="margin:100px" src="<?php echo base_url('static'); ?>/images/mac-img.png" alt="" />
						</li>

						
					</ul>
				</div>
				<!-- end of slider -->
				 
				
	</section>
	</section>
	<!--main content end-->
	
<script type="text/javascript">
	$("#frmlogin").submit(function(event){
		 var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						//data: return data from server
						//$.gritter.add({text: data});
						if (data==="home"){
							window.location.href = '<?=base_url()?>home';
						}
						else {
							$("#loginInfo").text(data);
						}
						 
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
						$('#btnf-close').click();   
					}
				});
			
			  event.preventDefault();
	});
</script>