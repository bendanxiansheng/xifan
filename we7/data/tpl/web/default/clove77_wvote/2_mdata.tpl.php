<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">数据管理</h3>
  </div>
  <div class="panel-body">
		<button type="button" class="btn btn-primary output">数据导出</button>
		<button type="button" class="btn btn-danger cleardata">清理数据</button>
  </div>
</div>



<script type="text/javascript">
	$(function(){
		$(".output").click(function(){
			window.location.href="<?php  echo $this->createWebUrl('output')?>";
		});
		$(".cleardata").click(function(){
			if(confirm('确定要清理投票数据吗？')){
				$.ajax({
					url: '<?php  echo $this->createWebUrl('cleardata')?>',
					type: 'POST',
					dataType: 'json',
					success:function(data){
						console.log(data);
					}
				});
			}
			
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>