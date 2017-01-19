<?php
/**
 * 微图片投票模块定义
 *
 * @author clove77
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Clove77_wvoteModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
		global $_W;
		load()->func('tpl');
		$now = time();
		$reply = array(
			"title" => "幸运大转盘活动开始了!",
			"start_picurl" => "../addons/ewei_bigwheel/template/style/activity-lottery-start.jpg",
			"description" => "欢迎参加幸运大转盘活动",
			"repeat_lottery_reply" => "亲，继续努力哦~~",
			"ticket_information" => "兑奖请联系我们,电话: 13888888888",
			"starttime" => $now,
			"endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
			"end_theme" => "幸运大转盘活动已经结束了",
			"end_instruction" => "亲，活动已经结束，请继续关注我们的后续活动哦~",
			"end_picurl" => "../addons/ewei_bigwheel/template/style/activity-lottery-end.jpg",
			"most_num_times" => 1,
			"number_times" => 1,
			"probability" => 0,
			"award_times" => 1,
			"sn_code" => 1,
			"sn_rename" => "SN码",
			"tel_rename" => "手机号",
			"show_num" => 1,
			"share_title" => "欢迎参加大转盘活动",
			"share_desc" => "亲，欢迎参加大转盘抽奖活动，祝您好运哦！！ 亲，需要绑定账号才可以参加哦",
			"share_txt" => "&lt;p&gt;1. 关注微信公众账号\"()\"&lt;/p&gt;&lt;p&gt;2. 发送消息\"大转盘\", 点击返回的消息即可参加&lt;/p&gt;",
		);
		include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$this->saveSettings($dat);
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}