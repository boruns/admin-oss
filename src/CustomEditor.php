<?php

namespace Ezreal\AdminOss;

use Encore\Admin\Form\Field;

class CustomEditor extends Field
{
	protected $view = 'admin-oss::editor';

	protected static $css = [
		'vendor/ezreal/admin-oss/wangEditor-3.0.10/release/wangEditor.min.css',
	];

	protected static $js = [
		'vendor/ezreal/admin-oss/wangEditor-3.0.10/release/wangEditor.min.js',
		'vendor/ezreal/admin-oss/upload.js',
	];

	/**
	 * 文件大小限制
	 * @var string
	 */
	protected $maxFileSize = '10mb';

	/**
	 * 文件后缀限制
	 * @var string
	 */
	protected $fileExtensions = 'jpg,jpeg,gif,png';

	public function render()
	{
		$name = $this->formatName($this->column);
        $token = csrf_token();
        $maxFileSize = $this->maxFileSize;
		$fileExtensions = $this->fileExtensions;
        $this->script = <<<EOT
(function(){
var editor = new window.wangEditor('#$name');
editor.customConfig.zIndex = 0;
editor.customConfig.uploadImgShowBase64 = true;
editor.customConfig.qiniu = true;
editor.customConfig.onchange = function (html) {
    $('input[name="$name"]').val(html);
}
editor.create();
init_upload_edit(editor, '$token', '$maxFileSize', '$fileExtensions')
})();
EOT;
        return parent::render();
	}

	/**
     * 设置上传文件大小
     * @param  string $size [上传文件大小]
     * @return $this
     */
    public function maxFileSize($size)
    {
    	$this->maxFileSize = $size;
    	return $this;
    }

    /**
     * 设置上传文件的后缀
     * @param  [string] $extensions [文件后缀]
     * @return $this
     */
    public function fileExtensions($extensions)
    {
    	$this->fileExtensions = $extensions;
    	return $this;
    }
}
