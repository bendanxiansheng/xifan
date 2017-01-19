<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php  echo $data['title'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<meta name="format-detection" content="telephone=no"/>
	<link rel="stylesheet" href="<?php  echo $res;?>/css/common.css?v=1.0">
	<link rel="stylesheet" href="<?php  echo $res;?>/css/style.css?v=1.0">
	<script src="<?php  echo $res;?>/js/jquery-1.8.3.min.js"></script>
	<script src="<?php  echo $res;?>/js/jquery.nicescroll.js"></script>
	<script src="<?php  echo $res;?>/js/jaliswall.js"></script>
	<script src="<?php  echo $res;?>/js/js.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.wall').jaliswall({ item: '.article' });

		});
	</script>
</head>
<body>

	<div id="header">
		<img src="<?php  echo tomedia($data['thumb']);?>" />
	</div>

	<div id="search">
		<div class="search-container">
			<input type="text" name="keyword" placeholder="请输入编号">
			<button class="search-btn">搜索</button>
		</div>
	</div>

	<div class="wrapper" style="height: auto;">
		<ul class="wall clearfix">
		<?php  if(is_array($options)) { foreach($options as $key => $val) { ?>
			<li class="article"  data-id="<?php  echo $val['id'];?>">
				<a href="javascript:void(0);" class="href" data-id="<?php  echo $val['id'];?>">
					<img src="<?php  echo tomedia($val['thumb']);?>" />

				</a>
				<div class="vote-info">
					<p class="title"><?php  echo $val['title'];?></p>
					<i class="num"><?php  echo $val['orderby'];?></i>
					<i class="vote"><?php  echo $val['vote'];?></i>
				</div>
				<button class="vote-btn select-btn <?php  if(in_array($val['id'],$select)) { ?>is-select<?php  } ?>" data-id="<?php  echo $val['id'];?>">投Ta一票</button>
			</li>
		<?php  } } ?>
		</ul>
	</div>


	<div id="footer"></div>
	<div id="menu" class="clearfix">
		<div class="vote-rule-btn">投票规则</div>
		<div class="top-list-btn">排名</div>
	</div>



	<div class="dialog-container">
		
		<div id="shareTips">
			<img src="<?php  echo $res;?>/images/share.png" alt="">
		</div>

		<!-- 信息提示 -->
		<div id="tips">
			<div class="tips-container">
				<!-- <p> -->
					<!-- <i class="tips-icon"><img src="images/load.png" alt=""></i> -->
					<i class="tips-title">正在加载</i>
				<!-- </p> -->

			</div>
		</div>

		<!-- 排名列表开始 -->
		<div id="top-list">
			<div class="top-list-container">
				<i class="top-list-close">×</i>
				<table>
					<thead>
						<tr>
							<td>排名</td>
							<td>名称</td>
							<td>票数</td>
						</tr>
					</thead>
				</table>
				<div class="top-list-table2">
					<table>
						<tbody>
							<tr>
								<td>1</td>
								<td>名称</td>
								<td>100</td>
							</tr>
							<tr>
								<td>2</td>
								<td>名称</td>
								<td>100</td>
							</tr>
							<tr>
								<td>3</td>
								<td>名称</td>
								<td>100</td>
							</tr>
							<tr>
								<td>1</td>
								<td>名称</td>
								<td>100</td>
							</tr>
						</tbody>
					</table>	
				</div>

			</div>
		</div>
		<!-- 排名列表结束 -->


		<!-- 排名列表开始 -->
		<div id="vote-rule">
			<div class="vote-rule-container">
				<i class="vote-rule-close">×</i>
				<div class="vote-rule-content">
					<h3>投票规则</h3>
					<p>投票时间：<?php  echo date('Y-m-d',$data['starttime']).' 至 '.date('Y-m-d',$data['endtime'])?></p>
					<p>活动状态：<?php  echo $status;?></p>
					<?php  if($data['type']==0) { ?>
					<p>本活动为一次性投票，每位微信用户可以投【<?php  echo $data['maxnum'];?>】票</p>
					<?php  } else { ?>
					<p>每位微信用户每天可以投【<?php  echo $data['maxnum'];?>】票</p>
					<?php  } ?>
					<?php  echo html_entity_decode($data['desc'])?>
				</div>
				
			</div>
		</div>
		<!-- 排名列表结束 -->

		<div id="pic-show">
			<div class="pic-show-container">
				<i class="pic-show-close">×</i>
				<div class="pic-show-img-box">
					<img src="<?php  echo $res;?>/images/5.jpg" />
					<p class="title"></p>
				</div>
				<div class="pic-show-info clearfix">
					<i class="num">1</i>
					<i class="vote">2008</i>
				</div>
				<div class="pic-show-btn clearfix">
					<button class="btn btn1 select-btn" data-id="0">投票</button>
					<a href="" class="hash"><button class="btn btn2">为Ta加油</button></a>
				</div>
			</div>
		</div>
	</div>
