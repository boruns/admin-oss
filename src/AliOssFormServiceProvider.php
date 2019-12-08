<?php

namespace Ezreal\AdminOss;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class AliOssFormServiceProvider extends ServiceProvider
{

	public function boot(AliOssForm $extension) 
	{
		if (!AliOssForm::boot()) {
			return;
		}

		//注册视图
		if ($views = $extension->views()) {
			$this->loadViewsFrom($views, 'admin-oss');
		}

		//注册静态资源
		if ($this->app->runningInconsole() && $assets = $extension->assets()) {
			$this->publishes(
				[$assets => public_path('vendor/ezreal/admin-oss')],
				'admin-oss'
			);
		}

		//注册新增加的form类型
		Admin::booting(function () {
			Form::extend('customFile', CustomFile::class);
			Form::extend('customMultiFile', CustomMultiFile::class);
			Form::extend('customEditor', CustomEditor::class);
		});

		//注册路由
		$this->app->booted(function () {
			AliOssForm::routes(__DIR__ . '/../routes/web.php');
		});


	}
}

