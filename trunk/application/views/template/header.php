
<header class="header fixed-top clearfix">
   
    <!--logo start-->
    <div class="brand">
        <a href="<?=base_url()?>" class="logo">
            <img src="<?=base_url("static")?>/images/logo.png" alt="">
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->
     <div class="nav notify-row hide" id="top_menu">
    	<ul class="nav top-menu">
    		<li>
            	<img src="<?=base_url()?>static/images/logo.png" id="title-img" height="80" style="margin-top:-23px;"/>
            </li>
        </ul>
	</div>
    <div class="top-nav clearfix">
    
        <ul class="nav pull-right top-menu">
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="<?=base_url("static")?>/images/user_.png">
                    <span class="username"><?=$this->session->userdata('full_name')?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#" class="hide"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#" class="hide"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="<?=base_url().'welcome/logout_user'?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    <li><a href="#passModal" data-toggle="modal"  onclick="changePass()"><i class="fa fa-key"></i> Ubah Password...</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
            <li class="hide">
                <div class="toggle-right-box">
                    <div class="fa fa-bars"></div>
                </div>
            </li>
        </ul>
        
    </div>
</header>


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="passModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="frmpassword" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" ><i class="fa fa-plus-square"></i>  Ubah Password</h5>
                </div>
                <div class="modal-body" >
					<input type="hidden" name="user_id" id="user_id" values="<?=$this->session->userdata('user_id')?>"/>
				 
					<div class="form-group">
						<label class="col-sm-5 control-label">Password Lama <span class="text-danger">*</span></label>
						<div class="col-sm-7">
						     <input type="password"  class="form-control input-sm"   id="pass_lama" name="pass_lama" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">Password Baru<span class="text-danger">*</span></label>
						<div class="col-sm-7">
						     <input type="password"  class="form-control input-sm"    id="pass_baru" name="pass_baru" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
						<div class="col-sm-7">
						     <input type="password"  class="form-control input-sm"    id="pass_baru_confirm" name="pass_baru_confirm" value="">
						</div>
					</div>
                </div>
                <div class="modal-footer">
                	<div class="pull-right">
                		<button type="button" id="btn-pass-close" class="btn btn-danger" data-dismiss="modal" class="close">Batalkan</button>
                    	<button type="submit" id="btn-pass-save" class="btn btn-info">Simpan</button>
                	</div>
                </div>
            </div>
        </form>
        </div>
    </div>
	
	<script>
		
		changePass =function(){
			
			$("#frmpassword").attr("action",'<?=base_url()?>security/user/changePasswd');
		 
		}
		
		$("#frmpassword").submit(function(event){
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
						$.gritter.add({text: data});
						$('#btn-pass-close').click();   
						 
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
						$('#btn-pass-close').click();   
					}
				});
			
			  event.preventDefault();
	});
	</script>