<script>
			var vote = new votePic();
			var pagehash=window.location.hash;
			var _id=pagehash.replace('#','');
			var _li=$("li[data-id="+_id+"]");
			if(_li.length>0){
				vote.show({
					src   : _li.find('img').attr('src'),
					title : _li.find('.title').text(),
					num	  : _li.find('.num').text(),
					vote  : _li.find('.vote').text(),
					id 	  : _id
				});
			}

			$(".search-btn").click(function(){
				var keyword = $.trim( $("input[name='keyword']").val() );
				if(keyword.length==0){
					tips.show('请输入要查询的编号',2000,function(){
						$("input[name='keyword']").focus();
					});
					return false;
				}
				tips.show();
				$.ajax({
					url: '<?php  echo $this->createMobileUrl('search')?>',
					type: 'POST',
					dataType: 'json',
					data: {keyword: keyword},
					success:function(data){
						tips.hide();
						if(data.status){
							vote.show({
								src   : data.info.thumb,
								title : data.info.title,
								num	  : data.info.orderby,
								vote  : data.info.vote,
								id    : data.info.id
							});
						}else{
							tips.show(data.info);
						}
						
					}
				});
				
			});

	$(".href").live('click',function(){
		var obj = $(this);
		var id = obj.attr('data-id');
		tips.show();
		$.ajax({
			url: '<?php  echo $this->createMobileUrl('options')?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success:function(data){
				if(data.status){
					vote.show({
						src   : data.info.thumb,
						title : data.info.title,
						num	  : data.info.orderby,
						vote  : data.info.vote,
						id    : id
					});

					var voteArr = data.info.selected.split(',');
					if($.inArray(id, voteArr)<0){
						$("#pic-show .select-btn").removeClass('is-select');
					}else{
						$("#pic-show .select-btn").addClass('is-select');
					}
				}
				tips.hide();
			}
		});
	});

	$(".vote-btn,.btn1").live('click',function(){
		var obj = $(this);
		var id = obj.attr('data-id');
		$.ajax({
			url: '<?php  echo $this->createMobileUrl('vote')?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success:function(data){
				if(data.status){
					$(".select-btn[data-id=\""+id+"\"]").siblings('.vote-info').find('.vote').text(data.vote);
					$("#pic-show .vote").text(data.vote);
					$(".select-btn[data-id=\""+id+"\"]").addClass('is-select');
				}
				tips.show(data.info,2000,function(){
					if(data.sign=='erropenid'){
						window.location.href="<?php  echo $data['url'];?>";
					}
				});
			}
		});
		
		
		
	});



	var list = new topList();
	var vote = new votePic();

	$(".top-list-btn").click(function(){
		var res = '<?php  echo $res;?>';
		tips.show();
		$.ajax({
			url: '<?php  echo $this->createMobileUrl('top')?>',
			type: 'POST',
			dataType: 'json',
			success:function(data){
				if(data.status){
					var html='';
					for(var i=1;i<=data.info.length;i++){
						if(i<=3){
							html+="<tr><td><img src='"+res+"/images/no"+(i)+".png'></td><td>"+data.info[i-1].title+"</td><td>"+data.info[i-1].vote+"</td></tr>";
						}else{
							html+="<tr><td>"+i+"</td><td>"+data.info[i-1].title+"</td><td>"+data.info[i-1].vote+"</td></tr>";
						}
						
					}
					$(".top-list-table2 table tbody").html(html);
					list.show();
				}
				tips.hide();
			}
		});

		
	});
	$(".top-list-close").click(function(){
		list.hide();
	});

	$(".vote-rule-btn").click(function(){
		$("#vote-rule").css('display','-webkit-flex');
	});
	$(".vote-rule-close").click(function(){
		$("#vote-rule").hide();
	});

</script>
</body>
</html>