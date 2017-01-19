<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">活动选项</h3>
  </div>
  <div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="" id="form">
			<input type="hidden" name="id" value="<?php  echo $data['id'];?>">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">选项标题：</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control check" name="title" value="<?php  echo $data['title'];?>" placeholder="请输入选项标题" >
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">选项图片：</label>
		    <div class="col-sm-10" >
		      <?php  echo  tpl_form_field_image('thumb',$data['thumb']);?>
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">选项编号：</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control check" name="orderby" value="<?php  echo $data['orderby'];?>" placeholder="请输入选项编号,不输入则自动编号">
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

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">活动选项</h3>
  </div>
  <div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>编号</th>
					<th>选项标题</th>
					<th>选项图片</th>
					<th>票数</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($data)) { foreach($data as $key => $val) { ?>
				<tr>
					<td><input type="text" class="form-control orderby" data-id='<?php  echo $val['id'];?>' value="<?php  echo $val['orderby'];?>" style="width: 50px;"></td>
					<td><?php  echo $val['title'];?></td>
					<td><img src="<?php  echo tomedia($val['thumb'])?>" width="50" height="50"></td>
					<td><input type="text" class="form-control vote" data-id='<?php  echo $val['id'];?>' value="<?php  echo $val['vote'];?>" style="width: 50px;"></td>
					<td>
						<button type="button" class="btn btn-primary edit" data-id="<?php  echo $val['id'];?>">修改</button>
						<button type="button" class="btn btn-danger delete" data-id="<?php  echo $val['id'];?>">删除</button>
					</td>
				</tr>
			<?php  } } ?>
			</tbody>
		</table>
  </div>
</div>
<script type="text/javascript">
	$(function(){

		$(".edit").click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				url: '<?php  echo $this->createWebUrl('medit')?>',
				type: 'POST',
				dataType: 'json',
				data: {id:id},
				success:function(data){
					if(data.status){
						$("input[name='id']").val(data.info.id);
						$("input[name='title']").val(data.info.title);
						$("input[name='thumb']").val(data.info.thumb);
						$(".img-responsive").attr('src','/attachment/'+data.info.thumb);
						$("input[name='orderby']").val(data.info.orderby);
						$("input[name='title']").focus();
					}else{
						alert(data.info);
					}
				}
			});
		});
		$(".orderby").change(function(){
			var orderby = $.trim($(this).val());
			var id = $(this).attr('data-id');
			if(orderby.length==0){
				$(this).focus();
				return false;
			}
			$.ajax({
				url: '<?php  echo $this->createWebUrl('mlist')?>',
				type: 'POST',
				dataType: 'json',
				data: {val: orderby,id:id,sign:'orderby'},
				success:function(data){
					alert(data.info);
				}
			});
		});
		$(".vote").change(function(){
			var vote = $.trim($(this).val());
			var id = $(this).attr('data-id');
			if(vote.length==0){
				$(this).focus();
				return false;
			}
			$.ajax({
				url: '<?php  echo $this->createWebUrl('mlist')?>',
				type: 'POST',
				dataType: 'json',
				data: {val: vote,id:id,sign:'vote'},
				success:function(data){
					alert(data.info);
				}
			});
		});

		$('.delete').click(function(){
			var obj = $(this);
			if(confirm('确定要进行删除操作？')){
				var id= obj.attr('data-id');
				$.ajax({
					url: '<?php  echo $this->createWebUrl('mlist')?>',
					type: 'POST',
					dataType: 'json',
					data: {id:id,sign:'delete'},
					success:function(data){
						if(data.status){
							obj.parents('tr').remove();
						}else{
							alert(data.info);
						}
						
					}
				});
			}
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>