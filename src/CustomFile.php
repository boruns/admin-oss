<?php

namespace Ezreal\AdminOss;

use Encore\Admin\Form\Field;

/**
 * 单文件上传
 */
class CustomFile extends Field
{
	protected $view = 'admin-oss::file';

	protected static $css = [
		'vendor/ezreal/admin-oss/style.css',
	];

	protected static $js = [
		'vendor/ezreal/admin-oss/plupload-2.1.2/js/plupload.full.min.js',
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
init_upload('{$name}_upload', false, '{$token}', '{$maxFileSize}', '{$fileExtensions}');
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

