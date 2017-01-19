<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	.delete{padding:3px 10px;background: #D9534F;color:#FFF;cursor: pointer;}
</style>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">活动设置</h3>
  </div>
  <div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="" id="form">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动标题：</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control check" name="title" value="<?php  echo $data['title'];?>" placeholder="请输入活动标题" style="width:300px;">
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动图片：</label>
		    <div class="col-sm-10" style="width:300px;">
		      <?php  echo  tpl_form_field_image('thumb',$data['thumb']);?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label">关注引导页：</label>
		    <div class="col-sm-10">
		      <input type="text" name="url" value="<?php  echo $data['url'];?>" class="form-control check" placeholder="请输入关注引导页" style="width:300px;">
		    </div>
		  </div>
		  

		  
		  <?php 
				if($data['status']==1){
					$status = 'checked';
				}
		  ?>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动状态：</label>
		    <div class="col-sm-10">
				<label class="radio-inline">
				  <input type="radio" name="status"  value="0" <?php  if($data['status']==0) { ?>checked<?php  } ?>> 关闭
				</label>
				<label class="radio-inline">
				  <input type="radio" name="status"  value="1" <?php  if($data['status']==1) { ?>checked<?php  } ?>> 正常
				</label>
		    </div>
		  </div>
		  		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动类型：</label>
		    <div class="col-sm-10">
				<label class="radio-inline">
				  <input type="radio" name="type"  value="0" <?php  if($data['type']==0) { ?>checked<?php  } ?>> 仅一次
				</label>
				<label class="radio-inline">
				  <input type="radio" name="type"  value="1" <?php  if($data['type']==1) { ?>checked<?php  } ?>> 每天都可以
				</label>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label">每天参与次数：</label>
		    <div class="col-sm-10">
			<div class="input-group" style="width:200px;">
			  <input type="text" name="maxnum" value="<?php  echo $data['maxnum'];?>" class="form-control check" placeholder="请输入每天参与次数">
			  <span class="input-group-addon">次</span>
			</div>
		      
		    </div>
		  </div>



			
			
		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动时间：</label>
		    <div class="col-sm-10">

		     <?php  echo tpl_form_field_daterange('activityTime',array('start'=>$data['starttime'],'end'=>$data['endtime']));?>
		    </div>
		  </div>


		  <div class="form-group">
		    <label class="col-sm-2 control-label">活动介绍：</label>
		    <div class="col-sm-10">
		      <input  type="text" id="desc" value="<?php  echo $data['desc'];?>" name="desc" />
		    </div>
		  </div>




		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="submit" value="保存" name="submit" class="btn btn-primary">
		      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		    </div>
		  </div>
		</form>
  </div>
</div>

				              
				                
					                
				                
				                
				                
				                
				                
				              

<script>
require(['jquery','util'], function($, util){
	$(function(){
		var editor = util.editor($('#desc')[0]);
 	});
});
</script>
<script>
	$(function(){
		$("#form").submit(function(){
			var check = $(".check");
			var err = 0;
			check.each(function(){
				var obj = $(this);
				var val = $.trim(obj.val());
				if(val.length==0){
					obj.focus();
					err++;
					return false;
				}
			});

			if(err>0) return false;
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>